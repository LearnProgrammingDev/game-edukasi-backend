<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Node;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil node berdasarkan judul
        $kuisPengenalan  = Node::where('title', 'Kuis: Pengenalan')->first();
        $kuisRouting     = Node::where('title', 'Kuis: Routing')->first();
        $kuisController  = Node::where('title', 'Kuis: Controller')->first();

        // =============================================
        // KUIS 1: PENGENALAN LARAVEL
        // =============================================

        Quiz::create([
            'node_id'        => $kuisPengenalan->id,
            'type'           => 'multiple_choice',
            'question'       => 'Laravel adalah framework untuk bahasa pemrograman apa?',
            'options'        => ['A. Python', 'B. PHP', 'C. JavaScript', 'D. Ruby'],
            'correct_answer' => 'B. PHP',
            'hint'           => 'Laravel dibuat oleh Taylor Otwell dan sangat populer di ekosistem backend web.',
            'order'          => 1,
        ]);

        Quiz::create([
            'node_id'        => $kuisPengenalan->id,
            'type'           => 'multiple_choice',
            'question'       => 'MVC adalah singkatan dari?',
            'options'        => [
                'A. Model-View-Controller',
                'B. Main-Value-Class',
                'C. Module-View-Component',
                'D. Method-Variable-Class'
            ],
            'correct_answer' => 'A. Model-View-Controller',
            'hint'           => 'MVC adalah pola arsitektur yang membagi aplikasi menjadi 3 bagian utama.',
            'order'          => 2,
        ]);

        Quiz::create([
            'node_id'        => $kuisPengenalan->id,
            'type'           => 'fill_blank',
            'question'       => 'Lengkapi kode berikut untuk membuat route GET di Laravel:\n\nRoute::___(\'/home\', function () {\n    return \'Halaman Home\';\n});',
            'options'        => null,
            'correct_answer' => 'get',
            'hint'           => 'HTTP method untuk mengambil/menampilkan data adalah GET.',
            'order'          => 3,
        ]);

        // =============================================
        // KUIS 2: ROUTING
        // =============================================

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'multiple_choice',
            'question'       => 'Perintah artisan apa yang digunakan untuk melihat semua route yang terdaftar?',
            'options'        => [
                'A. php artisan route:show',
                'B. php artisan route:list',
                'C. php artisan show:routes',
                'D. php artisan routes'
            ],
            'correct_answer' => 'B. php artisan route:list',
            'hint'           => 'Perintah ini akan menampilkan tabel berisi semua route beserta method dan controller-nya.',
            'order'          => 1,
        ]);

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'fill_blank',
            'question'       => 'Lengkapi kode berikut agar route memiliki nama "profil.index":\n\nRoute::get(\'/profil\', [ProfilController::class, \'index\'])\n     ->___( \'profil.index\');',
            'options'        => null,
            'correct_answer' => 'name',
            'hint'           => 'Method untuk memberi nama pada route adalah ->name().',
            'order'          => 2,
        ]);

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'multiple_choice',
            'question'       => 'Bagaimana cara membuat route parameter yang OPSIONAL di Laravel?',
            'options'        => [
                'A. Route::get(\'/user/{id}\', ...)',
                'B. Route::get(\'/user/[id]\', ...)',
                'C. Route::get(\'/user/{id?}\', ...)',
                'D. Route::get(\'/user/<id>\', ...)'
            ],
            'correct_answer' => 'C. Route::get(\'/user/{id?}\', ...)',
            'hint'           => 'Tanda tanya (?) setelah nama parameter membuatnya menjadi opsional.',
            'order'          => 3,
        ]);

        Quiz::create([
            'node_id'        => $kuisRouting->id,
            'type'           => 'fill_blank',
            'question'       => 'Lengkapi kode berikut untuk redirect ke named route:\n\nreturn redirect()->___(\'dashboard\');',
            'options'        => null,
            'correct_answer' => 'route',
            'hint'           => 'Helper untuk redirect ke named route adalah ->route().',
            'order'          => 4,
        ]);

        // =============================================
        // KUIS 3: CONTROLLER
        // =============================================

        Quiz::create([
            'node_id'        => $kuisController->id,
            'type'           => 'multiple_choice',
            'question'       => 'Perintah artisan untuk membuat Controller baru adalah?',
            'options'        => [
                'A. php artisan create:controller NamaController',
                'B. php artisan make:controller NamaController',
                'C. php artisan new:controller NamaController',
                'D. php artisan generate:controller NamaController'
            ],
            'correct_answer' => 'B. php artisan make:controller NamaController',
            'hint'           => 'Semua generator di Laravel menggunakan perintah "make:".',
            'order'          => 1,
        ]);

        Quiz::create([
            'node_id'        => $kuisController->id,
            'type'           => 'fill_blank',
            'question'       => 'Lengkapi perintah untuk membuat Resource Controller:\n\nphp artisan make:controller ProductController --___',
            'options'        => null,
            'correct_answer' => 'resource',
            'hint'           => 'Flag --resource akan otomatis membuat 7 method CRUD standar.',
            'order'          => 2,
        ]);

        Quiz::create([
            'node_id'        => $kuisController->id,
            'type'           => 'multiple_choice',
            'question'       => 'Method mana yang digunakan untuk menampilkan SEMUA data di Resource Controller?',
            'options'        => [
                'A. show()',
                'B. get()',
                'C. index()',
                'D. all()'
            ],
            'correct_answer' => 'C. index()',
            'hint'           => 'Konvensi Laravel: index() untuk list semua data, show() untuk detail satu data.',
            'order'          => 3,
        ]);

        $this->command->info('✅ Quizzes berhasil dibuat!');
    }
}
