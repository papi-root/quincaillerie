<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
          'nom' => 'Admin',
          'prenom' => 'Admin',
          'email' => 'admin@admin.com',
          'password' => bcrypt('admin'),
          'niveau' => 1
        ]);
    }
}
