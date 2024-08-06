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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->date('transaction_date');
            $table->time('sending_time')->nullable();;
            $table->time('reception_time')->nullable();
            $table->string('status')->default("en attente");
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
