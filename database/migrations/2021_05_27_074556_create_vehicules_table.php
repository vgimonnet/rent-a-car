<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id('immatriculation');
            $table->timestamps();
            $table->boolean('disponible');
            $table->float('poids');
            $table->string('marque');
            $table->string('modele');
            $table->float('cout_par_jour');
            $table->date('date_achat');
            $table->string('couleur');
            $table->tinyInteger('places');
            $table->float('contenance_coffre');
            $table->string('hauteur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicules');
    }
}
