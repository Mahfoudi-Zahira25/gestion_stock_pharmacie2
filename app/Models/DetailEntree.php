<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEntree extends Model
{
        protected $fillable = ['id_entrée', 'id_produit', 'quantité_reçue'];
    
        public function entree()
        {
            return $this->belongsTo(EntreeFournisseur::class, 'id_entrée');
        }
    
        public function produit()
        {
            return $this->belongsTo(Produit::class, 'id_produit');
        }
    }

