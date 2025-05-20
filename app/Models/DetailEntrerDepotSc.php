<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEntrerDepotSc extends Model
{
    use HasFactory;
 
    protected $table = 'detail_entrer_depot_scs';
    protected $primaryKey = 'id_detail_entrer_depot_sc';

    protected $fillable = [
        'id_entrer_depot_sc',
        'id_produit',
        'quantite_recus',
    ];

    public function entree()
    {
        return $this->belongsTo(EntrerDepotSc::class, 'id_entrer_depot_sc');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }
}


