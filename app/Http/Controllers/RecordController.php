<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    public function getRecords(Request $request){
        $payload = $request->attributes->get('payload');
        $role = $payload->get('roles');
        $id_user = $payload->get('sub');
        $records = DB::select('SELECT * FROM applications WHERE id_user = ?',[$id_user]);
        return response()->json(['records'=>$records]);
    }
    public function setRecord(Request $request){
        $validator = Validator::make($request->all(), [
            'mark' => ['required', 'regex:/^[А-Яа-яЁёA-Za-z0-9\s\-\.]{3,50}$/u'],
            'model' => ['required', 'regex:/^[А-Яа-яЁёA-Za-z0-9\s\-\.]{1,50}$/u'],
            'text' => ['required', 'regex:/^[А-Яа-яЁёA-Za-z0-9\s\-\.?!]{3,500}$/u'],
            'date' => ['required', 'date_format:Y-m-d']
        ]);
        if($validator->fails()){
            return response()->json(['Ошибка валдиации'=> $validator->errors()],402);
        }
        $payload = $request->attributes->get('payload');
        $id_user = $payload->get('sub');
        $mark = $request->input('mark');
        $model = $request->input('model');
        $text = $request->input('text');
        $date = $request->input('date');
        try{
            DB::insert('INSERT INTO `applications` (`id_user`, `date`, `model`, `problem`, `mark`) VALUES (?, ?, ?, ?, ?)',[$id_user, $date, $model, $text, $mark]);
            return response()->json(['Успешная запись']);
        }
        catch(\Exception $e){
            return response()->json(['err'=>$e]);
        }
    }
}
