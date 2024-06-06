<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

class DashController extends Controller
{
    public function index()
    {
        return view('index');
    }
}

