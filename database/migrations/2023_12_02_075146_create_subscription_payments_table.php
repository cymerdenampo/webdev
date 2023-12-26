<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('gcash_reference_code');
            $table->text('sender_gcash_number')->nullable()->default(null);
            $table->string('status')->default('pending')->comment('approved|rejected');
            $table->longText('comments')->nullable()->default(null);
            $table->unsignedBigInteger('user_id')
                ->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamp('from')->nullable()->default(null);
            $table->timestamp('to')->nullable()->default(null);
            $table->text('plan');
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
        Schema::dropIfExists('subscription_payments');
    }
}
