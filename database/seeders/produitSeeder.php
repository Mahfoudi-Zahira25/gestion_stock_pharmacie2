<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produits = [
            [
                'nom' => 'Paracétamol',
                'type' => 'médicament',
                'forme' => null,
                'unite' => null,
                'prix' => 12.50,
            ],
            [
                'nom' => 'Gants stériles',
                'type' => 'dispositif médical',
                'forme' => null,
                'unite' => 'paquet',
                'prix' => 25.00,
            ],
            [
                'nom' => 'Aspirine',
                'type' => 'médicament',
                'forme' => 'comprimé',
                'unite' => 'boîte',
                'prix' => 18.00,
            ],
            [
                'nom' => 'Panadol',
                'type' => 'médicament',
                'forme' => 'comprimé',
                'unite' => 'boîte',
                'prix' => 20.00,
            ],
            [
                'nom' => 'Masques chirurgicaux',
                'type' => 'dispositif médical',
                'forme' => null,
                'unite' => 'boîte',
                'prix' => 30.00,
            ],
            [
                'nom' => 'Seringue 5ml',
                'type' => 'dispositif médical',
                'forme' => null,
                'unite' => 'pièce',
                'prix' => 5.00,
            ],
            [
                'nom' => 'Ibuprofène',
                'type' => 'médicament',
                'forme' => 'gélule',
                'unite' => 'boîte',
                'prix' => 16.50,
            ],
        ];

        foreach ($produits as $produit) {
            Produit::firstOrCreate(
                ['nom' => $produit['nom']],
                $produit
            );
        }
    }
}

