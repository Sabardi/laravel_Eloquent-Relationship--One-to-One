<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MahasiswaController extends Controller
{
    //
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

    public function gabung2()
    {
        $mahasiswas = DB::select('SELECT * FROM mahasiswas, nilais WHERE mahasiswas.id = nilais.mahasiswa_id');
        foreach ($mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nim | $mahasiswa->nama | $mahasiswa->jurusan | ";
            echo "$mahasiswa->sem_1 | $mahasiswa->sem_2 | $mahasiswa->sem_3 <br> ";
        }
    }

    public function gabungJoin1()
    {
        $mahasiswas = DB::select('SELECT * FROM mahasiswas JOIN nilais ON mahasiswas.id = nilais.mahasiswa_id');
        foreach ($mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nim | $mahasiswa->nama | $mahasiswa->jurusan | ";
            echo "$mahasiswa->sem_1 | $mahasiswa->sem_2 | $mahasiswa->sem_3 <br> ";
        }
    }
    public function gabungJoin2()
    {
        $mahasiswas = DB::select('SELECT * FROM mahasiswas JOIN nilais ON mahasiswas.id = nilais.mahasiswa_id WHERE jurusan = "Ilmu Komputer"');
        foreach ($mahasiswas as $mahasiswa) {
            echo "$mahasiswa->nim | $mahasiswa->nama | $mahasiswa->jurusan | ";
            echo "$mahasiswa->sem_1 | $mahasiswa->sem_2 | $mahasiswa->sem_3 <br> ";
       }
    }
    public function gabungJoin3()
    {
        $mahasiswas = DB::select('SELECT * FROM mahasiswas JOIN nilais ON mahasiswas.id = nilais.mahasiswa_id WHERE nilais.sem_2 > 3');
        foreach ($mahasiswas as $mahasiswa){
            echo "$mahasiswa->nim | $mahasiswa->nama | $mahasiswa->jurusan | ";
            echo "$mahasiswa->sem_1 | $mahasiswa->sem_2 | $mahasiswa->sem_3 <hr> ";
        }
    }
}
