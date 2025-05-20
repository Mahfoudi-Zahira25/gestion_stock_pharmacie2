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
       Schema::create('entrer_depot_scs', function (Blueprint $table) {
    $table->id('id_entrer_depot_sc');
    $table->foreignId('id_depot_source')->constrained('depots', 'id_depot')->onDelete('cascade');
    $table->foreignId('id_depot_destination')->constrained('depots', 'id_depot')->onDelete('cascade');
    $table->date('date_entrer');
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
        Schema::dropIfExists('entrer_depot_scs');
    }
};
