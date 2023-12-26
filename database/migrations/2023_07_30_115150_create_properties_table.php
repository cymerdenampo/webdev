<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->decimal('price', 9, 2)->default(0.00);
            $table->longText('description');
            $table->string('type')->default('sale')->comment('lease|sale');
            $table->string('location')->nullable()->default(null);
            $table->string('status')->default('inactive')->comment('active|inactive');
            $table->integer('area')->default(0);
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
        Schema::dropIfExists('properties');
    }
}
