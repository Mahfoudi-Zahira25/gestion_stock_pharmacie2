<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class produitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Exemple : produit Paracétamol
        Produit::firstOrCreate(
            ['nom' => 'Paracétamol'], // condition pour vérifier s’il existe déjà
            [
                'type' => 'médicament',
                'forme' => null,
                'unite' => null,
            ]
        );

        // Exemple : produit Gants stériles
        Produit::firstOrCreate(
            ['nom' => 'Gants stériles'],
            [
                'type' => 'dispositif médical',
                'forme' => null,
                'unite' => 'paquet',
            ]
        );
        Produit::firstOrCreate(
            ['nom' => 'Aspirine',],
            [
                'type' => 'médicament',
                'forme' => 'comprimé',
                'unite' => 'boîte',
            ]
        );
        Produit::firstOrCreate(
            ['nom' => 'Panadol',],
            [
                'type' => 'médicament',
                'forme' => 'comprimé',
                'unite' => 'boîte',
            ]
        );

        // Tu peux ajouter d'autres produits de la même façon
    }
}
