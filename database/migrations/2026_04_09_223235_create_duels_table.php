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
        Schema::create('duels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('challenger_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('defender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            
            $table->integer('challenger_score')->nullable();
            $table->unsignedBigInteger('challenger_time_ms')->nullable();
            
            $table->integer('defender_score')->nullable();
            $table->unsignedBigInteger('defender_time_ms')->nullable();
            
            $table->enum('status', ['pending', 'open', 'completed', 'expired'])->default('pending');
            $table->foreignId('winner_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duels');
    }
};
