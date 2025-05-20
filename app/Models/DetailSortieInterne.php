<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortieInterne extends Model
{
  
    protected $primaryKey = 'id_detail_interne';
    protected $fillable = ['id_sortie_interne', 'id_produit', 'quantite'];

    public function sortie()
    {
        return $this->belongsTo(SortieInterne::class, 'id_sortie_interne');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}


