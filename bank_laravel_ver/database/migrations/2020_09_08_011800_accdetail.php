<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Accdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accdetails', function (Blueprint $table) {
            $table->Increments('adid');
            $table->foreignId('id');
            $table->foreign('id')->references('id')->on('users')->ondelete('cascade');
            $table->integer('operate');
            $table->integer('operate')->nullable()->change();
            $table->integer('amount');
            $table->integer('amount')->nullable()->change();
            $table->timestamp('ts')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
