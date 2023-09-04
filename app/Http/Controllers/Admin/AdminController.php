<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        // return response()->json(['message'=>$request->all()]);
        try{
            DB::beginTransaction();

            $form = Form::create([
                'name' => $request->formName,
                'visibility' => 'open',
                'status' => 'draft',
            ]);
            if($form)
            {
                foreach($request['components'] as $field)
                {
                    $field_id = 0;
                    $fields = FormField::create([
                        'form_id'  => $form->id,
                        'type'     => $field['type'],
                        'name'     => $field['label'],
                        'label'     => $field['label'],
                        'field_id' => $field_id++
                    ]);
                }
                if($fields)
                {
                    DB::commit();
                    return response()->json(['message'=>'Form Created Successfully'], 200);
                }
                    DB::rollBack();
                    return response()->json('Something went wrong! Please try again later.');
            }
        }
        catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

}
