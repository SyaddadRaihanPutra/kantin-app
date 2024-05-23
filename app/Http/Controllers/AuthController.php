<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
