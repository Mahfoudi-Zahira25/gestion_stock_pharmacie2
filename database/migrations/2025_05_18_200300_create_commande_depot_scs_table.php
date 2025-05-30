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
       Schema::create('commande_depot_scs', function (Blueprint $table) {
    $table->id('id_cmd_sc');

    $table->foreignId('id_depot_sc')
        ->constrained('depots', 'id_depot')
        ->onDelete('cascade');

    $table->foreignId('id_depot_principale')
        ->constrained('depots', 'id_depot')
        ->onDelete('cascade');

    $table->date('date_cmd');
    $table->string('statut'); // Exemple : "en_attente", "validée", "livrée", etc.

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
        Schema::dropIfExists('commande_depot_scs');
    }
};
