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
        Schema::create('dynlists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dynlist_id');
            $table->unsignedBigInteger('reg_id');
            $table->string('field');
            $table->string('value');
            $table->timestamps();

            $table->foreign('dynlist_id')->references('id')->on('dynlists')
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
            $table->dropForeign('fields_dynlist_id_foreign');
        });
        Schema::dropIfExists('dynlists');
        Schema::dropIfExists('fields');
    }
};
