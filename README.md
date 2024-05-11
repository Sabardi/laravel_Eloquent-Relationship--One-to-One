#  One to One Relationship #

Maksud dari one to one relationship adalah, satu baris data di tabel utama terhubung dengan
satu baris data di tabel kedua. Dan begitu juga sebaliknya, satu baris data di tabel kedua,
terhubung dengan satu baris data di tabel utama.
Contoh dari konsep ini seperti satu mahasiswa yang memiliki satu nilai ipk, atau satu
perusahaan memiliki satu nomor telepon.
Sebenarnya, relationship one to one tidak terlalu sering di pakai, karena pada dasarnya jika
satu baris data hanya berhubungan dengan satu data lain (dan begitu juga sebaliknya), maka
kedua tabel bisa digabung menjadi satu tabel panjang.
Alasan utama pembuatan relationship one to one lebih ke performa, karena bisa jadi hanya
beberapa kolom saja yang sering di akses, sedangkan kolom lain lebih ke data tambahan. Data
tambahan inilah yang bisa dipecah menjadi tabel kedua. 


Dalam diagram ERD (Entity Relationship Diagram), relationship one to one digambarkan
dengan satu garis yang tidak bercabang

![alt text](image.png)

# Pengertian Primary Key dan Foreign Key
Primary key adalah sebuah kolom (atau beberapa kolom) yang bisa mengidentifikasi setiap
baris di dalam sebuah tabel. Jika tabel di generate menggunakan migration, secara otomatis
Laravel sudah men-set kolom id sebagai primary key

Sedangkan foreign key adalah sebutan untuk kolom yang nilainya merujuk ke primary key dari
tabel lain. Kolom yang bertindak sebagai foreign key akan dipakai untuk proses penggabungan
tabel (pembuatan relationship).

tabel mahasiswas yang akan di relasikan dengan tabel nilais
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->char('nim',8)->unique();
            $table->string('nama');
            $table->string('jurusan');
            $table->timestamps();
        });
    }

    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->decimal('sem_1',3,2)->nullable();
            $table->decimal('sem_2',3,2)->nullable();
            $table->decimal('sem_3',3,2)->nullable();
            $table->unsignedBigInteger('mahasiswa_id')->unique();
            $table->timestamps();

            // relation nya
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas');

        });

# Membuat Join dengan DB Facade (Raw SQL Queries)

Sebelum masuk ke eloquent relationship, saya ingin membahas cara penggabungan tabel
dengan menulis query MySQL secara manual. Ini agar nantinya bisa kita bandingkan dengan
solusi yang disediakan eloquent. Selain itu untuk tabel yang kompleks, kadang menulis
langsung query MySQL akan lebih efisien dibandingkan memakai eloquent relationship.

    public function all()
    {
        $mahasiswas = DB::select('SELECT * FROM mahasiswas');
        foreach ($mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nim | $mahasiswa->nama | $mahasiswa->jurusan <br>";
        }
    }
    public function gabung1(){
        $mahasiswas = DB::select('SELECT * FROM mahasiswas, nilais WHERE mahasiswas.id = nilais.mahasiswa_id');
        dump($mahasiswas);
    }

    
Query yang dijalankan adalah SELECT * FROM mahasiswas, nilais WHERE mahasiswas.id =
nilais.mahasiswa_id'. Ini bisa di terjemahkan sebagai "ambil semua kolom yang ada di tabel
mahasiswas dan tabel nilais, dengan syarat data kolom id di tabel mahasiswas harus sama
dengan kolom mahasiswa_id di tabel nilais".
