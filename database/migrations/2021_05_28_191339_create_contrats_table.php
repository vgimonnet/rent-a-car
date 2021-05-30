<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id('id_contrat');
            $table->timestamps();
            /* L'ajout de foreign key ne fonctionne pas si la déclaration se fait avant la création de la table en question */
            $table->foreignId('immatriculation');//->references('immatriculation')->on('vehicules');
            $table->foreignId('id_conducteur');//->references('id_conducteur')->on('conducteurs');
            $table->foreignId('id_employe');//->references('id_employe')->on('employes');;
            $table->date('date_debut');
            $table->date('date_retour');
            $table->string('motif');
            $table->integer('montant');
            $table->integer('montant_paye');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrats');
    }
}
