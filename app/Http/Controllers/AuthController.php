<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthController extends Controller
{   
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'tel' => ['required', 'regex:/^(\+7|8)\s?\d{3}\s?\d{3}\s?\d{2}\s?\d{2}$/'],
            'fio' => ['required', 'regex:/^[А-Яа-яЁёA-Za-z\s\-]{5,100}$/u'],
            'password' => ['required', 'regex:/^(?=.*[.!,?])[0-9A-Za-z\s.!,?-]{8,40}$/'],
            'email' => ['required', 'regex:/^[0-9A-Za-z_.+-]{1,64}@[0-9A-Za-z_-]{1,10}\.[0-9A-Za-z_-]{2,6}$/'],
            'male' => ['required', 'regex:/^[А-Яа-яЁё\s]{1,20}$/u'],
            'birthday' => ['required', 'date_format:Y-m-d']
        ]);
        if($validator->fails()){
            return response()->json(['Ошибка валдиации'=> $validator->errors()]);
        }
        $tel = $request->input('tel');
        $fio = $request->input('fio');
        $password = $request->input('password');
        $email = $request->input('email');
        $male = $request->input('male');
        $birthday = $request->input('birthday');
        $userExist = DB::select('SELECT * FROM users where email = ?', [$email]);
        if($userExist){
            return response()->json(['err'=>'Данный пользователь уже существует']);
        }
        $password = Hash::make($password);
        DB::insert('INSERT INTO `users` (`fio`, `tel`, `birthday`, `email`, `password`) VALUES (?, ?, ?, ?, ?)', [$fio, $tel, $birthday, $email, $password]);
        $id_user = DB::getPdo()->lastInsertId();
        $roles = 'user';
        $payloadParam = [
            'sub' => $id_user,
            'iat' => now()->timestamp,
            'exp' => now()->addDays(3)->timestamp,
            'roles' => $roles
        ];
        $payload = JWTFactory::customClaims($payloadParam)->make();
        $token = JWTAuth::encode($payload)->get();
        return response()->json(['token'=>$token]);
    }
    public function auth(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'regex:/^(?=.*[.!,?])[0-9A-Za-z\s.!,?-]{8,40}$/'],
            'email' => ['required', 'regex:/^[0-9A-Za-z_.+-]{1,64}@[0-9A-Za-z_-]{1,10}\.[0-9A-Za-z_-]{2,6}$/']
        ]);
        if($validator->fails()){
            return response()->json(['Ошибка валдиации'=> $validator->errors()]);
        }
        $password = $request->input('password');
        $email = $request->input('email');
        $user = DB::select('SELECT * FROM users WHERE email = ?', [$email]);
        if (!Hash::check($password, $user[0]->password)) {
            return response()->json(['err' => 'Неверный логин или пароль']);
        }
        $id_user = $user[0]->id_user;
        $roles = 'user';
        $payloadParam = [
            'sub' => $id_user,
            'iat' => now()->timestamp,
            'exp' => now()->addDays(3)->timestamp,
            'roles' => $roles
        ];
        $payload = JWTFactory::customClaims($payloadParam)->make();
        $token = JWTAuth::encode($payload)->get();
        return response()->json(['token'=>$token]);
    }
}
