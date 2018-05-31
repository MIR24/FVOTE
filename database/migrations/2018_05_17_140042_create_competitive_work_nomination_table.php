<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitiveWorkNominationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitive_work_nomination', function (Blueprint $table) {
            $table->bigInteger('competitive_work_id')->unsigned()->nullable();
            $table->foreign('competitive_work_id')->references('id')->on('competitive_works')->onDelete('cascade');

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
        Schema::dropIfExists('competitive_work_nomination');
    }
}
