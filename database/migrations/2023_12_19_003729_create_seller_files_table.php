<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->longText('purok')->nullable()->default(null);
            $table->longText('brgy')->nullable()->default(null);
            $table->longText('police')->nullable()->default(null);
            $table->longText('nbi')->nullable()->default(null);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('seller_files');
    }
}
