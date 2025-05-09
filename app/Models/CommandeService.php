<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeService extends Model
{
    use HasFactory;
    protected $fillable = [
        'depot_id',  // Référence au dépôt (service)
        'date_commande',
        'status',     // Statut de la commande, par exemple "En cours", "Terminée"
    ];

    // Relation avec le dépôt
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    // Relation avec les détails de la commande
    public function details()
    {
        return $this->hasMany(DetailCommande::class);
    }
}
