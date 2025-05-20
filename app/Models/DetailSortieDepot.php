<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSortieDepot extends Model
{
    protected $primaryKey = 'id_detail_sortie_depot';
    protected $fillable = ['id_sortie_depot', 'id_produit', 'quantite'];

    public function sortie()
    {
        return $this->belongsTo(SortieDepot::class, 'id_sortie_depot');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}


