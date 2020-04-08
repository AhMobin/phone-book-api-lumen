<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Phonebook;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->input('access_token');
        $key = env('APP_KEY');
        $decoded = JWT::decode($token, $key, array('HS256'));
        $decoded_array = (array)$decoded;
        $user = $decoded_array['user'];

        $index = Phonebook::where(['user'=>$user])->get();
        return response()->json($index);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->input('access_token');
        $key = env('APP_KEY');
        $decoded = JWT::decode($token, $key, array('HS256'));
        $decoded_array = (array)$decoded;
        $user = $decoded_array['user'];

        $book = new Phonebook();
        $book->contact_name = $request->contact_name;
        $book->contact_phone = $request->contact_phone;
        $book->contact_address = $request->contact_address;
        $book->user = $user;

        $phonebook = $book->save();

        if($phonebook==true){
            return "Contact Added To Phone Book";
        }else{
            return "Failed To Add";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $token = $request->input('access_token');
        $key = env('APP_KEY');
        $decoded = JWT::decode($token, $key, array('HS256'));
        $decoded_array = (array)$decoded;
        $user = $decoded_array['user'];

        $number = $request->number;

        $show = Phonebook::where(['user'=>$user, 'contact_phone'=>$number])->get();
        return response()->json($show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $token = $request->input('access_token');
        $key = env('APP_KEY');
        $decoded = JWT::decode($token, $key, array('HS256'));
        $decoded_array = (array)$decoded;
        $user = $decoded_array['user'];

        $phone = $request->contact_phone;
        $address = $request->contact_address;

        $updated = Phonebook::where('user',$user)->update(['contact_phone'=>$phone,'contact_address'=>$address]);
        if($updated == true){
            return "Update Success";
        }else{
            return "Failed To Update";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $token = $request->input('access_token');
        $key = env('APP_KEY');
        $decoded = JWT::decode($token, $key, array('HS256'));
        $decoded_array = (array)$decoded;
        $user = $decoded_array['user'];
        $phone = $request->contact_phone;

        $delete = Phonebook::where(['user'=>$user,'contact_phone'=>$phone])->delete();
        if($delete == true){
            return "Delete Success";
        }else{
            return "Failed To Delete";
        }



    }
}


