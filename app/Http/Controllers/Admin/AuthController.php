<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
    	return view('admin.pages.sign-in');
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt($request->except('_token'))) {
            return redirect()->route('users.index');
        }
        return redirect()->back()->withErrors('Auth failed');
    }
}
