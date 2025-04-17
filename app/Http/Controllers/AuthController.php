<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{   
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'tel' => ['required', 'regex:/^(\+7|8)\s?\d{3}\s?\d{3}\s?\d{2}\s?\d{2}$/']
            ]);
        $fio = $request->input('fio');
        $birthday = $request->input('birthday');
        $male = $request->input('male');
        $tel = $request->input('tel');
        $email = $request->input('email');
        $password = $request->input('password');
        $test = $fio.' '.$email.' '.$birthday.' '.$tel.' '.$password;
        return response()->json(['data'=>$test]);
    }
    public function auth(Request $request){
        
    }
}
