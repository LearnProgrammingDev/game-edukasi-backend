<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Node;
use App\Models\NodeConnection;

class NodeSeeder extends Seeder
{
    public function run(): void
    {
        $n1 = Node::create([
            'title'      => 'Apa itu Laravel?',
            'type'       => 'materi',
            'content'    => "# Apa itu Laravel?\n\nLaravel adalah **framework PHP** paling populer untuk membangun aplikasi web modern.\n\n## Kenapa Laravel?\n\n- Sintaks bersih dan mudah dibaca\n- Fitur lengkap: routing, ORM, auth, queue\n- Komunitas besar dan dokumentasi lengkap\n\n## Arsitektur MVC\n\n| Komponen | Fungsi |\n|----------|--------|\n| Model | Mengurus data dan database |\n| View | Tampilan yang dilihat user |\n| Controller | Logika penghubung Model dan View |\n\n## Contoh Route Pertama\n\n```php\n// File: routes/web.php\nRoute::get('/', function () {\n    return 'Hello, Laravel!';\n});\n```\n\n> Laravel dibuat oleh Taylor Otwell tahun 2011.",
            'x_position' => 150,
            'y_position' => 30,
            'order'      => 1,
            'exp_reward' => 50,
        ]);

        $n2 = Node::create([
            'title'      => 'Kuis: Pengenalan',
            'type'       => 'kuis',
            'content'    => "# Ringkasan Sebelum Kuis\n\nBaca ringkasan ini dulu sebelum mengerjakan soal!\n\n---\n\n## Poin Penting\n\n**1. Laravel adalah framework PHP**\n\n```php\n// Laravel ditulis dalam bahasa PHP\nRoute::get('/', function () {\n    return 'Ini Laravel!';\n});\n```\n\n**2. Pola MVC**\n- **M**odel = mengurus data\n- **V**iew = tampilan\n- **C**ontroller = logika\n\n**3. Cara membuat Route GET**\n\n```php\nRoute::get('/halaman', function () {\n    return 'Isi halaman';\n});\n```\n\n---\n\n> Sudah siap? Klik tombol Mulai Tantangan di bawah!",
            'x_position' => 150,
            'y_position' => 180,
            'order'      => 2,
            'exp_reward' => 100,
        ]);

        $n3 = Node::create([
            'title'      => 'Routing Dasar',
            'type'       => 'materi',
            'content'    => "# Routing Dasar\n\nRoute adalah **pintu masuk** setiap halaman di Laravel.\n\n## 4 Method HTTP Utama\n\n```php\n// GET - Menampilkan data\nRoute::get('/users', function () {\n    return 'Daftar semua user';\n});\n\n// POST - Menyimpan data baru\nRoute::post('/users', function () {\n    return 'Simpan user baru';\n});\n\n// PUT - Update data\nRoute::put('/users/{id}', function (\$id) {\n    return 'Update user ' . \$id;\n});\n\n// DELETE - Hapus data\nRoute::delete('/users/{id}', function (\$id) {\n    return 'Hapus user ' . \$id;\n});\n```\n\n## Route ke Controller\n\n```php\nuse App\\Http\\Controllers\\UserController;\n\nRoute::get('/users', [UserController::class, 'index']);\nRoute::post('/users', [UserController::class, 'store']);\n```\n\n## Cek Semua Route\n\n```bash\nphp artisan route:list\n```\n\n> Tips: Selalu gunakan route:list untuk memastikan route sudah terdaftar!",
            'x_position' => 150,
            'y_position' => 330,
            'order'      => 3,
            'exp_reward' => 50,
        ]);

        $n4 = Node::create([
            'title'      => 'Route Parameter',
            'type'       => 'materi',
            'content'    => "# Route Parameter\n\nParameter membuat URL menjadi **dinamis**.\n\n## Parameter Wajib\n\n```php\n// {id} WAJIB ada di URL\nRoute::get('/users/{id}', function (\$id) {\n    return 'User ID: ' . \$id;\n});\n\n// /users/1  menghasilkan: User ID: 1\n// /users/99 menghasilkan: User ID: 99\n// /users    menghasilkan: ERROR 404\n```\n\n## Parameter Opsional\n\n```php\n// Tanda tanya membuat parameter opsional\nRoute::get('/salam/{nama?}', function (\$nama = 'Tamu') {\n    return 'Halo, ' . \$nama . '!';\n});\n\n// /salam      menghasilkan: Halo, Tamu!\n// /salam/Budi menghasilkan: Halo, Budi!\n```\n\n## Multiple Parameter\n\n```php\nRoute::get('/posts/{tahun}/{bulan}', function (\$tahun, \$bulan) {\n    return \"Artikel: \$bulan/\$tahun\";\n});\n```\n\n> Penting: Nama di kurung kurawal harus sama persis dengan nama variabel di function!",
            'x_position' => 30,
            'y_position' => 480,
            'order'      => 4,
            'exp_reward' => 75,
        ]);

        $n5 = Node::create([
            'title'      => 'Named Route',
            'type'       => 'materi',
            'content'    => "# Named Route\n\nNamed Route = memberi **nama** pada route agar mudah dipanggil.\n\n## Cara Memberi Nama\n\n```php\nRoute::get('/halaman-profil', [ProfilController::class, 'index'])\n     ->name('profil.index');\n```\n\n## Cara Menggunakan Nama\n\n```php\n// Ambil URL dari nama route\n\$url = route('profil.index');\n// Hasil: http://localhost/halaman-profil\n\n// Redirect ke named route\nreturn redirect()->route('profil.index');\n\n// Di Blade template\n// <a href=\"{{ route('profil.index') }}\">Profil</a>\n```\n\n## Dengan Parameter\n\n```php\nRoute::get('/users/{id}', [UserController::class, 'show'])\n     ->name('users.show');\n\n\$url = route('users.show', ['id' => 42]);\n// Hasil: http://localhost/users/42\n```\n\n## Kenapa Pakai Named Route?\n\n```php\n// Tanpa named route: susah maintenance\nreturn redirect('/halaman-profil');\n\n// Dengan named route: URL berubah pun tidak masalah\nreturn redirect()->route('profil.index');\n```\n\n> Jika URL berubah, cukup update di satu tempat saja!",
            'x_position' => 270,
            'y_position' => 480,
            'order'      => 5,
            'exp_reward' => 75,
        ]);

        $n6 = Node::create([
            'title'      => 'Kuis: Routing',
            'type'       => 'kuis',
            'content'    => "# Ringkasan Sebelum Kuis Routing\n\n---\n\n## Cheat Sheet Routing\n\n```php\n// 4 method utama\nRoute::get('/path', ...);        // Ambil data\nRoute::post('/path', ...);       // Simpan data\nRoute::put('/path/{id}', ...);   // Update data\nRoute::delete('/path/{id}', ...);// Hapus data\n\n// Parameter wajib vs opsional\nRoute::get('/a/{id}', ...);   // wajib ada\nRoute::get('/b/{id?}', ...);  // boleh kosong\n\n// Named route\nRoute::get('/path', ...)->name('nama.route');\n\n// Cara pakai nama\nroute('nama.route');              // ambil URL\nredirect()->route('nama.route');  // redirect\n```\n\n## Perintah Artisan\n\n```bash\n# Lihat semua route\nphp artisan route:list\n\n# Hapus cache route\nphp artisan route:clear\n```\n\n---\n\n> Ingat semua itu? Buktikan sekarang!",
            'x_position' => 150,
            'y_position' => 630,
            'order'      => 6,
            'exp_reward' => 150,
        ]);

        $n7 = Node::create([
            'title'      => 'Controller',
            'type'       => 'materi',
            'content'    => "# Controller\n\nController adalah tempat menulis **logika aplikasi**.\n\n## Tanpa vs Dengan Controller\n\n```php\n// Tanpa Controller: berantakan!\nRoute::get('/users', function () {\n    \$users = DB::table('users')->get();\n    // banyak logika di sini...\n    return view('users', compact('users'));\n});\n\n// Dengan Controller: bersih!\nRoute::get('/users', [UserController::class, 'index']);\n```\n\n## Membuat Controller\n\n```bash\n# Controller biasa\nphp artisan make:controller UserController\n\n# Resource controller dengan 7 method CRUD otomatis\nphp artisan make:controller UserController --resource\n```\n\n## 7 Method Resource Controller\n\n```php\nclass UserController extends Controller\n{\n    public function index()           // GET /users\n    public function create()          // GET /users/create\n    public function store(Request \$r) // POST /users\n    public function show(\$id)         // GET /users/{id}\n    public function edit(\$id)         // GET /users/{id}/edit\n    public function update(\$r, \$id)   // PUT /users/{id}\n    public function destroy(\$id)      // DELETE /users/{id}\n}\n```\n\n## Contoh Method index dan store\n\n```php\npublic function index()\n{\n    \$users = User::all();\n    return view('users.index', compact('users'));\n}\n\npublic function store(Request \$request)\n{\n    \$request->validate([\n        'name'  => 'required|string',\n        'email' => 'required|email|unique:users',\n    ]);\n\n    User::create(\$request->all());\n\n    return redirect()->route('users.index')\n                     ->with('success', 'User berhasil dibuat!');\n}\n```\n\n> Tips: Satu Controller sebaiknya hanya mengurus satu resource saja.",
            'x_position' => 150,
            'y_position' => 780,
            'order'      => 7,
            'exp_reward' => 75,
        ]);

        $n8 = Node::create([
            'title'      => 'Kuis: Controller',
            'type'       => 'kuis',
            'content'    => "# Ringkasan Sebelum Kuis Controller\n\n---\n\n## Cheat Sheet Controller\n\n```bash\n# Buat controller biasa\nphp artisan make:controller NamaController\n\n# Buat resource controller\nphp artisan make:controller NamaController --resource\n```\n\n## Tabel 7 Method Resource\n\n| Method | HTTP | URL | Fungsi |\n|--------|------|-----|--------|\n| index() | GET | /users | Tampil semua |\n| create() | GET | /users/create | Form tambah |\n| store() | POST | /users | Simpan baru |\n| show() | GET | /users/{id} | Detail satu |\n| edit() | GET | /users/{id}/edit | Form edit |\n| update() | PUT | /users/{id} | Simpan edit |\n| destroy() | DELETE | /users/{id} | Hapus |\n\n## Pola Umum\n\n```php\n// Route memanggil Controller\nRoute::get('/users', [UserController::class, 'index']);\n\n// Di dalam Controller\npublic function index()\n{\n    \$data = Model::all();\n    return view('...', compact('data'));\n}\n```\n\n---\n\n> Sudah hafal tabelnya? Buktikan sekarang!",
            'x_position' => 150,
            'y_position' => 930,
            'order'      => 8,
            'exp_reward' => 150,
        ]);

        // Koneksi antar node
        NodeConnection::create(['source_node_id' => $n1->id, 'target_node_id' => $n2->id]);
        NodeConnection::create(['source_node_id' => $n2->id, 'target_node_id' => $n3->id]);
        NodeConnection::create(['source_node_id' => $n3->id, 'target_node_id' => $n4->id]);
        NodeConnection::create(['source_node_id' => $n3->id, 'target_node_id' => $n5->id]);
        NodeConnection::create(['source_node_id' => $n4->id, 'target_node_id' => $n6->id]);
        NodeConnection::create(['source_node_id' => $n5->id, 'target_node_id' => $n6->id]);
        NodeConnection::create(['source_node_id' => $n6->id, 'target_node_id' => $n7->id]);
        NodeConnection::create(['source_node_id' => $n7->id, 'target_node_id' => $n8->id]);

        $this->command->info('Nodes dan Connections berhasil dibuat!');
    }
}
