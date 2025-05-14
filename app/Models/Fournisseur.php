<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $table = 'fournisseurs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom', 'type', 'adresse', 'telephone'];


    public function commandes() {
        return $this->hasMany(CommandeFournisseur::class);
    }
    
    public function entrees() {
        return $this->hasMany(EntreeFournisseur::class);
    }
}
