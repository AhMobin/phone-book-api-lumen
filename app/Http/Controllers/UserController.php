<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function read(){
        $user = User::all();
        return $user;
    }
    public function store(Request $request){

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;

        $insert = $user->save();

        if($insert == true){
            return 'User Inserted Success';
        }else{
            return 'User Insert Failed! Try Again';
        }
    }

    public function destroy($id){
        $delete = User::where('id',$id)->delete();

        if($delete == true){
            return "User Deleted Success";
        }else{
            return "Failed To Delete! Try Again";
        }
    }
}
