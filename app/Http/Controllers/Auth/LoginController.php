<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
    public function Login(Request $request){
        $email = $request->email;
        $password = $request->password;


        $user = User::where(['email'=>$email,'password'=>$password])->count();

        if($user==1){
            $key = env('APP_KEY');

            $payload = array(
                "site" => "www.demo.com",
                "user" => $email,
                "iat" => time(),
                "exp" => time()+240
            );

            $jwt = JWT::encode($payload, $key);

            return response()->json(['Token'=>$jwt, 'Status'=>"Login Success"]);
        }
        else{
            return "failed";
        }
    }

//    public function TokenTest(){
//        return "Decode Success";
//    }
}
