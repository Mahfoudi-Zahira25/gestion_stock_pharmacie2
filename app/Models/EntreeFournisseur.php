<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntreeFournisseur extends Model
{
    protected $fillable = ['id_commande', 'id_dépôt', 'id_fournisseur', 'date_entrée'];

    public function commande()
    {
        return $this->belongsTo(CommandeFournisseur::class, 'id_commande');
    }

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
        return $this->hasMany(DetailEntree::class, 'id_entrée');
    }
}

