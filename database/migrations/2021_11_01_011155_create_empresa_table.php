<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name')->index();
            $table->string('nit')->nullable();
            $table->string('dir')->nullable();
            $table->string('tel')->nullable();
            $table->string('logo')->nullable();
            $table->string('img')->nullable();
            $table->string('wsp1',25)->nullable();
            $table->string('wsp2',25)->nullable();
            $table->boolean('status',1)->default(1);
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('empresas');
    }
}
