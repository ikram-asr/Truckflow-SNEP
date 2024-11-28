<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeureAffectationBlToCamionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camions', function (Blueprint $table) {
            $table->timestamp('heure_affectation_bl')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camions', function (Blueprint $table) {
            $table->dropColumn('heure_affectation_bl'); // Supprimer la colonne en cas de rollback
        });
    }
}
