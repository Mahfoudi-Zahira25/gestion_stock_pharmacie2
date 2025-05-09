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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->enum('type', ['médicament', 'dispositif médical']);
            $table->string('forme')->nullable(); // ex: comprimé, ampoule
            $table->string('unite')->nullable(); // ex: boîte, flacon
            $table->integer('stock_initial')->default(0);
            $table->integer('stock_securite')->default(0);
            $table->integer('stock_alerte')->default(0);
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
        Schema::dropIfExists('produits');
    }
};
