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
        if (!User::where('email', 'zahiramahfoudi5@gmail.com')->exists()) {
        User::create([
            'name' => 'Mahfoudi',
            'prenom' => 'Zahira',
            'email' => 'zahiramahfoudi5@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'),
            'role' => 'pharmacien',
            'depot_id' => 1,
        ]);
    }


        if (!User::where('email', 'sebbarhasnae230@gmail.com')->exists()) {
        User::create([
            'name' => 'sebbar',
            'prenom' => 'hasnae',
            'email' => 'sebbarhasnae230@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456780'),
            'role' => 'responsable de service chirurgie',
            'depot_id' => 5,
        ]);
    }

       if (!User::where('email', 'chef@pharma.com')->exists()) {
        User::create([
            'name' => 'Chef',
            'prenom' => 'Pharmacie',
            'email' => 'chef@pharma.com',
            'email_verified_at' => now(),
            'password' => bcrypt('chef123'),
            'role' => 'chef pharmacie',
            'depot_id' => 1,
]);
    }
    if (!User::where('email', 'serviceurgences@gmail.com')->exists()) {
        User::create([
            'name' => 'service Urgences',
            'prenom' => ' Urgences',
            'email' => 'serviceurgences0@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('22222222'),
            'role' => 'responsable de service Urgences',
            'depot_id' => 2,
        ]);
    }
         if (!User::where('email', 'reanimation@pharma.com')->exists()) {
        User::create([
            'name' => 'service Réanimation',
            'prenom' => 'Réanimation',
            'email' => 'reanimation@pharma.com',
            'email_verified_at' => now(),
            'password' => bcrypt('33333333'),
            'role' => 'responsable de service Réanimation',
            'depot_id' => 3,
]);
    }
    if (!User::where('email', 'pediatrie@gmail.com')->exists()) {
        User::create([
            'name' => 'service pédiatrie',
            'prenom' => 'pédiatrie',
            'email' => 'pediatrie@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('44444444'),
            'role' => 'responsable de service  pédiatrie',
            'depot_id' => 4,
        ]);
    }

    }
}


