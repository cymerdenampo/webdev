<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturedPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('property_id')
                ->nullable();
            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');
            $table->text('gcash_reference_code');
            $table->text('sender_gcash_number');
            $table->string('status')->default('pending')->comment('approved|rejected');
            $table->longText('comments')->nullable()->default(null);
            $table->unsignedBigInteger('owner_id')
                ->nullable();
            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamp('from')->nullable()->default(null);
            $table->timestamp('to')->nullable()->default(null);
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
        Schema::dropIfExists('featured_payments');
    }
}
