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
        Schema::create('node_connections', function (Blueprint $table) {
            $table->id();
            // Node asal (yang harus diselesaikan dulu)
            $table->foreignId('source_node_id')
                ->constrained('nodes')
                ->onDelete('cascade');
            // Node tujuan (yang akan terbuka setelah source selesai)
            $table->foreignId('target_node_id')
                ->constrained('nodes')
                ->onDelete('cascade');
            $table->timestamps();

            // Pastikan tidak ada koneksi duplikat
            $table->unique(['source_node_id', 'target_node_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_connections');
    }
};
