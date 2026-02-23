<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('node_id')
                ->constrained('nodes')
                ->onDelete('cascade');
            $table->enum('status', ['locked', 'unlocked', 'completed'])->default('locked');
            $table->integer('attempts')->default(0); // Berapa kali mencoba kuis
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Satu user hanya punya satu status per node
            $table->unique(['user_id', 'node_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
