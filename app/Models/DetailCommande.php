<?php

namespace App\Models;

use App\Http\Controllers\EntreeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommande extends Model

{
    // protected $fillable = ['commande_id', 'id_produit', 'quantité_cmd'];
protected $fillable = ['commande_id', 'produit_id', 'quantite'];
    public function commande()
    {
        return $this->belongsTo(CommandeFournisseur::class, 'commande_id');
    }

    
    
    public function produit()
{
    return $this->belongsTo(Produit::class, 'produit_id');
}
public function commandeFournisseur()
{
    return $this->belongsTo(CommandeFournisseur::class, 'commande_id');
}

public function entrees()
{
    return $this->hasMany(EntreeFournisseur::class, 'produit_id', 'produit_id');
}


}

