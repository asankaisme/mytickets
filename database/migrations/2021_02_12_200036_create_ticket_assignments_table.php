<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('ticket_header_id')->nullable();
            $table->unsignedBigInteger('ticket_priority_id')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->string('status')->default(1);
            $table->integer('isActive')->default(1);

            $table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('ticket_header_id')->references('id')->on('ticket_headers')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('ticket_priority_id')->references('id')->on('ticket_priorities')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('assigned_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('assigned_to')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_assignments');
    }
}
