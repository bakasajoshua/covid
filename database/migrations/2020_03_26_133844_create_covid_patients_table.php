<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('original_patient_id')->index()->nullable();
            $table->integer('facility_id')->nullable();
            $table->integer('case_id')->nullable();
            $table->tinyInteger('identifier_type_id')->nullable();
            $table->string('identifier');
            $table->string('patient_name');

            $table->string('county', 20)->nullable();
            $table->string('subcounty', 30)->nullable();
            $table->string('ward', 30)->nullable();
            $table->string('residence', 40)->nullable();

            $table->date('dob')->nullable();
            $table->tinyInteger('sex')->nullable();

            $table->tinyInteger('current_health_status')->nullable();

            $table->date('date_symptoms')->nullable();
            $table->date('date_admission')->nullable();
            $table->date('date_isolation')->nullable();
            $table->date('date_death')->nullable();

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
        Schema::dropIfExists('covid_patients');
    }
}
