<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function getLogin() {
      return View::make('login.index');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/rooms');
    }

    //ログイン
    // public function login(){
    //   return view('auth.login');
    //
    //   }

    //ログイン完了
    // public function signin(Request $request){
    //   dd($request->password);
    //   if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
    //     return redirect()->route('signin');
    //   }else{
    //     return redirect()->back();
    //     }
    //   // return view('auth.singin');
    // }
    //
    // public  function logout(){
    //   // dd(1);
    //   Auth::logout();
    //   return redirect()->route('index');
    // }
}
