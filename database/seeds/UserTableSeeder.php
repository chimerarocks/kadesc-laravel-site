<?php

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
        factory(App\User::class)->create(['email' => 'admin@kadesc.com', 'password' => bcrypt('Kadesc1!')]);
    }
}
