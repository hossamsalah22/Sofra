<?php

namespace App\Http\Controllers\Api\Resturant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Resturant\LoginRequest;
use App\Http\Requests\Api\Resturant\NewPasswordRequest;
use App\Http\Requests\Api\Resturant\RegisterRequest;
use App\Http\Requests\Api\Resturant\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\Resturant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        $resturnat = Resturant::create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/resturnats', $image_new_name);
            $resturnat->image = 'uploads/resturnats/' . $image_new_name;
        }
        $resturnat->api_token = Str::random(60);
        $resturnat->save();
        return responseJson(
            1,
            'Register Success',
            [
                'api_token' => $resturnat->api_token,
                'resturnat' => $resturnat,
            ]
        );
    }

    public function login(LoginRequest $request)
    {
        $resturant = Resturant::where('email', $request->email)->first();
        if ($resturant) {
            if (Hash::check($request->password, $resturant->password)) {
                return responseJson(
                    1,
                    'Welcome Back',
                    [
                        'api_token' => $resturant->api_token,
                        'resturant' => $resturant
                    ]
                );
            } else {
                return responseJson(0, 'Wrong Password please try again');
            }
        } else {
            return responseJson(0, 'Email not found please register first');
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $resturant = Resturant::where('email', $request->email)->first();
        if ($resturant) {
            $code = rand(1111, 9999);
            $update = $resturant->update(['pin_code' => $code]);
            if ($update) {
                Mail::to($resturant->email)
                    ->bcc("hossamsalahabbas@gmail.com")
                    ->send(new ResetPassword($code));
                return responseJson(1, 'Code sent to your email', $code);
            } else {
                return responseJson(0, 'error, please try again');
            }
        } else {
            return responseJson(0, 'This email have no account');
        }
    }

    public function newPassword(NewPasswordRequest $request)
    {
        $resturant = Resturant::where('pin_code', $request->pin_code)->first();
        if ($resturant) {
            if (Hash::check($request->password, $resturant->password)) {
                return responseJson(0, 'New password cannot be the same as The current password');
            } else {
                $resturant->password = bcrypt($request->password);
                $resturant->pin_code = null;
                if ($resturant->save()) {
                    return responseJson(1, 'Password Changed Successfully');
                } else {
                    return responseJson(0, 'error please try again');
                }
            }
        } else {
            return responseJson(0, 'The code is invalid');
        }
    }
}
