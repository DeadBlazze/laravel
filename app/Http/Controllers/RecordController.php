<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function getRecords(Request $request){
        return response()->json(['Привет']);
    }
}
