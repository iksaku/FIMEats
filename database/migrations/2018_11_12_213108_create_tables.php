<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_name');
            $table->text('maps_url')->nullable();

            $table->timestamps();
        });

        Schema::create('cafeterias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('faculty_id');
            $table->string('name');

            $table->timestamps();

            $table->foreign('faculty_id')
                ->references('id')->on('faculties')
                ->onDelete('cascade');
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cafeteria_id');
            $table->string('name')->nullable();

            $table->timestamps();

            $table->foreign('cafeteria_id')
                ->references('id')->on('cafeterias')
                ->onDelete('cascade');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
        });

        Schema::create('consumables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id');
            $table->string('name');
            $table->decimal('price', 5, 2);
            $table->string('image')->nullable();

            $table->timestamps();

            $table->foreign('menu_id')
                ->references('id')->on('menus')
                ->onDelete('cascade');
        });

        Schema::create('category_consumable', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('consumable_id');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('consumable_id')
                ->references('id')->on('consumables')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties');
        Schema::dropIfExists('cafeterias');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('consumables');
        Schema::dropIfExists('consumable_category');
    }
}
