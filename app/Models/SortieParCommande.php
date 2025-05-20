<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieParCommande extends Model
{
  


    protected $fillable = ['id_cmd_depot', 'id_sortie_depot'];

    public function commande()
    {
        return $this->belongsTo(CommandeService::class, 'id_cmd_depot');
    }

    public function sortieDepot()
    {
        return $this->belongsTo(SortieDepot::class, 'id_sortie_depot');
    }
}


