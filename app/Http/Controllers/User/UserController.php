<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\User;
use App\Models\Profile;
use App\Models\ProfileUser;
use App\Models\FormField;
use App\Models\UserFormData;
use App\Mail\AuthenticationMail;
use Illuminate\Support\Str;
use Auth;
use Mail;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user()->primaryprofile()->get();
        return view('user.dashboard');
    }

    public function form(Request $request, $id)
    {
        $form = Form::where('id', $id)->with('formFields')->first();
        return view('user.forms.form', compact('form'));
    }

    public function profile(Request $request)
    {
        $formcount = Form::where('status', 'published')->count();
        $userformcount = UserFormData::where('user_id', auth()->user()->id)->count();
        // return ($userformcount / $formcount) * 100;
        return view('user.profile');
    }

    public function contacts(Request $request)
    {
        return view('user.users.profilelist');
    }

    public function show_all(Request $request)
    {
        $users = User::where('status', 'active')
                ->where('is_admin', 0)
                ->get();
        return view('user.users.list', compact('users'));
    }

    public function specific_user(Request $request, $id)
    {
        return $id;
        return view('user.users.list');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function submitform(Request $request, $id)
    {
        
        try {
                //get form with their fields for check notify field and field name where to send email
                $form = Form::where('id',$id)->with('formFields')->first();
                foreach ($form->formFields as $key => $value) {
                    
                    if($value->notify == 1)
                    {
                        $email = $value->name;
                        $password = Str::random(8); //genrate random password
                        $credentioal = [
                            'email'    => $request->input($email),
                            'password' => $password
                        ];
                        $profile = new Profile();
                        $register = new User();
                        $profile_detail = $profile->profile($credentioal);
                        //add this profile to user in many to many relation
                        $user = Auth::user();
                        $user->profile()->attach($profile_detail, ['primary' => false, 'secondary' => false]);
                        //save user profile against login user
                        $register->register($credentioal, $profile_detail); //save user in user table
                        if($profile_detail)
                        {
                            Mail::to($request->input($email))->send(new AuthenticationMail($credentioal));
                        }
                    }
                }
                // Exclude the _token key
                $data = $request->except('_token');
                $formdata = UserFormData::create([
                    'form_id' => $id,
                    'user_id' => auth()->user()->id,
                    'data'    => json_encode($data)
                ]);
            if($formdata)
            {
                return redirect()->back()->with('success', 'form submited successfully and mail is also send check your inbox for login credentioal');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function primary(Request $register, $id)
    {
        $profile = ProfileUser::where('profile_id', $id)
                   ->where('user_id', auth()->user()->id)->first();
        $update = $profile->update([
            'primary' => 1,
            'secondary'  => 0
        ]);

        return redirect()->back()->with('success', 'make primary successfully');
    }

    public function secondary(Request $register, $id)
    {
        $profile = ProfileUser::where('profile_id', $id)
                   ->where('user_id', auth()->user()->id)->first();
        $update = $profile->update([
            'primary' => 0,
            'secondary'  => 1
        ]);

        return redirect()->back()->with('success', 'make secondary successfully');
    }
}
