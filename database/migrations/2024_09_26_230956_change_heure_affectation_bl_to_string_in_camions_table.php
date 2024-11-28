<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHeureAffectationBlToStringInCamionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camions', function (Blueprint $table) {
            // Remplacez la colonne `heure_affectation_bl` de timestamp à string
            $table->string('heure_affectation_bl')->nullable()->change(); 
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
            // Rétablir la colonne à son ancien type en cas de rollback
            $table->timestamp('heure_affectation_bl')->nullable()->change(); 
        });
    }
}
