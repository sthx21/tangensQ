<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable();
            $table->foreignId('trainer_id')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('staff_id')->nullable();
            $table->foreignId('workshop_id')->nullable();
            $table->foreignId('webex_id')->nullable();
            $table->foreignId('inhouse_id')->nullable();
            $table->foreignId('offer_id')->nullable();
            $table->foreignId('user_id');
            $table->string('title')->nullable();
            $table->string('due_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('complete')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('reminders');
    }
}
