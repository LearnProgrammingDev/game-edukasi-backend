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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['materi', 'kuis', 'percabangan']);
            $table->longText('content')->nullable(); // Isi materi format Markdown
            $table->integer('x_position')->default(0); // Koordinat X di peta Flutter
            $table->integer('y_position')->default(0); // Koordinat Y di peta Flutter
            $table->integer('order')->default(0);      // Urutan node di roadmap
            $table->integer('exp_reward')->default(100); // EXP yang didapat jika selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};
