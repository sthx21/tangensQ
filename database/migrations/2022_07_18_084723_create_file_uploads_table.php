<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_uploads', function (Blueprint $table) {
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
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
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
        Schema::dropIfExists('file_uploads');
    }
};
