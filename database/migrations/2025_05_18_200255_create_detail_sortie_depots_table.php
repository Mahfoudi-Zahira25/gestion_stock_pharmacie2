<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_sortie_depots', function (Blueprint $table) {
            $table->id('id_detail_sortie_depot');
            $table->unsignedBigInteger('id_sortie_depot');
            $table->unsignedBigInteger('id_produit');
            $table->integer('quantite');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('id_sortie_depot')->references('id')->on('sortie_depots')->onDelete('cascade');
            $table->foreign('id_produit')->references('id')->on('produits')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_sortie_depots');
    }
};
