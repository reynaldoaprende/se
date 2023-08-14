<?php
use Illuminate\Database\Seeder;
class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $rows=[
            ['name'=>'Administrador'],//Id 1
            ['name'=>'Usuario'],//Id 2
            ['name'=>'Coordinador']//Id 3
        ];
        foreach ($rows as $row)\App\Role::create($row);
    }
}
