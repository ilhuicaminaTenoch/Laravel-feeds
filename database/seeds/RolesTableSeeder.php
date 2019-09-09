<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$count = 2;
        factory(\App\Roles::class,$count)->create();*/

        $faker = Faker\Factory::create();
        $limit = 2;

        for ($i = 0; $i < $limit; $i++) {
            $nombre = ($i == 0) ? 'Administrador' : 'Editor';
            \Illuminate\Support\Facades\DB::table('roles')->insert([
                'nombre' => $nombre,
                'descripcion' => $faker->realText(15),
                'condicion' => '1',
            ]);
        }


    }
}
