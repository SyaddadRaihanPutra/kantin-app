<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function createCanteen()
    {
        return view('pemilik.create-canteen');
    }
}
