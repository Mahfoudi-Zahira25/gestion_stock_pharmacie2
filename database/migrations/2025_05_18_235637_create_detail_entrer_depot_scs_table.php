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
        Schema::create('detail_entrer_depot_scs', function (Blueprint $table) {
    $table->id('id_detail_entrer_depot_sc');
    $table->foreignId('id_entrer_depot_sc')
        ->constrained('entrer_depot_scs', 'id_entrer_depot_sc')
        ->onDelete('cascade');
    $table->foreignId('id_produit')
        ->constrained('produits', 'id')
        ->onDelete('cascade');
    $table->integer('quantite_recus');
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
        Schema::dropIfExists('detail_entrer_depot_scs');
    }
};
