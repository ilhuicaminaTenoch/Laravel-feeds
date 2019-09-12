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
            'usuario' => "{$request->usuario}",
            'password' => "{$request->password}",
            'condicion' => 1
        ];
        //dd($credencials);

        if (Auth::attempt($credencials)) {
            return redirect()->route('main');
        }

        return back()
            ->withErrors(['usuario' => trans('auth.failed')])
            ->withInput(\request(['usuario']));
    }

    protected function valideLogin(Request $request)
    {
        $this->validate($request, [
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
