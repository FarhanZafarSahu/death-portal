<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        if(auth::user()->is_admin == 1)
        {
            return redirect()->route('admin.dashboard');
        }
        elseif(auth::user()->is_admin == 0)
        {
            return redirect()->route('user.dashboard');
        }
        
    }
}
