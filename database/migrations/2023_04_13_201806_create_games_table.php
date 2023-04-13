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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('token_id');
            $table->integer('random_number');
            $table->enum('result', ['win', 'lose']);
            $table->integer('winning_amount')->default(0);
            $table->timestamps();

            $table->foreign('token_id')->references('id')->on('tokens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
