<?php

namespace Database\Seeders;

use App\Models\karyawan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 25; $i++) { 
            $data = [
                'nama_karyawan'=>$faker->name,
                'alamat'=>$faker->address,
                'telp'=>$faker->phoneNumber
            ];
            karyawan::create($data);
        }
    }
}
