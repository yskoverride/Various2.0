<?php

namespace App\Http\Controllers\SellerAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Auth facade
use Auth;

class LoginController extends Controller
{
  //Trait
  use AuthenticatesUsers;

  //Custom guard for seller
  protected function guard()
  {
    return Auth::guard('web_seller');
  }
}
