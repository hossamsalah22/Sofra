<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\LoginRequest;
use App\Http\Requests\Api\Client\NewPasswordRequest;
use App\Http\Requests\Api\Client\RegisterRequest;
use App\Http\Requests\Api\Client\ResetPasswordRequest;
use App\Http\Requests\Api\RemoveTokenRequest;
use App\Http\Requests\Api\TokenRequest;
use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('upload/clients', $image_new_name);
            $client->image = 'uploads/clients/' . $image_new_name;
        }
        $client->api_token = Str::random(60);
        $client->save();
        return responseJson(
            1,
            'Register Success',
            [
                'api_token' => $client->api_token,
                'client' => $client,
            ]
        );
    }

    public function login(LoginRequest $request)
    {
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return responseJson(
                    1,
                    'Welcome Back',
                    [
                        'api_token' => $client->api_token,
                        'client' => $client
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
        $client = Client::where('email', $request->email)->first();
        if ($client) {
            $code = rand(1111, 9999);
            $update = $client->update(['pin_code' => $code]);
            if ($update) {
                Mail::to($client->email)
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
        $client = Client::where('pin_code', $request->pin_code)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return responseJson(0, 'New password cannot be the same as The current password');
            } else {
                $client->password = bcrypt($request->password);
                $client->pin_code = null;
                if ($client->save()) {
                    return responseJson(1, 'Password Changed Successfully');
                } else {
                    return responseJson(0, 'error please try again');
                }
            }
        } else {
            return responseJson(0, 'The code is invalid');
        }
    }

    public function registerToken(TokenRequest $request)
    {
        Token::where('token', $request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'registered successfully');
    }

    public function removeToken(RemoveTokenRequest $request)
    {
        Token::where('token', $request->token)->delete();
        return responseJson(1, 'Deleted Successfully');
    }
}
