<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions_rh', function (Blueprint $table) {
            $table->id();
            $table->string('Client');
            $table->string('Responsable');
            $table->string('Intitulé_Mission')->default('Aucune Mission en cours');;
            $table->Date('Date_Debut');
            $table->Date('Date_Fin');
            $table->integer('numéro_Bncmd_encours');
            $table->string('logo');
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
        Schema::dropIfExists('missions_rh');
    }
}
