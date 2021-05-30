<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordonneesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordonnees', function (Blueprint $table) {
            $table->id('id_coordonnee');
            $table->string('email');
            $table->string('telephone');
            $table->string('pays');
            $table->string('ville');
            $table->string('adresse');
            $table->string('complement')->nullable();
            $table->integer('codePostal');
            //$table->foreignId('id_personne_morale')->constrained();
            //$table->foreignId('id_personne')->constrained();
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
        Schema::dropIfExists('coordonnees');
    }
}
