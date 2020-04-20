<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('users.login');
    }

    public function LoginApi()
    {
        dd(1);
    }
}
