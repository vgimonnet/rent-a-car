<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControleTechniquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controles_technique', function (Blueprint $table) {
            $table->id('id_controle_technique');
            $table->string('id_vehicule')->index();
            $table->boolean('conforme')->nullable();
            $table->date('date_controle');
            $table->boolean('contre_visite')->nullable();
            $table->date('date_contre_visite')->nullable();
            $table->string('commentaire');
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
        Schema::dropIfExists('controle_techniques');
    }
}
