<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Building;
use App\Models\Room;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Rent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        { {
            }
        }
        // \Ap{{ p\Mo }}dels\User::factory()->create([
        //    {{  'na }}me' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@untirta.ac.id',
            'password' => bcrypt('admin'),
            'nomor_induk' => '21312131',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'User', // Changed from 'Mahasiswa'
            'email' => 'user@untirta.ac.id', // Changed from 'mahasiswa@gmail.com'
            'password' => bcrypt('user'), // Changed from 'mahasiswa'
            'nomor_induk' => '21312109',
            'role_id' => 2,
        ]);

        Faculty::create([
            'code' => 'FT',
            'name' => 'Fakultas Teknik',
        ]);

        Building::create([
            'code' => 'aula',
            'name' => 'Aula',
            'faculty_id' => 1,
        ]);

        Building::create([
            'code' => 'dekanat',
            'name' => 'Dekanat',
            'faculty_id' => 1,
        ]);

        Building::create([
            'code' => 'br',
            'name' => 'BR',
            'faculty_id' => 1,
        ]);

        Building::create([
            'code' => 'r',
            'name' => 'R',
            'faculty_id' => 1,
        ]);

        Room::create([
            'code' => 'aulaFT',
            'name' => 'Aula Fakultas Teknik',
            'img' => 'assets/images/ruang/aula-fak-teknik.jpeg',
            'floor' => 1,
            'status' => false,
            'capacity' => 200,
            'type' => 'Ruangan Aula',
            'description' => 'Gedung aula di Fakultas Teknik Untirta biasanya digunakan untuk kegiatan perkuliahan besar, seminar, workshop, atau acara-acara penting lainnya yang membutuhkan ruang yang luas dan kapasitas besar.',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => 'auditDekanat',
            'name' => 'Auditorium Dekanat',
            'img' => 'assets/images/ruang/auditorium-dekanat.png',
            'floor' => 2,
            'status' => false,
            'capacity' => 100,
            'type' => 'Ruangan Auditorium',
            'description' => 'Ruang Auditorium ini berada di lantai 2 gedung Dekanat Fakultas Teknik. Auditorium ini digunakan sebagai sarana kegiatan ilmiah antara lain stadium general, seminar, workshop pendidikan, dan kegiatan sejenisnya.',
            'building_id' => 2,
        ]);

        Room::create([
            'code' => 'br1.1',
            'name' => 'BR.1-1',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 1,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 1, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'br1.2',
            'name' => 'BR.1-2',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 1,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 1, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);
        
        Room::create([
            'code' => 'br1.3',
            'name' => 'BR.1-3',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 1,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 1, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'br2.1',
            'name' => 'BR.2-1',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'br2.2',
            'name' => 'BR.2-2',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);
        
        Room::create([
            'code' => 'br2.3',
            'name' => 'BR.2-3',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'br3.1',
            'name' => 'BR.3-1',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 3, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'br3.2',
            'name' => 'BR.3-2',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 3, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'br3.3',
            'name' => 'BR.3-3',
            'img' => 'assets/images/ruang/gedung-br.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung BR lantai 3, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'r2.1',
            'name' => 'R2-1',
            'img' => 'assets/images/ruang/gedung-r.png',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung R atau Letter U lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.2',
            'name' => 'R2-2',
            'img' => 'assets/images/ruang/gedung-r.png',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung R atau Letter U lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.3',
            'name' => 'R2-3',
            'img' => 'assets/images/ruang/gedung-r.png',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung R atau Letter U lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.4',
            'name' => 'R2-4',
            'img' => 'assets/images/ruang/gedung-r.png',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung R atau Letter U lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.5',
            'name' => 'R2-5',
            'img' => 'assets/images/ruang/gedung-r.png',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung R atau Letter U lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.6',
            'name' => 'R2-6',
            'img' => 'assets/images/ruang/gedung-r.png',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang perkuliahan',
            'description' => 'Ruang perkuliahan yang terletak di gedung R atau Letter U lantai 2, digunakan oleh semua jurusan di Fakultas Teknik.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.14',
            'name' => 'R2-14',
            'img' => 'assets/images/ruang/lab-komputer.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Lab komputer yang terletak di gedung R atau Letter U lantai 2, digunakan untuk berbagai keperluan terutama untuk mendukung kegiatan perkuliahan seperti praktikum dan biasanya digunakan untuk ruangan UTBK.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.15',
            'name' => 'R2-15',
            'img' => 'assets/images/ruang/lab-komputer.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Lab komputer yang terletak di gedung R atau Letter U lantai 2, digunakan untuk berbagai keperluan terutama untuk mendukung kegiatan perkuliahan seperti praktikum dan biasanya digunakan untuk ruangan UTBK.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'r2.16',
            'name' => 'R2-16',
            'img' => 'assets/images/ruang/lab-komputer.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Lab komputer yang terletak di gedung R atau Letter U lantai 2, digunakan untuk berbagai keperluan terutama untuk mendukung kegiatan perkuliahan seperti praktikum dan biasanya digunakan untuk ruangan UTBK.',
            'building_id' => 4,
        ]);

    }
}
