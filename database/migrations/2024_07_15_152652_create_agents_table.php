<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id('Agent_id');
            $table->string('Nom');
            $table->string('Prenom');
            $table->string('nomutilisateur')->unique();
            $table->string('password');
            $table->foreignId('admin_id')->constrained('admins');
            $table->timestamps();
            $table->rememberToken(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}




