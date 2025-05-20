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
        Schema::create('detail_commande_depot_scs', function (Blueprint $table) {
    $table->id('id_detail_cmd_depot_sc');

    $table->foreignId('id_cmd_sc')
        ->constrained('commande_depot_scs', 'id_cmd_sc')
        ->onDelete('cascade');

    $table->foreignId('id_produit')
        ->constrained('produits', 'id')
        ->onDelete('cascade');

    $table->integer('quantite_cmd');

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
        Schema::dropIfExists('detail_commande_depot_scs');
    }
};
