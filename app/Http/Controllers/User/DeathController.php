<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Mail;
use App\Mail\DeathNotification;
use App\Jobs\SendDeathNotificationJob;

class DeathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Profile::where('id', auth()->user()->profile_id)->first();
        $users = $user ? $user->users()->get() : null;

        return view('user.death.list', compact('users'));
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if($user)
            {
                $update = $user->update([
                    'status' => 'deceased'
                ]);
            }
            $data = [
                'user' => $user, // Assuming $user is an object with the necessary properties
                'message' => $request->message,
            ];
            $associate_user = $user->profile()->get();
            foreach ($associate_user as $key => $value) {
                // Queue the email sending job
                dispatch(new SendDeathNotificationJob($value->email, $data));
            }
            return redirect()->back()->with('success', 'Death Notification email send to all users');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}