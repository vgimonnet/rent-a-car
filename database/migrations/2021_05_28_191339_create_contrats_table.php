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
            /* Ci-dessous fonctionne */
            $table->foreignId('immatriculation')->nullable()->references('immatriculation')->on('vehicules')->onDelete('cascade');
            /* Ci dessous ne fonctionne pas */
            $table->foreignId('id_conducteur')->nullable();//->nullable()->references('id_conducteur')->on('conducteurs')->onDelete('cascade');
            $table->foreignId('id_employe')->nullable();//->references('id_employe')->on('employes');;
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
