<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable($value = false)->unique();
            $table->integer('kcal')->nullable($value = false)->unsigned();
            $table->integer('protein')->nullable($value = false)->unsigned();
            $table->integer('carb')->nullable($value = false)->unsigned();
            $table->integer('lipid')->nullable($value = false)->unsigned();
            $table->integer('baseWeight')->nullable($value = false)->unsigned()->default('100');
            $table->integer('unitWeight')->nullable()->unsigned();
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
        Schema::dropIfExists('foods');
    }
}
