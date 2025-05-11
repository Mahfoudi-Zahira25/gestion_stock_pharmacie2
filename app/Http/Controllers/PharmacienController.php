<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacienController extends Controller
{
    public function index()
    {
        return view('pharmacien.dashboard');
    }
}


