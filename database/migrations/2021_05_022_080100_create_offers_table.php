<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('offer_number');
            $table->string('offer_date')->nullable();
            $table->string('valid_until')->nullable();
            $table->string('target_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('confirmation_date')->nullable();
            $table->string('completion_date')->nullable();
            $table->text('special_agreement')->nullable();
            $table->string('status')->nullable();
            $table->string('amount')->nullable();
            $table->text('about')->nullable();
            $table->foreignId('user_id');
            $table->string('type')->nullable();
            $table->string('discount')->nullable();
            $table->longText('clientMembers')->nullable();
            $table->longText('staffMembers')->nullable();
            $table->longText('history')->nullable();
            $table->longText('events')->nullable();
            $table->string('slug')->unique();
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
        Schema::dropIfExists('offers');
    }
}
