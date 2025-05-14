<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReanimationController extends Controller
{
    public function index()
    {
        return view('reanimation.dashboard');
    }
}
