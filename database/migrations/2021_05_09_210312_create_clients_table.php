<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('origin')->nullable();
            $table->string('lead_position')->nullable();
            $table->string('old_id')->nullable();
            $table->string('position')->nullable();
            $table->foreignId('company_id')->default(1);
            $table->foreignId('second_company_id')->nullable();
            $table->string('department')->nullable();
            $table->string('academic_title')->nullable();
            $table->string('title')->nullable();;
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
            $table->string('additional_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('office_zip')->nullable();
            $table->string('office_house_number')->nullable();
            $table->string('office_street')->nullable();
            $table->string('office_additional_address')->nullable();
            $table->string('office_city')->nullable();
            $table->string('office_state')->nullable();
            $table->string('office_country')->nullable();
            $table->string('address_origin')->nullable();
            $table->string('homepage')->nullable();
            $table->text('info')->nullable();
            $table->text('about')->nullable();
            $table->string('slug')->unique();
            $table->string('newsletter')->default(false)->nullable();
            $table->boolean('active')->default(1);
            $table->string('inactive_date')->nullable();
            $table->text('last_note')->nullable();
            $table->text('function')->nullable();
            $table->string('responsible')->nullable();
            $table->string('revenue')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
