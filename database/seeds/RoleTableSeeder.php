<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(['name' => 'Admin']);
        Role::updateOrCreate(['name' => 'Officer purchases']);
        Role::updateOrCreate(['name' => 'Material recipient']);
    }
}
