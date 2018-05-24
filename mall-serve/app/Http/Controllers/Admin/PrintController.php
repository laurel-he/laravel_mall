<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrintController extends Controller
{
    //快递单打印
    public function index($id)
    {
        return view('print/index');
    }
    
    public function printAssign($id)
    {
        return view('print/index');
    }
}
