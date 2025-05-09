<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommande extends Model

{
    protected $fillable = ['id_commande', 'id_produit', 'quantité_cmd'];

    public function commande()
    {
        return $this->belongsTo(CommandeFournisseur::class, 'id_commande');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}

