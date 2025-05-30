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
    Schema::create('sortie_par_commandes', function (Blueprint $table) {
        $table->id();
        // Correction ici :
        $table->unsignedBigInteger('id_cmd_sc');
        $table->foreign('id_cmd_sc')->references('id_cmd_sc')->on('commande_depot_scs')->onDelete('cascade');

        $table->foreignId('id_sortie_depot')->constrained('sortie_depots', 'id_sortie_depot');
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
        Schema::dropIfExists('sortie_par_commandes');
    }
};
