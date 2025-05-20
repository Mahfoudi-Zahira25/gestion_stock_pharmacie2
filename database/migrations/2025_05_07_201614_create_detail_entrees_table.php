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
    Schema::create('detail_entrees', function (Blueprint $table) {
        $table->id();
        // $table->foreignId('id_entrée')->constrained('entrées')->onDelete('cascade');
        $table->foreignId('id_produit')->constrained('produits')->onDelete('cascade');
$table->integer('quantite_recue')->nullable();
        $table->timestamps();
        $table->unsignedBigInteger('id_entree');
$table->foreign('id_entree')->references('id_entree')->on('entrees')->onDelete('cascade');

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
