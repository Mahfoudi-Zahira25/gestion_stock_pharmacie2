<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetourProduit extends Model
{
    use HasFactory;

    protected $fillable = [
        'depot_id', // Dépôt secondaire qui retourne les produits
        'produit_id', // Produit retourné
        'quantite', // Quantité retournée
        'motif', // Motif du retour
        'date_retour',
    ];

    // Relation avec le dépôt
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    // Relation avec le produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
