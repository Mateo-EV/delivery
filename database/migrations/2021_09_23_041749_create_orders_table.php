<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 10);
            $table->string('document', 15);
            $table->string('ndocument', 10);
            $table->enum('payment', ["CONTADO", "CRÉDITO"]);
            $table->enum('channel', ["DEPÓSITO", "EFECTIVO", "MASTERCARD", "VISA"]);
            $table->string('currency', 10);
            $table->decimal('amount');
            $table->dateTime('arrival');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete("set null");
            $table->foreignUuid('customer_id')->nullable()->constrained()->onDelete("set null");
            $table->unsignedBigInteger('motorcyclist_id')->nullable();
            $table->foreign('motorcyclist_id')->references('user_id')->on('motorcyclists')->onDelete("set null");
            $table->foreignUuid('location_id')->nullable()->constrained()->onDelete("set null");
            $table->foreignUuid('laboratory_id')->nullable()->constrained()->onDelete("set null");
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
        Schema::dropIfExists('orders');
    }
}
