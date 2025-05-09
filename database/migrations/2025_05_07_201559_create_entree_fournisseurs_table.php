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
        Schema::create('entrées', function (Blueprint $table) {
            $table->id('id_entrée');
            $table->foreignId('id_commande')->nullable()->constrained('commande_fournisseur')->onDelete('set null');
            $table->foreignId('id_dépôt')->constrained('dépôts')->onDelete('cascade');
            $table->foreignId('id_fournisseur')->nullable()->constrained('fournisseurs')->onDelete('set null');
            $table->date('date_entrée');
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
        Schema::dropIfExists('entree_fournisseurs');
    }
};
