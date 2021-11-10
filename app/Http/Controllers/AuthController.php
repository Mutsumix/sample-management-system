<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show login View
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'mail_address' => 'required|email|min:7',
            'password' => 'required|min:7',
        ]);

        if (Auth::attempt([
            'mail_address' => $request->input('mail_address'),
            'password' => $request->input('password'),
        ], $request->has('remember'))) {
            //Authentication passed...
            return redirect()->route('dashboard');
        } else {
            return redirect('/')->withInput()->with('info', 'ログイン失敗！😱');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('info', 'ログアウトしました！');
    }

    /**
     * Show details of authenticated user
     */
    public function show()
    {
        return view('auth.detail');
    }

}
