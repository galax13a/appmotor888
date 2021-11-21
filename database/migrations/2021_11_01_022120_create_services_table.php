<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('value')->default(0)->nullable();
            $table->boolean('status')->default(1);
            $table->float('porcentaje')->nullable()->default(40);
            $table->unsignedBigInteger('cars_id');
            $table->foreign('cars_id')->references('id')->on('carstypes');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas');
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
        Schema::dropIfExists('services');
    }
}
