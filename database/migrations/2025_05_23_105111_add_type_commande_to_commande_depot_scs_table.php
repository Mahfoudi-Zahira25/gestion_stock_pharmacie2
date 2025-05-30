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
    public function up(): void
    {
        Schema::table('commande_depot_scs', function (Blueprint $table) {
            $table->enum('type_commande', [
                'mensuelle',
                'retour',
                'échange',
                'décharge',
                'ordonnance',
                'supplémentaire'
            ])->after('id_depot_principale'); // adapte la colonne de référence si besoin
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('commande_depot_scs', function (Blueprint $table) {
            $table->dropColumn('type_commande');
        });
    }
};
