<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
      protected $primaryKey = 'id_patient';
    protected $fillable = ['nom', 'prenom', 'date_nais', 'numero_dossier'];

    public function sorties()
    {
        return $this->hasMany(SortieVersPatient::class, 'id_patient');
    }
}
