<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrerDepotSc extends Model
{
    use HasFactory;

    protected $table = 'entrer_depot_scs';
    protected $primaryKey = 'id_entrer_depot_sc';

    protected $fillable = [
        'id_depot_source',
        'id_depot_destination',
        'date_entrer',
    ];

    public function details()
    {
        return $this->hasMany(DetailEntrerDepotSc::class, 'id_entrer_depot_sc');
    }

    public function depotSource()
    {
        return $this->belongsTo(Depot::class, 'id_depot_source', 'id_depot');
    }

    public function depotDestination()
    {
        return $this->belongsTo(Depot::class, 'id_depot_destination', 'id_depot');
    }

    public function commandes()
    {
        return $this->belongsToMany(CommandeDepotSc::class, 'commande_depot_sc_entrer', 'id_entrer_depot_sc', 'id_cmd_sc');
    }
}


