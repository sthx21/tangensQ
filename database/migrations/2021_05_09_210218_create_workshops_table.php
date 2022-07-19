<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->string('additional_title')->nullable();
            $table->text('detail')->nullable();
            $table->text('targets')->nullable();
            $table->text('misc')->nullable();
            $table->string('misc_link')->nullable();
            $table->string('location')->nullable();
            $table->string('price')->nullable();
            $table->json('topic_coreQuestions')->nullable();
            $table->text('process_flow')->nullable();

            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();

            $table->string('status')->nullable();
            $table->foreignId('user_id');
            $table->json('series')->nullable();
            $table->string('cancellation_date')->nullable();
            $table->string('invite_date')->nullable();
            $table->string('slug')->unique();
            $table->boolean('canceled')->default(0);
            $table->string('canceled_by')->nullable();
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
        Schema::dropIfExists('workshops');
    }
}

