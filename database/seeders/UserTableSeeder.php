<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\User::firstOrCreate(['name'=>'admin', 'email'=>'admin@alterlister.test', 'password'=>'password']);
    }
}
