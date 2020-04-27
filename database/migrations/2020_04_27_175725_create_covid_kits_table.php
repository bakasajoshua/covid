<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_kits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('material_no');
            $table->string('product_description');
            $table->double('pack_size')->nullable();
            $table->double('calculated_pack_size')->nullable();
            $table->enum('type', ['Kit', 'Consumable', 'Manual']);
            $table->string('unit')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('covid_kits');
    }
}
