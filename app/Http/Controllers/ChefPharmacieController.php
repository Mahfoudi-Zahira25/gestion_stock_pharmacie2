<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChefPharmacieController extends Controller
{
    public function index()
    {
        return view('chef.dashboard');
    }
}
