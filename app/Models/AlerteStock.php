<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlerteStock extends Model
{
  
    use HasFactory;

    protected $table = 'alerte_stocks';
    protected $primaryKey = 'id_alert';
    public $timestamps = true;

    protected $fillable = [
        'id_depot',
        'id_produit',
        'type_alerte',
        'date_alerte',
    ];

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot', 'id_depot');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
}


