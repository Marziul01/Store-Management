<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('total',10,2);
            $table->double('discount', 10,2)->nullable();
            $table->double('grand_total',10,2);
            $table->string('name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('note')->nullable();
            $table->string('invoice')->nullable();
            $table->integer('payment_status')->default(1);
            $table->tinyInteger('status')->default();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
