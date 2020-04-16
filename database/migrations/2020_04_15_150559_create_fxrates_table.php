<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFxratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxrates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fxcounter_id');
            $table->float('rate', 8, 5);
            $table->timestamps();
            $table->foreign('fxcounter_id')
                  ->references('id')
                  ->on('fxcounters')
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
        Schema::dropIfExists('fxrates');
    }
}
