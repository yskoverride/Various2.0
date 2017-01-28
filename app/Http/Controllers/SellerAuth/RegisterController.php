<?php

namespace App\Http\Controllers\SellerAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Seller Model
use App\Seller;

//Auth Facade used in guard
use Auth;

class RegisterController extends Controller
{

    protected $redirectPath = 'seller_home';

    //shows registration form to seller
    public function showRegistrationForm()
    {
        return view('seller.auth.register');
    }

    //Handles registration request for seller
    public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create seller
        $seller = $this->create($request->all());

        //Authenticates seller
        $this->guard()->login($seller);

       //Redirects sellers
        return redirect($this->redirectPath);
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:sellers',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    //Create a new seller instance after a validation.
    protected function create(array $data)
    {
        return Seller::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Get the guard to authenticate Seller
    protected function guard()
    {
        return Auth::guard('web_seller');
    }
}
