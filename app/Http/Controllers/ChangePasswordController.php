<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('change_password.index');
    }

    public function store(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords matches
            flash('Your current password does not matches with the password you provided. Please try again.')->error();
            return redirect()->back();
        }

        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            flash('New Password cannot be same as your current password. Please choose a different password.')->error();
            return redirect()->back();
        }

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        flash('Password changed successfully !')->success();
        return redirect(route('home'));
    }
}
