<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->valideLogin($request);
        $credencials = [
            'email' => $request->email,
            'password' => $request->password,
            'condicion' => 1
        ];

        if (Auth::attempt($credencials)) {
            return redirect()->route('main');
        }

        return back()
            ->withErrors(['email' => trans('auth.failed')])
            ->withInput(\request(['email']));
    }

    protected function valideLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
