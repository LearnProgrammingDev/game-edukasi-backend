<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Node;
use App\Models\NodeConnection;

class NodeSeeder extends Seeder
{
    public function run(): void
    {
        // =============================================
        // CHAPTER 1: PENGENALAN LARAVEL
        // =============================================

        $n1 = Node::create([
            'title'      => 'Apa itu Laravel?',
            'type'       => 'materi',
            'content'    => "# Apa itu Laravel? 🚀\n\nLaravel adalah **framework PHP** yang elegan dan ekspresif untuk membangun aplikasi web modern.\n\n## Kenapa Belajar Laravel?\n\n- ✅ Sintaks bersih dan mudah dibaca\n- ✅ Fitur lengkap: routing, ORM, auth, queue\n- ✅ Komunitas besar & dokumentasi lengkap\n- ✅ Cocok untuk pemula hingga profesional\n\n## Contoh Kode Laravel\n\n```php\n// Route paling sederhana di Laravel\nRoute::get('/', function () {\n    return 'Hello, Laravel!';\n});\n```\n\n## Arsitektur MVC\n\nLaravel menggunakan pola **MVC (Model-View-Controller)**:\n\n| Komponen | Fungsi |\n|----------|--------|\n| Model | Mengurus data & database |\n| View | Tampilan yang dilihat user |\n| Controller | Logika penghubung Model & View |\n\n> 💡 **Tips:** Laravel dibuat oleh Taylor Otwell pada tahun 2011 dan sekarang menjadi framework PHP paling populer di dunia!",
            'x_position' => 150,
            'y_position' => 30,
            'order'      => 1,
            'exp_reward' => 50,
        ]);

        $n2 = Node::create([
            'title'      => 'Kuis: Pengenalan',
            'type'       => 'kuis',
            'content'    => null,
            'x_position' => 150,
            'y_position' => 180,
            'order'      => 2,
            'exp_reward' => 100,
        ]);

        // =============================================
        // CHAPTER 2: ROUTING
        // =============================================

        $n3 = Node::create([
            'title'      => 'Routing Dasar',
            'type'       => 'materi',
            'content'    => "# Routing Dasar 🛣️\n\nRoute adalah **pintu masuk** setiap halaman di aplikasi Laravel. Semua route didefinisikan di file `routes/web.php` atau `routes/api.php`.\n\n## Jenis-jenis HTTP Method\n\n```php\n// GET - Menampilkan data\nRoute::get('/users', function () {\n    return 'Daftar semua user';\n});\n\n// POST - Menyimpan data baru\nRoute::post('/users', function () {\n    return 'Simpan user baru';\n});\n\n// PUT - Update data\nRoute::put('/users/{id}', function (\$id) {\n    return 'Update user ' . \$id;\n});\n\n// DELETE - Hapus data\nRoute::delete('/users/{id}', function (\$id) {\n    return 'Hapus user ' . \$id;\n});\n```\n\n## Route ke Controller\n\n```php\n// Cara yang lebih rapi: arahkan ke Controller\nuse App\\Http\\Controllers\\UserController;\n\nRoute::get('/users', [UserController::class, 'index']);\nRoute::post('/users', [UserController::class, 'store']);\n```\n\n> 💡 **Tips:** Gunakan `php artisan route:list` untuk melihat semua route yang terdaftar!",
            'x_position' => 150,
            'y_position' => 330,
            'order'      => 3,
            'exp_reward' => 50,
        ]);

        $n4 = Node::create([
            'title'      => 'Route Parameter',
            'type'       => 'materi',
            'content'    => "# Route Parameter 🎯\n\nParameter memungkinkan kamu **menangkap nilai dari URL** secara dinamis.\n\n## Parameter Wajib\n\n```php\n// {id} adalah parameter wajib\nRoute::get('/users/{id}', function (\$id) {\n    return 'Menampilkan user dengan ID: ' . \$id;\n});\n\n// Akses: /users/1  → 'Menampilkan user dengan ID: 1'\n// Akses: /users/99 → 'Menampilkan user dengan ID: 99'\n```\n\n## Parameter Opsional\n\n```php\n// Tanda ? membuat parameter menjadi opsional\nRoute::get('/salam/{nama?}', function (\$nama = 'Tamu') {\n    return 'Halo, ' . \$nama . '!';\n});\n\n// Akses: /salam       → 'Halo, Tamu!'\n// Akses: /salam/Budi  → 'Halo, Budi!'\n```\n\n## Multiple Parameter\n\n```php\n// Bisa pakai lebih dari satu parameter\nRoute::get('/posts/{tahun}/{bulan}', function (\$tahun, \$bulan) {\n    return \"Artikel dari \$bulan/\$tahun\";\n});\n```\n\n> 💡 **Tips:** Nama parameter di `{}` harus sama dengan nama variabel di `function`!",
            'x_position' => 30,
            'y_position' => 480,
            'order'      => 4,
            'exp_reward' => 75,
        ]);

        $n5 = Node::create([
            'title'      => 'Named Route',
            'type'       => 'materi',
            'content'    => "# Named Route 🏷️\n\nNamed Route memungkinkan kamu **memberi nama** pada sebuah route sehingga mudah dipanggil di mana saja.\n\n## Memberi Nama pada Route\n\n```php\n// Tambahkan ->name('nama.route') di akhir\nRoute::get('/profil-saya', [ProfilController::class, 'index'])\n     ->name('profil.index');\n\nRoute::post('/profil-saya/update', [ProfilController::class, 'update'])\n     ->name('profil.update');\n```\n\n## Menggunakan Named Route\n\n```php\n// Di Controller atau View, panggil dengan helper route()\n\$url = route('profil.index');\n// Hasil: http://localhost/profil-saya\n\n// Redirect ke named route\nreturn redirect()->route('profil.index');\n\n// Di Blade template\n<a href=\"{{ route('profil.index') }}\">Lihat Profil</a>\n```\n\n## Dengan Parameter\n\n```php\nRoute::get('/users/{id}', [UserController::class, 'show'])\n     ->name('users.show');\n\n// Panggil dengan parameter\n\$url = route('users.show', ['id' => 5]);\n// Hasil: http://localhost/users/5\n```\n\n> 💡 **Tips:** Keuntungan named route: jika URL berubah, kamu hanya perlu update di satu tempat!",
            'x_position' => 270,
            'y_position' => 480,
            'order'      => 5,
            'exp_reward' => 75,
        ]);

        // Kuis setelah routing
        $n6 = Node::create([
            'title'      => 'Kuis: Routing',
            'type'       => 'kuis',
            'content'    => null,
            'x_position' => 150,
            'y_position' => 630,
            'order'      => 6,
            'exp_reward' => 150,
        ]);

        // =============================================
        // CHAPTER 3: CONTROLLER
        // =============================================

        $n7 = Node::create([
            'title'      => 'Controller',
            'type'       => 'materi',
            'content'    => "# Controller 🎮\n\nController adalah tempat kamu menulis **logika aplikasi**. Daripada menulis logika langsung di route, lebih rapi jika dipindah ke Controller.\n\n## Membuat Controller\n\n```bash\n# Jalankan di terminal\nphp artisan make:controller UserController\n\n# Controller dengan CRUD lengkap (resource)\nphp artisan make:controller UserController --resource\n```\n\n## Struktur Controller\n\n```php\n<?php\n\nnamespace App\\Http\\Controllers;\n\nuse App\\Models\\User;\nuse Illuminate\\Http\\Request;\n\nclass UserController extends Controller\n{\n    // Tampilkan semua data\n    public function index()\n    {\n        \$users = User::all();\n        return view('users.index', compact('users'));\n    }\n\n    // Tampilkan form tambah\n    public function create()\n    {\n        return view('users.create');\n    }\n\n    // Simpan data baru\n    public function store(Request \$request)\n    {\n        User::create(\$request->all());\n        return redirect()->route('users.index');\n    }\n\n    // Tampilkan detail 1 data\n    public function show(\$id)\n    {\n        \$user = User::findOrFail(\$id);\n        return view('users.show', compact('user'));\n    }\n}\n```\n\n> 💡 **Tips:** Gunakan `--resource` saat membuat controller untuk otomatis mendapatkan 7 method standar CRUD!",
            'x_position' => 150,
            'y_position' => 780,
            'order'      => 7,
            'exp_reward' => 75,
        ]);

        $n8 = Node::create([
            'title'      => 'Kuis: Controller',
            'type'       => 'kuis',
            'content'    => null,
            'x_position' => 150,
            'y_position' => 930,
            'order'      => 8,
            'exp_reward' => 150,
        ]);

        // =============================================
        // KONEKSI ANTAR NODE
        // =============================================

        // Chapter 1
        NodeConnection::create(['source_node_id' => $n1->id, 'target_node_id' => $n2->id]);

        // Chapter 1 → Chapter 2
        NodeConnection::create(['source_node_id' => $n2->id, 'target_node_id' => $n3->id]);

        // Percabangan routing
        NodeConnection::create(['source_node_id' => $n3->id, 'target_node_id' => $n4->id]);
        NodeConnection::create(['source_node_id' => $n3->id, 'target_node_id' => $n5->id]);

        // Kedua cabang mengarah ke kuis routing
        NodeConnection::create(['source_node_id' => $n4->id, 'target_node_id' => $n6->id]);
        NodeConnection::create(['source_node_id' => $n5->id, 'target_node_id' => $n6->id]);

        // Chapter 2 → Chapter 3
        NodeConnection::create(['source_node_id' => $n6->id, 'target_node_id' => $n7->id]);
        NodeConnection::create(['source_node_id' => $n7->id, 'target_node_id' => $n8->id]);

        $this->command->info('✅ Nodes & Connections berhasil dibuat!');
    }
}