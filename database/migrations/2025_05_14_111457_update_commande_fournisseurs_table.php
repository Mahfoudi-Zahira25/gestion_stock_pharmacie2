<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCommandeFournisseursTable extends Migration
{
    public function up()
    {
        Schema::table('commande_fournisseurs', function (Blueprint $table) {
            // Supprime seulement ce qui n’existe pas déjà
            $table->dropForeign(['utilisateur_id']);
            $table->dropColumn('utilisateur_id');
            $table->dropColumn('type');
            $table->dropColumn('remarque');

            // Ajoute seulement les nouvelles colonnes
            $table->unsignedBigInteger('id_fournisseur');
            $table->date('date_commande');
            $table->string('statut')->default('en cours');

            // Déclare les clés étrangères
            $table->foreign('id_fournisseur')->references('id')->on('fournisseurs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('commande_fournisseurs', function (Blueprint $table) {
            $table->dropForeign(['id_fournisseur']);

            $table->dropColumn(['id_fournisseur', 'date_commande', 'statut']);

            // (optionnel) Réajouter les anciennes colonnes si rollback
            $table->unsignedBigInteger('utilisateur_id');
            $table->unsignedBigInteger('id_depot');
            $table->string('type');
            $table->text('remarque')->nullable();
        });
    }
}