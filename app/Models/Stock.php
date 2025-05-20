<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    

    use HasFactory;

    protected $table = 'stocks';
    protected $primaryKey = 'id_stock';
    public $timestamps = true;

    protected $fillable = [
        'id_depot',
    ];

    public function depot()
    {
        return $this->belongsTo(Depot::class, 'id_depot', 'id_depot');
    }

    public function stockProduits()
    {
        return $this->hasMany(StockProduit::class, 'id_stock', 'id_stock');
    }
}


