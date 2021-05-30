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
            $table->foreignId('immatriculation');//->references('immatriculation')->on('vehicules');
            $table->timestamps();
            $table->boolean('conforme');
            $table->dateTime('date_controle');
            $table->boolean('contre_visite');
            $table->dateTime('date_contre_visite');
            $table->string('commentaire');
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
