<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camions', function (Blueprint $table) {
            $table->bigIncrements('IdPassage');           
            $table->string('Immatriculation');
            $table->string('Type');            
            $table->string('Operation');
            $table->string('heure_enregistrement');
            $table->string('Numero_Bl')->nullable();
            $table->string('heure_sortie')->nullable();
            $table->string('Sejour')->nullable();
            $table->string('Cin_transporteur');
            $table->string('Nom_transporteur');
            $table->string('Prenom_transporteur');
            
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types_vehicule');
            
            $table->unsignedBigInteger('admin_id')->nullable(); // Assurez-vous que c'est nullable si pas toujours présent
            $table->unsignedBigInteger('agent_id')->nullable(); // Assurez-vous que c'est nullable si pas toujours présent
        
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('agent_id')->references('Agent_id')->on('agents')->onDelete('set null');
            //$table->timestamp('heureenregistrement')->useCurrent();
            //$table->unsignedBigInteger('transporteur_id');
            //$table->foreign('transporteur_id')->references('IdPassage')->on('camions');
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
        Schema::dropIfExists('camions');
    }
}
