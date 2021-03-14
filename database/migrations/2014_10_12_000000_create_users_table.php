<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_rh', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type_users', ['admin', 'consultant','salarié']);  
            $table->string('email')->unique();
            $table->string('CIN');
            $table->Integer('numéro_CNSS');
            $table->Integer('nbr_enfant');
            $table->string('Adresse');
            $table->string('téléphone');
            $table->enum('situation_familiale', ['-','Célibataire', 'divorcé(e)','marié(é)','Veuf(ve)']);
            $table->enum('Materiel_Télé', ['-','Samsung', 'Iphone','Oppo']);
            $table->enum('Materiel_Voiture', ['-','Peugeot','Nissan','Renault']);
            $table->enum('Materiel_Pc', ['-','Hp', 'Azus','Lenovo']);
            
            $table->date("Date_entrée");
            $table->boolean('is_affected')->default(false);
            
           

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->rememberToken();
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
        Schema::dropIfExists('users_rh');
    }
}
