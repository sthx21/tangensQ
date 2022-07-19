<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanceledWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canceled_workshops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reason');
            $table->foreignId('trainer_id')->nullable();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('staff_id')->nullable();
            $table->foreignId('company_id')->nullable();
            $table->foreignId('workshop_id')->nullable();
            $table->foreignId('webex_id')->nullable();
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
        Schema::dropIfExists('canceled_workshops');
    }
}
