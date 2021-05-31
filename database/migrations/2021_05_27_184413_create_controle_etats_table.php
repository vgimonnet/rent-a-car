<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControleEtatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controles_etat', function (Blueprint $table) {
            $table->id('id_controle_etat');
            $table->timestamps();
            $table->date('date');
            $table->integer('kilometrage');
            $table->string('etat_exterieur');
            $table->string('etat_interieur');
            $table->boolean('frais_a_prevoir');
            $table->foreignId('id_employe')->nullable();//->references('id_employe')->on('employes');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controle_etats');
    }
}
