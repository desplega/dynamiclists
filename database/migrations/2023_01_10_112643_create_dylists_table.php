<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dylists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dylist_id');
            $table->string('field');
            $table->string('value');
            $table->timestamps();

            $table->foreign('dylist_id')->references('id')->on('dylists')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fields', function(Blueprint $table) {
            $table->dropForeign('fields_dylist_id_foreign');
        });
        Schema::dropIfExists('dylists');
        Schema::dropIfExists('fields');
    }
};
