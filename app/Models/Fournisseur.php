<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    public function commandes() {
        return $this->hasMany(CommandeFournisseur::class);
    }
    
    public function entrees() {
        return $this->hasMany(EntreeFournisseur::class);
    }
}
