<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SortieVersPatient extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sortie_vers_patients';

    protected $fillable = ['id_patient', 'date_sortie', 'id_depot'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient');
    }

    public function details()
    {
        return $this->hasMany(DetailSortiePatient::class, 'id_sortie_vers_patient');
    }
}

