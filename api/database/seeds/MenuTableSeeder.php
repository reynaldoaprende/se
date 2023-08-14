<?php
use Illuminate\Database\Seeder;
class MenuTableSeeder extends Seeder
{
    public function run()
    {
        $rows=[
            ['name'=>'Inicio','icon'=>'home','route'=>'home','random_param'=>0],
            ['name'=>'Nuevo Registro','icon'=>'plus', 'route'=>'home','random_param'=>1],
            ['name'=>'Familias','icon'=>'users', 'route'=>'families','random_param'=>0],
            ['name'=>'Reporte','icon'=>'file', 'route'=>'reports','random_param'=>0],
            ['name'=>'Perfil','icon'=>'user', 'route'=>'profile','random_param'=>0]
        ];
        foreach ($rows as $row)\App\Menu::create($row);
    }
}
