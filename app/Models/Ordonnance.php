<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',  // Référence au patient
        'medecin_id',  // Référence au médecin
        'date_ordonnance',
        'statut',       // Statut de l'ordonnance (ex: "Valide", "Utilisé")
    ];

    // Relation avec le patient
    // public function patient()
    // {
    //     return $this->belongsTo(Patient::class);
    // }

    // Relation avec le médecin
    //public function medecin()
    // {
    //     return $this->belongsTo(medecin::class);
    // }

    // Relation avec les produits prescrits
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'ordonnance_produit')
                    ->withPivot('quantite'); // Nombre de médicaments prescrits
    }
}
