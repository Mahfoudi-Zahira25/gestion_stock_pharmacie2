<?php

namespace App\Http\Controllers;

use App\Models\DetailEntree;
use App\Models\Produit;
use Illuminate\Http\Request;

class PharmacienController extends Controller
{
    public function index()
    {
        return view('pharmacien.dashboard');
    }
}