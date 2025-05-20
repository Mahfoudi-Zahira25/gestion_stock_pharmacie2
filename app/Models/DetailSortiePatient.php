<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortiePatient extends Model
{

    protected $primaryKey = 'id_detail_sortie_patient';
    protected $fillable = ['id_sortie_vers_patient', 'id_produit', 'quantite'];

    public function sortie()
    {
        return $this->belongsTo(SortieVersPatient::class, 'id_sortie_vers_patient');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}


