<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesUtilitaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules_utilitaire', function (Blueprint $table) {
            $table->id('id_vehicule');
            $table->string('immatriculation')->unique();
            $table->boolean('disponible');
            $table->integer('poid');
            $table->string('marque');
            $table->string('modele');
            $table->float('cout_par_jour');
            $table->date('date_anciennete');
            $table->string('couleur');
            $table->smallInteger('places');
            $table->integer('contenance_coffre');
            $table->float('hauteur');
            $table->boolean('benne');
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
        Schema::dropIfExists('vehicules_utilitaire');
    }
}
