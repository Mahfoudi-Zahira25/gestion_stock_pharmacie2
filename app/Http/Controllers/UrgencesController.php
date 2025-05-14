<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrgencesController extends Controller
{
   public function index()
    {
        return view('urgences.dashboard');
    }
}
