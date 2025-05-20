<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieInterne extends Model
{
  
    protected $primaryKey = 'id_sortie_interne';
    protected $fillable = ['id_depot', 'date_sortie', 'destinataire_type', 'destinataire_nom'];

    public function details()
    {
        return $this->hasMany(DetailSortieInterne::class, 'id_sortie_interne');
    }
}

