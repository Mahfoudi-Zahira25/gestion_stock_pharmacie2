<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeFournisseur extends Model

{
    protected $fillable = ['id_dépôt', 'id_fournisseur', 'date_commande', 'statut'];

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_dépôt');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'id_fournisseur');
    }

    public function details()
    {
        return $this->hasMany(DetailCommande::class, 'id_commande');
    }
}

