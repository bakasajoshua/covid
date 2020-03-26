<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_samples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('original_sample_id')->index()->nullable();
            $table->integer('patient_id')->index()->nullable();
            $table->tinyInteger('lab_id')->nullable();
            $table->tinyInteger('health_status')->nullable();
            $table->string('symptoms')->nullable();
            $table->tinyInteger('temperature')->nullable();
            $table->string('observed_signs')->nullable();
            $table->string('underlying_conditions')->nullable();
            $table->string('occupation', 80)->nullable();
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
        Schema::dropIfExists('covid_samples');
    }
}
