<?php

use App\Models\Depot;
use App\Models\DetailCommande;
use App\Models\Fournisseur;
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
    Schema::create('commande_fournisseurs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('utilisateur_id');
        $table->unsignedBigInteger('depot_id');
        $table->enum('type', ['mensuelle', 'retour', 'échange', 'ordonnance', 'décharge', 'supplémentaire']);
        $table->text('remarque')->nullable();
        $table->timestamps();

        $table->foreign('utilisateur_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('depot_id')->references('id_depot')->on('depots')->onDelete('cascade');
    });
}

    // Relationship methods removed. Define them in the corresponding Eloquent model.
        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande_fournisseurs');
    }
};
