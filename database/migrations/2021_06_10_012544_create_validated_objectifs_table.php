<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidatedObjectifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validated_objectifs', function (Blueprint $table) {
            $table->primary(['objectif_id','team_id']);
            $table->foreignId('objectif_id')->constrained();
            $table->foreignId('team_id')->constrained();
            $table->boolean('note');
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
        Schema::dropIfExists('validated_objectifs');
    }
}
