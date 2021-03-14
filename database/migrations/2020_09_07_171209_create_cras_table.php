<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCRAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cras_rh', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Projet');
            $table->integer('nbr_heures')->unsigned();
            $table->Date('Date');
            $table->enum('Ligne_de_Crédit', ['-','Congé sans solde', 'Frais généraux','Jours fériés','Jour Travaillé','Congé payé','Congé','Maladie','Autre']);

            $table->string('Commentaire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cras_rh');
    }
}
