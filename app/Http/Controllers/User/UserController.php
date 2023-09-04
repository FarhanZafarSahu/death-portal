<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\User;
use App\Models\FormField;
use App\Models\UserFormData;
use Auth;

class UserController extends Controller
{
    public function index()
    {
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
            // Exclude the _token key
            $data = $request->except('_token');
            $formdata = UserFormData::create([
                'form_id' => $id,
                'user_id' => auth()->user()->id,
                'data'    => json_encode($data)
            ]);
            if($formdata)
            {
                return redirect()->back()->with('success', 'form submited successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
