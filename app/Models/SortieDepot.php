<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieDepot extends Model
{
    protected $primaryKey = 'id_sortie_depot';
    protected $fillable = ['date_sortie', 'id_depot_source', 'id_depot_destin'];

    public function details()
    {
        return $this->hasMany(DetailSortieDepot::class, 'id_sortie_depot');
    }
}


