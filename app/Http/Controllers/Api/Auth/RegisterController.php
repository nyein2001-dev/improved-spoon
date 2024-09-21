<?php

namespace App\Http\Controllers\Api\Auth;

use App\Rules\Captcha;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:api');
    }

    public function translator($lang_code)
    {
        $front_lang = Session::put('front_lang', $lang_code);
        config(['app.locale' => $lang_code]);
    }

    public function store_register(Request $request)
    {
        $this->translator($request->lang_code);

        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:4|confirmed|max:100',
            'g-recaptcha-response' => new Captcha()
        ];
        $customMessages = [
            'name.required' => trans('user_validation.Name is required'),
            'email.required' => trans('user_validation.Email is required'),
            'email.unique' => trans('user_validation.Email already exist'),
            'password.required' => trans('user_validation.Password is required'),
            'password.min' => trans('user_validation.Password must be 4 characters'),
            'password.confirmed' => trans('user_validation.Confirm does not match')
        ];
        $this->validate($request, $rules, $customMessages);

        $user = new User();
        $user->name = $request->name;
        $user->user_name = Str::lower(str_replace(' ', '_', $request->name)) . '_' . mt_rand(100000, 999999);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->otp_mail_verify_token = random_int(100000, 999999);
        $user->save();

        return response()->json(['status' => true, 'message' => trans('user_validation.Register successfully')], 200);
    }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
