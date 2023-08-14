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
        $users=[
            [
                'document'=>'123456',
                'password'=>Hash::make('123456*'),
                'email'=>'123456@gmail.com',
                'name'=>'Administrador',
                'last_name'=>'',
                'role_id'=>'1',
                'enabled'=>'2020-07-01',
            ],
            [
                'document'=>'1234567',
                'password'=>Hash::make('1234567*'),
                'email'=>'1234567@gmail.com',
                'name'=>'Coordinaador',
                'last_name'=>'',
                'role_id'=>'3',
                'enabled'=>'2020-07-01',
            ]
        ];

        foreach ($users as $user){
            \App\User::create($user);
        }
    }
}
