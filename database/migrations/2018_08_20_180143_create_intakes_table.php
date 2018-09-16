<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intakes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('food_id')->nullable();
            $table->foreign('food_id')
                    ->references('id')->on('foods')
                    ->onDelete('restrict');
            $table->date('ate_on')->nullable($value = false);
            $table->string('meal')->nullable($value = false);
            $table->integer('kcal')->nullable($value = false)->unsigned();
            $table->integer('protein')->nullable($value = false)->unsigned();
            $table->integer('carb')->nullable($value = false)->unsigned();
            $table->integer('lipid')->nullable($value = false)->unsigned();
            $table->integer('weight')->nullable($value = true)->unsigned();
            $table->integer('number')->nullable($value = true)->unsigned();
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
        Schema::dropIfExists('intakes');
    }
}
