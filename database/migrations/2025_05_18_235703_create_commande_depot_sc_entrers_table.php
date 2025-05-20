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
       Schema::create('commande_depot_sc_entrer', function (Blueprint $table) {
    $table->id();

    $table->foreignId('id_cmd_sc')
        ->constrained('commande_depot_scs', 'id_cmd_sc')
        ->onDelete('cascade');

    $table->foreignId('id_entrer_depot_sc')
        ->constrained('entrer_depot_scs', 'id_entrer_depot_sc')
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
        Schema::dropIfExists('commande_depot_sc_entrers');
    }
};
