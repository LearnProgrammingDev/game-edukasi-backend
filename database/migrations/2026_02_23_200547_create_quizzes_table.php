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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_id')
                ->constrained('nodes')
                ->onDelete('cascade');
            $table->enum('type', ['multiple_choice', 'fill_blank', 'arrange_code']);
            $table->text('question');  // Soal pertanyaan
            $table->json('options')->nullable();
            // Untuk multiple_choice: ["A. echo", "B. print", "C. return", "D. var"]
            // Untuk arrange_code: ["$b=2;", "$a=1;", "echo $a+$b;"] (urutan acak)
            // Untuk fill_blank: null (tidak perlu pilihan)

            $table->string('correct_answer');
            // Untuk multiple_choice : "A"
            // Untuk fill_blank      : "echo"
            // Untuk arrange_code    : "1,0,2" (index urutan yang benar)

            $table->text('hint')->nullable(); // Petunjuk jika jawaban salah
            $table->integer('order')->default(1); // Urutan soal jika ada banyak soal per node
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
