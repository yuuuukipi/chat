<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/rooms';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //登録情報入力画面
      public function register_form(){
        return view('auth.register');
    }

    //登録情報確認画面
    public function register_check(Request $request){
      $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
      ]);
      $user = new User();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password=$request->password;
      if($request->admin=='on'){
        $user->admin_flag='1';
        $user->admin="管理者として登録する";
      }else{
        $user->admin_flag='0';
      }

      $token = md5(uniqid(rand(), true));
      $request->session()->put('token', $token);

      return view('auth.check')->with(['user'=>$user, 'token'=>$token]);
    }

    //登録完了（保存）
    public function register_complete(Request $request){
      $user_token=$request->get('token');
      if($request->session()->get('token') !== $user_token){
        return redirect('/rooms');
      }
      $request->session()->forget('token');

      $user = new User();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password= Hash::make($request->password);
      $user->admin_flag=$request->admin_flag;
      $user->save();

      if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])){
        return redirect('/rooms');
      }

      return view('rooms.index');
    }

}
