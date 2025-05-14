<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PediatrieController extends Controller
{
    public function index()
    {
        return view('pediatrie.dashboard');
    }
}
