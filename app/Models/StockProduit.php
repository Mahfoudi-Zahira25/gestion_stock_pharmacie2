<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduit extends Model
{
   
    use HasFactory;

    protected $table = 'stock_produits';
    protected $primaryKey = 'id_stock_produit';
    public $timestamps = true;

    protected $fillable = [
        'id_stock',
        'id_produit',
        'quantite',
        'stock_alerte',
        'stock_securite',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stock', 'id_stock');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit', 'id');
    }
}


