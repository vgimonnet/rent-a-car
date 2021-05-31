<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationPersonneMoraleToConducteurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conducteurs', function (Blueprint $table) {
            $table->foreignId('id_personne_morale')->nullable();//->references('id_personne_morale')->on('personnes_morale');
        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conducteurs', function (Blueprint $table) {
            $table->dropForeign('id_personne_morale');
        });
    }
}
