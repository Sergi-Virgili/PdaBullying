<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefugesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refuges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');

            $table->string('logoUrl')->nullable();
            $table->string('link')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('adress')->nullable();
            $table->double('lat');
            $table->double('lng');
            $table->boolean('is_Public')->default(false);

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
        Schema::dropIfExists('resources');
    }
}
