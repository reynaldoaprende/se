<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(MenuRoleTableSeeder::class);
        $this->call(ConsentTableSeeder::class);
        $this->call(DetailTableSeeder::class);
        $this->call(MessageTableSeeder::class);
    }
}
