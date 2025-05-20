<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommandeDepotSc extends Model
{
    use HasFactory;
  
    protected $table = 'detail_commande_depot_scs';
    protected $primaryKey = 'id_detail_cmd_depot_sc';

    protected $fillable = [
        'id_cmd_sc',
        'id_produit',
        'quantite_cmd',
    ];

    public function commande()
    {
        return $this->belongsTo(CommandeDepotSc::class, 'id_cmd_sc');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}


