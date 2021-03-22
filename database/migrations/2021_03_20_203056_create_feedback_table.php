<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->string('level');
            $table->string('feedback', 255);
            $table->unsignedBigInteger('given_by')->nullable();
            $table->unsignedBigInteger('given_to')->nullable();

            $table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('given_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('given_to')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
