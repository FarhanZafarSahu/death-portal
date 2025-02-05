<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function form(Request $request, $id)
    {
        return view('user.forms.form', compact('id'));
    }

    public function profile(Request $request)
    {
        return view('user.profile');
    }

    public function show_all(Request $request)
    {
        return view('user.users.list');
    }

    public function specific_user(Request $request, $id)
    {
        
        return view('user.users.list');
    }
}
