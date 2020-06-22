<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCredentialRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credential_requests', function (Blueprint $table) {
            $table->id();
            $table->string('email', 80);
            $table->string('name', 100);
            $table->string('organisation', 100);
            $table->string('phone_number', 20)->nullable();
            $table->string('details');
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
        Schema::dropIfExists('credential_requests');
    }
}
