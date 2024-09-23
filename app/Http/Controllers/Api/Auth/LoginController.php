<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Rules\Captcha;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function translator($lang_code)
    {
        $front_lang = Session::put($lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function store_login(Request $request)
    {
        $this->translator($request->lang_code);
        $rules = [
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => new Captcha()
        ];
        $customMessages = [
            'email.required' => trans('user_validation.Email is required'),
            'password.required' => trans('user_validation.Password is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::where('email', $request->email)->select('id', 'name', 'email', 'phone', 'user_name', 'status', 'image', 'address', 'about_me', 'password')->first();

        if ($user) {
            if ($user->status == 1) {
                if (Hash::check($request->password, $user->password)) {

                    $expiration = Carbon::now()->addMinutes(1)->timestamp;


                    if ($token = Auth::guard('api')->attempt($credential)) {
                        return $this->respondWithToken($token, $user);
                    } else {
                        return response()->json(['message' => 'Unauthorized'], 401);
                    }
                } else {
                    $notification = trans('user_validation.Credentials does not exist');
                    return response()->json(['message' => $notification], 403);
                }
            } else {
                $notification = trans('user_validation.Disabled Account');
                return response()->json(['message' => $notification], 403);
            }
        } else {
            $notification = trans('user_validation.Email does not exist');
            return response()->json(['message' => $notification], 403);
        }
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
            'user' => $user
        ]);
    }
}
