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

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cafeteria_id');
            $table->string('name');
            $table->string('quantity')->nullable();
            $table->decimal('price', 5, 2);
            $table->string('image')->nullable();

            $table->timestamps();

            $table->foreign('cafeteria_id')
                ->references('id')->on('cafeterias')
                ->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('product_id');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')->on('products')
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_category');
    }
}
