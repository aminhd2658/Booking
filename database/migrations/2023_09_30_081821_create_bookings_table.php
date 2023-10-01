<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->references('id')->on('rooms');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('payment_id')->nullable()->references('id')->on('payments');
            $table->integer('count_adults');
            $table->integer('count_children');
            $table->string('children_ages')->nullable();
            $table->date('start_at');
            $table->date('end_at');
            $table->enum('status', ['not_payed', 'accepted', 'rejected', 'pending'])->default('pending');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
