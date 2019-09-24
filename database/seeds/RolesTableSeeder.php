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
        //$faker = Faker\Factory::create();

        $items = [
            ['id' => 1, 'nombre' => 'Administrator', 'descripcion' => 'Administradores de área', 'condicion' => '1'],
            ['id' => 2, 'nombre' => 'Editor', 'descripcion' => 'Editor de contenido multimedia', 'condicion' => '1'],
        ];

        foreach ($items as $item) {
            \App\Rol::updateOrCreate(['id' => $item['id']], $item);
        }


    }
}
