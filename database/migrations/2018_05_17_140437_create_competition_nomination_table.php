<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionNominationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_nomination', function (Blueprint $table) {
            $table->bigInteger('competition_id')->unsigned()->nullable();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');

            $table->bigInteger('nomination_id')->unsigned()->nullable();
            $table->foreign('nomination_id')->references('id')->on('nominations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_nomination');
    }
}
