<?php

namespace App\Http\Controllers\Auth;

use App\Handlers\EmailHandler;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'captcha'  => 'required|captcha',
        ],
        [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha'  => '请输入正确的验证码',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username'           => $data['username'],
            'email'              => $data['email'],
            'avatar'             => '/images/avatars/default.png',
            'password'           => bcrypt($data['password']),
            'verification_token' => str_random(40),
            'login_token'        => str_random(64),
            'source'             => str_random(64),
        ]);

//        $this->sendVerifyEmailTo($user);

        return $user;
    }

    /**
     * 发送激活邮件
     *
     * @param $user
     */
    private function sendVerifyEmailTo($user)
    {
        // 模板变量
        (new EmailHandler())->sendActivateMail($user);
    }
}
