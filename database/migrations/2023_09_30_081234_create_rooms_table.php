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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stay_id')->references('id')->on('stays');
            $table->string('name');
            $table->text('description')->nullable();

            $table->integer('count');

            $table->integer('max_count_adults');
            $table->integer('max_count_children');

            $table->integer('price_per_night');
            $table->integer('discount_price_per_night')->nullable();
            $table->integer('final_price_per_night');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
