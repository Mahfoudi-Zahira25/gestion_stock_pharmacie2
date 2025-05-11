<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nom' => 'Mahfoudi',
            'prenom' => 'Zahira',
            'email' => 'zahiramahfoudi5@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'),
            'role' => 'pharmacien',
            'depot_id' => 2,
        ]);

         User::create([
            'nom' => 'sebbar',
            'prenom' => 'hasnae',
            'email' => 'hasnaesebbar25@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567800'),
            'role' => 'responsable',
            'depot_id' => 5,
        ]);
    }
}


