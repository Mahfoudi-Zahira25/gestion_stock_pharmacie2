<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sortie_depots', function (Blueprint $table) {
            $table->id('id_sortie_depot');
            $table->date('date_sortie');
            $table->unsignedBigInteger('id_depot_source');
            $table->unsignedBigInteger('id_depot_destin');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('id_depot_source')->references('id_depot')->on('depots')->onDelete('restrict');
            $table->foreign('id_depot_destin')->references('id_depot')->on('depots')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sortie_depots');
    }
};
