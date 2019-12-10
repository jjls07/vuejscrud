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
      DB::table('roles')->insert([
        [
         'code' => 'adm',
         'name' => 'Administrator',
       ],
       [
        'code' => 'reg',
        'nombre' => 'Regular',
      ],
     ]);
    }
}
