<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('property_id')->nullable();
            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');

            $table->unsignedBigInteger('visitor_id')->nullable();
            $table->foreign('visitor_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->text('role')->nullable()->default('buyer');

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
        Schema::dropIfExists('visits');
    }
}
