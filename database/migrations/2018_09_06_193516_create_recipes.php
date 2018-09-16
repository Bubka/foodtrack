<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable($value = false)->unique();
            $table->integer('kcal')->nullable($value = false)->unsigned();
            $table->integer('protein')->nullable($value = false)->unsigned();
            $table->integer('carb')->nullable($value = false)->unsigned();
            $table->integer('lipid')->nullable($value = false)->unsigned();
            $table->timestamps();
        });

        Schema::create('food_recipe', function (Blueprint $table) {
            $table->integer('food_id')->unsigned()->index();
            $table->foreign('food_id')
                    ->references('id')->on('foods')
                    ->onDelete('cascade');

            $table->integer('recipe_id')->unsigned()->index();
            $table->foreign('recipe_id')
                    ->references('id')->on('recipes')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('food_recipe');
    }
}
