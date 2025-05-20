<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeDepotScEntrer extends Model
{
    use HasFactory;
    
    protected $table = 'commande_depot_sc_entrer';

    protected $fillable = [
        'id_cmd_sc',
        'id_entrer_depot_sc',
    ];

    public function commande()
    {
        return $this->belongsTo(CommandeDepotSc::class, 'id_cmd_sc');
    }

    public function entree()
    {
        return $this->belongsTo(EntrerDepotSc::class, 'id_entrer_depot_sc');
    }
}


