<?php
use Illuminate\Database\Seeder;
class MenuRoleTableSeeder extends Seeder
{
    public function run()
    {
        $rows=[
            //Administrador
            ['role_id'=>'1','menu_id'=>1],
            ['role_id'=>'1','menu_id'=>2],
            ['role_id'=>'1','menu_id'=>3],
            ['role_id'=>'1','menu_id'=>4],
            ['role_id'=>'1','menu_id'=>5],
            //Coordinador
            ['role_id'=>3,'menu_id'=>1],
            ['role_id'=>3,'menu_id'=>2],
            ['role_id'=>3,'menu_id'=>3],
            ['role_id'=>3,'menu_id'=>4],
            ['role_id'=>3,'menu_id'=>5],
            //Usuario
            ['role_id'=>2,'menu_id'=>1],
        ];
        foreach ($rows as $row)\App\MenuRole::create($row);
    }
}
