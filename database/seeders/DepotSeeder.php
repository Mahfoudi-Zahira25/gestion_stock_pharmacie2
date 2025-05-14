<?php

namespace Database\Seeders;

use App\Models\Depot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepotSeeder extends Seeder
{public function run()
{
    $depots = [
        ['nom' => 'Dépôt Principal', 'type' => 'principal'],
        ['nom' => 'Dépôt des Urgences', 'type' => 'secondaire'],
        ['nom' => 'Dépôt de Réanimation', 'type' => 'secondaire'],
        ['nom' => 'Dépôt de pédiatrie', 'type' => 'secondaire'],
        ['nom' => 'Dépôt de chirurgie', 'type' => 'secondaire'],
        ['nom' => 'Dépôt de médecine interne', 'type' => 'secondaire'],
        ['nom' => 'Dépôt de radiologie', 'type' => 'secondaire'],
        ['nom' => 'Dépôt de cardiologie', 'type' => 'secondaire'],
    ];

    foreach ($depots as $depot) {
        // Crée le dépôt seulement s’il n’existe pas déjà
        Depot::firstOrCreate(['nom' => $depot['nom']], $depot);
    }
}}

     
    // public function run()
    // { // database/seeders/DepotSeeder.php
    //    
    //     Depot::create([
    //         'nom' => 'Dépôt des Urgences',
    //         'type' => 'secondaire',
    //     ]);
    //     Depot::create([
    //         'nom' => 'Dépôt de Réanimation',
    //         'type' => 'secondaire',
    //     ]);
    //     Depot::create([
    //         'nom' => 'Dépôt de pédiatrie',
    //         'type' => 'secondaire',
    //     ]);
    //     Depot::create([
    //         'nom' => 'Dépôt de chirurgie',
    //         'type' => 'secondaire',
    //     ]);
    //     Depot::create([
    //         'nom' => 'Dépôt de médecine interne',
    //         'type' => 'secondaire',
    //     ]);
    //     Depot::create([
    //         'nom' => 'Dépôt de radiologie',
    //         'type' => 'secondaire',
    //     ]);
    //     Depot::create([
    //         'nom' => 'Dépôt de cardiologie',
    //         'type' => 'secondaire',
    //     ]);
        // Depot::create([
        //     'nom' => '',
        //     'type' => 'secondaire',
        // ]);
        // Depot::create([
        //     'nom' => '',
        //     'type' => 'secondaire',
        // ]);


        //
