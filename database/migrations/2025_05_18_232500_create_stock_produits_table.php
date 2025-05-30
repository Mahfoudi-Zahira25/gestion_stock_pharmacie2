<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_produits', function (Blueprint $table) {
    $table->id('id_stock_produit');

    // Clé étrangère vers la table produits
    $table->unsignedBigInteger('id_produit');
    $table->foreign('id_produit')->references('id')->on('produits')->onDelete('cascade');

    // Champs métier
    $table->integer('quantite');
    $table->integer('stock_alerte')->nullable();
    $table->integer('stock_securite')->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_produits');
    }
};
