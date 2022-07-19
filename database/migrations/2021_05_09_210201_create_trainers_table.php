<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('company_id');
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('second_email')->nullable();
            $table->text('phone')->nullable();
            $table->text('second_phone')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('zip')->nullable();
            $table->string('house_number')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('company_name')->nullable();
            $table->string('additional_address')->nullable();
            $table->string('homepage')->nullable();
            $table->text('info')->nullable();
            $table->string('slug')->unique();
            $table->boolean('active')->default(1);
            $table->string('inactive_date')->nullable();
            $table->foreignId('user_id');
            $table->string('coaching_fee_per_hour')->nullable();
            $table->string('training_fee_per_day')->nullable();
            $table->string('consulting_fee_per_day')->nullable();
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
        Schema::dropIfExists('trainers');
    }
}
