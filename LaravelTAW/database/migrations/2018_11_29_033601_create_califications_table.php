<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('califications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user_calificador');
            $table->unsignedInteger('id_user_calificado');
            $table->unsignedInteger('id_project');
            $table->string('comentario');
            $table->float('calificacion', 8, 2);
            $table->timestamps();
          
            $table->foreign('id_user_calificado')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('califications');
    }
}
