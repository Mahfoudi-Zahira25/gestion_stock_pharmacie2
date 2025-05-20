<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sortie_internes', function (Blueprint $table) {
            $table->id('id_sortie_interne');
            $table->unsignedBigInteger('id_depot');
            $table->date('date_sortie');
            $table->string('destinataire_type'); // exemple : 'médecin', 'service', 'infirmier'
            $table->string('destinataire_nom');  // exemple : 'Dr. Laila', 'Chirurgie', 'Réanimation'
            $table->timestamps();

            // Clé étrangère
            $table->foreign('id_depot')->references('id_depot')->on('depots')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sortie_internes');
    }
};
