<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('old_id')->nullable();
            $table->string('company_group_id')->nullable();
            $table->foreignId('user_id')->default(2);
            $table->string('name');
            $table->string('management')->nullable();
            $table->string('homepage')->nullable();
            $table->string('main_email')->nullable();
            $table->string('second_email')->nullable();
            $table->string('main_phone')->nullable();
            $table->string('second_phone')->nullable();
            $table->string('phone_office')->nullable();
            $table->string('fax_number')->nullable();
            $table->string('zip')->nullable();
            $table->string('house_number')->nullable();
            $table->string('street')->nullable();
            $table->string('additional_address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('address_origin')->nullable();
            $table->string('billing_zip')->nullable();
            $table->string('billing_house_number')->nullable();
            $table->string('billing_street')->nullable();
            $table->string('billing_additional_address')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('last_note')->nullable();
            $table->string('managed_by')->nullable();
            $table->text('info')->nullable();
            $table->text('about')->nullable();
            $table->string('newsletter')->default(false)->nullable();
            $table->string('revenue')->nullable();

            $table->string('slug')->unique();
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
        Schema::dropIfExists('companies');
    }
}
