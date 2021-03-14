<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_rh', function (Blueprint $table) {
            $table->id();
            
            $table->string('name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_size')->nullable();
            $table->boolean('is_approved')->default(false);
          
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
        Schema::dropIfExists('documents_rh');
    }
}
