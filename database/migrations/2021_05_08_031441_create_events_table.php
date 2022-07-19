<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location')->nullable();
            $table->string('company')->nullable();
            $table->string('offer_number')->nullable();
            $table->foreignId('user_id');
            $table->string('first_trainer_name')->nullable();
            $table->string('second_trainer_name')->nullable();
            $table->string('start');
            $table->string('end')->nullable();
            $table->string('startTime')->nullable();
            $table->string('endTime')->nullable();
            $table->boolean('allDay')->default(0);
            $table->boolean('booked')->default(0);
            $table->string('groupId')->nullable();
            $table->string(('type'))->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
