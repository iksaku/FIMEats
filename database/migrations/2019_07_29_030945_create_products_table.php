<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('cafeteria_id');
            $table->string('name');
            $table->string('quantity')->nullable();
            $table->decimal('price', 5, 2);
            $table->string('image')->nullable();

            $table->timestamps();

            $table->foreign('cafeteria_id')
                ->references('id')->on('cafeterias')
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
        Schema::dropIfExists('products');
    }
}
