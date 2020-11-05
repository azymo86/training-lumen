<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends BaseController
{
    public function index ()
    {
        $out = array(
          'success' => true,
          'message' => 'Class UserController'
        );
        return response()->json($out,200);
    }


    public function register (Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'email'     => 'required|unique:users|max:255',
            'password'  => 'required|min:6'
        ]);

        $name     = $request->input("name");
        $email    = $request->input("email");
        $password = $request->input("password");

        $hash_pass = Hash::make($password);

        $data = [
            "name"      => $name,
            "email"     => $email,
            "password"  => $hash_pass
        ];

        if (User::create($data)) {
            $data = User::where('email', $email)->first();
            $out  = [
                "success" => true,
                "message" => "Register success",
                "data"    => $data
            ];
            $code = 201;
        } else {
            $out = [
                "success" => false,
                "message" => "Regiser is failed",
            ];
            $code = 501;
        }

        return response()->json($out, $code);
    }


    public function login (Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
            'password'  => 'required|min:6'
        ]);

        $email    = $request->input("email");
        $password = $request->input("password");
        $user     = User::where("email", $email)->first();

        if (!$user) {
            $out = [
                "success" => false,
                "message" => "Account not registered",
                "token" => null
            ];
            return response()->json($out, 401);
        }

        if (Hash::check($password, $user->password)) {
            $early    = 'M7ogtyNVFOAwFbs7wsiJLtyKI2HuSoDZpLxxUWEHddX3vefdQG';
            $last     = 'paIWoLK0a5uQHZ3uWyF8PHNKfYu0tPtTIBTnPRjC07AGEiGQzF';
            $newtoken = $early.$this->str_Random(200).$last;

            $user->update(['token' => $newtoken]);

            $out = [
                "success" => true,
                "message" => "Login is success",
                "token"   => $user->token
            ];
            return response()->json($out, 200);

        } else {
            $out = [
                "success" => false,
                "message" => "Wrong password",
                "token" => null
            ];
            return response()->json($out, 401);
        }

    }


    private function str_Random ($length)
    {
        $char = '012345678dssd9abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $char_length = strlen($char);
        $str = '';

        for ($i = 0; $i < $length; $i++) {
            $str .= $char[rand(0, $char_length - 1)];
        }

        return $str;
    }

}
