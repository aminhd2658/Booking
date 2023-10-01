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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stay_id')->references('id')->on('stays');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('parent_id')->nullable()->references('id')->on('comments');
            $table->enum('star', [1, 2, 3, 4, 5]);
            $table->text('content');
            $table->enum('status', ['accepted', 'rejected', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
