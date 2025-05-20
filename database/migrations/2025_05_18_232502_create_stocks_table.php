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
         Schema::create('stocks', function (Blueprint $table) {
    $table->id('id_stock');

    // Clé étrangère vers le stock produit
    $table->unsignedBigInteger('id_stock_produit');
    $table->foreign('id_stock_produit')
        ->references('id_stock_produit')
        ->on('stock_produits')
        ->onDelete('cascade');

    // Clé étrangère vers le dépôt
    $table->unsignedBigInteger('id_depot');
    $table->foreign('id_depot')
        ->references('id_depot')
        ->on('depots')
        ->onDelete('cascade');

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
        Schema::dropIfExists('stocks');
    }
};
