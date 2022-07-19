<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebExesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webexes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('additional_title')->nullable();
            $table->text('detail')->nullable();
            $table->text('targets')->nullable();
            $table->text('misc')->nullable();
            $table->string('misc_link')->nullable();
            $table->string('price')->nullable();
            $table->json('topic_coreQuestions')->nullable();
            $table->text('process_flow')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('start_date_part_two');
            $table->date('end_date_part_two')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('start_time_part_two')->nullable();
            $table->string('end_time_part_two')->nullable();
            $table->integer('series_two')->nullable();
            $table->integer('series_three')->nullable();
            $table->integer('chatroom')->nullable();
            $table->date('cancellation_date')->nullable();
            $table->date('invite_date')->nullable();
            $table->string('slug')->unique();

            $table->integer('webex_id')->nullable();
            $table->integer('meetingNumber')->nullable();
            $table->string('agenda')->nullable();
            $table->string('password')->nullable();
            $table->string('phoneAndVideoSystemPassword')->nullable();
            $table->string('meetingType')->nullable();
            $table->string('state')->nullable();
            $table->string('timezone')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('hostUserId')->nullable();
            $table->string('hostDisplayName')->nullable();
            $table->string('hostEmail')->nullable();
            $table->string('hostKey')->nullable();
            $table->string('siteUrl')->nullable();
            $table->string('sipAddress')->nullable();
            $table->string('dialInIpAddress')->nullable();
            $table->string('enabledAutoRecordMeeting')->nullable();
            $table->string('allowAuthenticatedDevices')->nullable();
            $table->string('enabledJoinBeforeHost')->nullable();
            $table->string('joinBeforeHostMinutes')->nullable();
            $table->string('enableConnectAudioBeforeHost')->nullable();
            $table->string('excludePassword')->nullable();
            $table->string('publicMeeting')->nullable();
            $table->string('enableAutomaticLock')->nullable();
            $table->string('webLink')->nullable();

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
        Schema::dropIfExists('webexes');
    }
}

