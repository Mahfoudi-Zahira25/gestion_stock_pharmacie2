<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieDepot extends Model
{
    protected $primaryKey = 'id_sortie_depot';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'date_cmd',
        'date_sortie',
        'type_commande',
        'id_depot_source',
        'id_depot_destin'
    ];

    public function details()
    {
        return $this->hasMany(DetailSortieDepot::class, 'id_sortie_depot');
    }
    public function service()
    {
        return $this->belongsTo(\App\Models\Depot::class, 'id_depot_destin', 'id_depot');
    }
}


