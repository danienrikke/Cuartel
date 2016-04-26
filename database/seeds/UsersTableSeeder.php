<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '323 Batallon Camacaro',
            'email' => 'cuartel@gmail.com',
            'password' => bcrypt('323-bcamacaro'),
            'created_at' => new DateTime('now'),
            'updated_at' => new DateTime('now')
        ]);
    }
}
