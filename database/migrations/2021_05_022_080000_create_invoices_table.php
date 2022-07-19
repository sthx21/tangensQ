<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number')->autoIncrement();
            $table->string('invoice_date')->nullable();
            $table->foreignId('offer_id')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('description')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('amount')->nullable();
            $table->string('total')->nullable();
            $table->text('free_text')->nullable();
            $table->string('payment_status')->nullable();
            $table->integer('discount')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
