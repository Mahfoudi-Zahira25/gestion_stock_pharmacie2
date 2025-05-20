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
       Schema::create('alerte_stocks', function (Blueprint $table) {
    $table->id('id_alert');

    // Dépôt concerné
    $table->unsignedBigInteger('id_depot');
    $table->foreign('id_depot')
        ->references('id_depot')
        ->on('depots')
        ->onDelete('cascade');

    // Produit concerné
    $table->unsignedBigInteger('id_produit');
    $table->foreign('id_produit')
        ->references('id')
        ->on('produits')
        ->onDelete('cascade');

    // Type d’alerte : "alerte", "rupture", "sécurité", etc.
    $table->string('type_alerte');

    // Date à laquelle l’alerte est générée
    $table->date('date_alerte');

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
        Schema::dropIfExists('alerte_stocks');
    }
};
