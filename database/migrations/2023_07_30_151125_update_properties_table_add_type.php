<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertiesTableAddType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_user_id')
                ->nullable();
            $table->foreign('created_by_user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->text('lat')->nullable()->default(null);
            $table->text('lng')->nullable()->default(null);
            $table->text('country')->nullable()->default(null);
            $table->text('province')->nullable()->default(null);
            $table->text('city')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['created_by_user_id']);
            $table->dropColumn('created_by_user_id');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
            $table->dropColumn('country');
            $table->dropColumn('province');
            $table->dropColumn('city');
        });
    }
}
