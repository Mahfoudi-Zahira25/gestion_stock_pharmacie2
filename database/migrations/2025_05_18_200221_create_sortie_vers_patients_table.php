<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sortie_vers_patients', function (Blueprint $table) {
            $table->id('id_sortie_vers_patient');
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('id_depot');
            $table->date('date_sortie');
            $table->timestamps();

            // Clés étrangères (à ajouter si les tables cibles existent déjà)
            $table->foreign('id_patient')->references('id_patient')->on('patients')->onDelete('cascade');
            $table->foreign('id_depot')->references('id_depot')->on('depots')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sortie_vers_patients');
    }
};
