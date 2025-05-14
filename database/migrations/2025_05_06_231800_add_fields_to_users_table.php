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
    Schema::table('users', function (Blueprint $table) {
        $table->string('prenom')->after('name');
        $table->string('role')->default('pharmacien'); // ou 'responsable'
        $table->unsignedBigInteger('depot_id')->nullable()->after('id'); // Créer la colonne
        // Définir la clé étrangère ensuite
        $table->foreign('depot_id')->references('id_depot')->on('depots')->onDelete('set null');
       // $table->unsignedBigInteger('id_depot')->nullable();

      
//$table->foreign('depot_id')->references('id_depot')->on('depots')->onDelete('set null');

    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
