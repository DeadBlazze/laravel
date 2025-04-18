<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function adminGetRecords(Request $request){
        $payload = $request->attributes->get('payload');
        $role = $payload->get('roles');
        if($role !== 'admin'){
            return response()->json(['err'=>'У вас недостаточно прав доступа'], 402);
        }
        $records = DB::select('SELECT * FROM applications');
        return response()->json(['records'=>$records],200);
    }
    public function adminUpdateStatus(Request $request){
        $id_application = $request->input('id_application');
        $new_status = $request->input('new_status');
        $payload = $request->attributes->get('payload');
        $role = $payload->get('roles');
        if($role !== 'admin'){
            return response()->json(['err'=>'У вас недостаточно прав доступа'], 402);
        }
        $records = DB::update('UPDATE `applications` SET `status` = ? WHERE `applications`.`id_application` = ?',[$new_status, $id_application]);
        if($records){
            return response()->json(['msg'=>'Данные успешно обновлены'],200);
        }
        else{
            return response()->json(['err'=>'Ошибка в запросе'],400);
        }

        
    }
}
