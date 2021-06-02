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
            // $table->foreignId('immatriculation')->nullable()->references('immatriculation')->on('vehicules')->onDelete('cascade');
            /* Ci dessous ne fonctionne pas */
            $table->foreignId('id_conducteur')->nullable();//->nullable()->references('id_conducteur')->on('conducteurs')->onDelete('cascade');
            $table->foreignId('id_employe')->nullable();//->references('id_employe')->on('employes');;
            $table->foreignId('id_vehicule')->nullable();//->references('id_employe')->on('employes');;
            $table->string('type_vehicule');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_retour')->nullable();
            $table->string('motif');
            $table->float('montant');
            $table->float('montant_paye');
            $table->unsignedBigInteger('id_controle_etat_sortie')->index()->nullable();
            $table->foreign('id_controle_etat_sortie')->references('id_controle_etat')->on('controles_etat');
            $table->unsignedBigInteger('id_controle_etat_entree')->index()->nullable();
            $table->foreign('id_controle_etat_entree')->references('id_controle_etat')->on('controles_etat');
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
