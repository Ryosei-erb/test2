<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomesController extends Controller
{
    public function index() {
      return view("home.index");
    }

    public function signin(Request $request) {
        $login_info = ["email" => "email@email.com", "password" => "password"];
        $credentials = $this->getCredentials($login_info);

        if (Auth::guard($this->getGuard())->attempt($credentials)) {
            return $this->handleUserWasAuthenticated($login_info);
        }
    }
}
