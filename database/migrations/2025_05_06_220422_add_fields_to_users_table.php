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
        $table->unsignedBigInteger('id_depot')->nullable();

        $table->foreign('id_depot')->references('id')->on('depots')->onDelete('set null');
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
