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
        Schema::create('controle_techniques', function (Blueprint $table) {
            $table->id();
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
