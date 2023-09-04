<?php
use App\Models\Form;
use App\Models\UserFormData;
use Illuminate\Support\Facades\Auth;


function allform()
{
    $form = Form::where('status', 'published')->get();
    return $form;
}

function percentage()
{
    $formcount = Form::where('status', 'published')->count();
    $userformcount = UserFormData::where('user_id', auth()->user()->id)->count();
    $percentage = ($userformcount / $formcount) * 100;
    return $percentage;
}


?>