<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeDepotSc extends Model
{
    use HasFactory;
   
    protected $table = 'commande_depot_scs';
    protected $primaryKey = 'id_cmd_sc';

    protected $fillable = [
        'id_depot_sc',
        'id_depot_principale',
        'date_cmd',
        'statut',
    ];

    public function details()
    {
        return $this->hasMany(DetailCommandeDepotSc::class, 'id_cmd_sc');
    }

    public function depotDemandeur()
    {
        return $this->belongsTo(Depot::class, 'id_depot_sc', 'id_depot');
    }

    public function depotPrincipal()
    {
        return $this->belongsTo(Depot::class, 'id_depot_principale', 'id_depot');
    }

    public function entrees()
    {
        return $this->belongsToMany(EntrerDepotSc::class, 'commande_depot_sc_entrer', 'id_cmd_sc', 'id_entrer_depot_sc');
    }
}

