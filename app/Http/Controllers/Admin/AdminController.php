<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::whereIsAdmin(0)->count();
        $forms = Form::count();
        return view('admin.dashboard',compact('users','forms'));
    }

    public function users()
    {
        $users = User::whereIsAdmin(0)->get();
        return view('admin.users.list', compact('users'));
    }


    public function forms()
    {
        $forms = Form::all();
        return view('admin.forms.list', compact('forms'));
    }

    public function show()
    {
        return view('admin.forms.add');
    }

    public function storeForm(Request $request)
    {
        return response()->json($request['components'][0]);
        try{
            $form = Form::create([
                'name' => $request->name,
                'visibility' => $request->visibility,
                'status' => $request->status,
            ]);

            $form->form_fields()->createMany([
                
            ]);

            return redirect()->back()->with('success','Form Created Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

}
