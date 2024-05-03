<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class getproduct extends Controller
{
    $tableData = DB::table('products')->get();
}
