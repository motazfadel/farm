<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;


class UserSeederTableSeede extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],[
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('012345678'),
                'role_id' => 0,

        ]);
        User::firstOrCreate(
            [
                'email' => 'Officer_purchases@gmail.com'
            ],[
                'name' => 'Officer purchases',
                'email' => 'Officer_purchases@gmail.com',
                'password' => Hash::make('012345678'),
                'role_id' => 2,
                'date_birth' => '2023-06-24',
                'date_employment' => '2023-06-24'

        ]);
        User::firstOrCreate(
            [
                'email' => 'material_recipient@gmail.com'
            ],[
                'name' => 'material recipient',
                'email' => 'material_recipient@gmail.com',
                'password' => Hash::make('012345678'),
                'role_id' => 3,
                'date_birth' => '2023-06-24',
                'date_employment' => '2023-06-24'

        ]);
      
    }
}
