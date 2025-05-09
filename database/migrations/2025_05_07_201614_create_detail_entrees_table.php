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
    Schema::create('détail_entrée', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_entrée')->constrained('entrées')->onDelete('cascade');
        $table->foreignId('id_produit')->constrained('produits')->onDelete('cascade');
        $table->integer('quantité_reçue');
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
        Schema::dropIfExists('detail_entrees');
    }
};
