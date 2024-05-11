<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Mahasiswa;
use App\Models\Nilai;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faker = Faker::create('id_ID');
        $faker->seed(123);
        $jurusan = ["Ilmu Komputer", "Teknik Informatika", "Sistem Informasi"];

        for ($i=0; $i<10; $i++) {
            Mahasiswa::create(
                [
                'nim' => $faker->unique()->numerify('10######'),
                'nama' => $faker->firstName." ".$faker->lastName,
                'jurusan' => $faker->randomElement($jurusan),
                ]
                );
        }

        for ($i=0; $i<5; $i++) {
            Nilai::create(
            [
            'sem_1' => $faker->randomFloat(2, 2, 4),
            'sem_2' => $faker->randomFloat(2, 2, 4),
            'sem_3' => $faker->randomFloat(2, 2, 4),
            'mahasiswa_id' => $faker->unique()->randomDigit,
            ]);
        }
    }
}
