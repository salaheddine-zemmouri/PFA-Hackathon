<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionEvaluatorObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_evaluator_objectives', function (Blueprint $table) {
            $table->primary(['competition_id','evaluator_id','objective_id']);
            $table->foreignId('competition_id')->constrained();
            $table->foreignId('evaluator_id')->constrained();
            $table->foreignId('objective_id')->default(0)->constrained();
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
        Schema::dropIfExists('competition_evaluator_objectives');
    }
}
