<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;
    public function users()
{
    return $this->hasMany(User::class);
}
public function utilisateurs() {
    return $this->hasMany(User::class);
}

public function commandes() {
    return $this->hasMany(CommandeFournisseur::class);
}

public function entrees() {
    return $this->hasMany(EntreeFournisseur::class);
}

}
