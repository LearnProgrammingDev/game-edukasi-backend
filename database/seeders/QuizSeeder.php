<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Node;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $kuisPengenalan = Node::where('title', 'Kuis: Pengenalan')->first();
        $kuisRouting    = Node::where('title', 'Kuis: Routing')->first();
        $kuisController = Node::where('title', 'Kuis: Controller')->first();

        // ===========================
        // KUIS 1: PENGENALAN
        // ===========================

        Quiz::create([
            'node_id'        => $kuisPengenalan->id,
            'type'           => 'multiple_choice',
            'question'       => 'Laravel adalah framework untuk bahasa pemrograman apa?',
            'options'        => ['A. Python', 'B. PHP', 'C. JavaScript', 'D. Ruby'],
            'correct_answer' => 'B. PHP',
            'hint'           => 'Lihat lagi ringkasan di atas. Laravel sangat populer di ekosistem backend web.',
            'order'          => 1,
        ]);

        Quiz::create([
            'node_id'        => $kuisPengenalan->id,
            'type'           => 'multiple_choice',
            'question'       => 'MVC singkatan dari?',
            'options'        => [
                'A. Model-View-Controller',
                'B. Main-Value-Class',
                'C. Module-View-Component',
                'D. Method-Variable-Class',
            ],
            'correct_answer' => 'A. Model-View-Controller',
            'hint'           => 'Lihat tabel di ringkasan. Ada 3 komponen: M, V, dan C.',
            'order'          => 2,
        ]);

        Quiz::create([
            'node_id'        => $kuisPengenalan->id,
            'type'           => 'fill_blank',
            'question'       => "Lengkapi kode berikut:\n\nRoute::___('/home', function () {\n    return 'Halaman Home';\n});",
            'options'        => null,
            'correct_answer' => 'get',
            'hint'           => 'Method HTTP untuk menampilkan halaman adalah GET.',
            'order'          => 3,
        ]);

        // ===========================
        // KUIS 2: ROUTING
        // ===========================

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'multiple_choice',
            'question'       => 'Perintah artisan untuk melihat semua route yang terdaftar adalah?',
            'options'        => [
                'A. php artisan route:show',
                'B. php artisan route:list',
                'C. php artisan show:routes',
                'D. php artisan routes',
            ],
            'correct_answer' => 'B. php artisan route:list',
            'hint'           => 'Lihat bagian Perintah Artisan di ringkasan.',
            'order'          => 1,
        ]);

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'fill_blank',
            'question'       => "Lengkapi kode agar route punya nama 'profil.index':\n\nRoute::get('/profil', [ProfilController::class, 'index'])\n     ->___('profil.index');",
            'options'        => null,
            'correct_answer' => 'name',
            'hint'           => 'Method untuk memberi nama route ada di cheat sheet.',
            'order'          => 2,
        ]);

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'multiple_choice',
            'question'       => 'Bagaimana cara membuat route parameter OPSIONAL?',
            'options'        => [
                'A. Route::get(\'/user/{id}\', ...)',
                'B. Route::get(\'/user/[id]\', ...)',
                'C. Route::get(\'/user/{id?}\', ...)',
                'D. Route::get(\'/user/<id>\', ...)',
            ],
            'correct_answer' => 'C. Route::get(\'/user/{id?}\', ...)',
            'hint'           => 'Tanda tanya setelah nama parameter membuatnya opsional.',
            'order'          => 3,
        ]);

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'fill_blank',
            'question'       => "Lengkapi kode redirect ke named route:\n\nreturn redirect()->___('dashboard');",
            'options'        => null,
            'correct_answer' => 'route',
            'hint'           => 'Lihat cheat sheet bagian cara pakai nama route.',
            'order'          => 4,
        ]);

        // ===========================
        // KUIS 3: CONTROLLER
        // ===========================

        Quiz::create([
            'node_id'        => $kuisController->id,
            'type'           => 'multiple_choice',
            'question'       => 'Perintah artisan untuk membuat Controller baru adalah?',
            'options'        => [
                'A. php artisan create:controller NamaController',
                'B. php artisan make:controller NamaController',
                'C. php artisan new:controller NamaController',
                'D. php artisan generate:controller NamaController',
            ],
            'correct_answer' => 'B. php artisan make:controller NamaController',
            'hint'           => 'Semua generator Laravel menggunakan perintah make:',
            'order'          => 1,
        ]);

        Quiz::create([
            'node_id'        => $kuisController->id,
            'type'           => 'fill_blank',
            'question'       => "Lengkapi perintah untuk membuat Resource Controller:\n\nphp artisan make:controller ProductController --___",
            'options'        => null,
            'correct_answer' => 'resource',
            'hint'           => 'Flag ini otomatis membuat 7 method CRUD standar.',
            'order'          => 2,
        ]);

        Quiz::create([
            'node_id'        => $kuisController->id,
            'type'           => 'multiple_choice',
            'question'       => 'Method mana yang digunakan untuk menampilkan SEMUA data?',
            'options'        => [
                'A. show()',
                'B. get()',
                'C. index()',
                'D. all()',
            ],
            'correct_answer' => 'C. index()',
            'hint'           => 'Lihat tabel 7 method di ringkasan. Index = tampil semua.',
            'order'          => 3,
        ]);

        Quiz::create([
            'node_id'        => $kuisController->id,
            'type'           => 'multiple_choice',
            'question'       => 'Method mana yang digunakan untuk menyimpan data BARU?',
            'options'        => [
                'A. save()',
                'B. index()',
                'C. create()',
                'D. store()',
            ],
            'correct_answer' => 'D. store()',
            'hint'           => 'Lihat tabel lagi. Store menerima POST request.',
            'order'          => 4,
        ]);

        $this->command->info('Quizzes berhasil dibuat!');
    }
}
