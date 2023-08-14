<?php
use Illuminate\Database\Seeder;
class MessageTableSeeder extends Seeder
{
    public function run()
    {
        $rows=[
            "Gracias por completar este apartado. Para nosotros es importante contribuir a su bienestar.",
            "Gracias por diligenciar estos apartados. En conjunto podemos seguir contribuyendo al fortalecimiento de su bienestar.",
            "Su salud es importante para nosotros.Trabajemos juntos a favor de su bienestar."
        ];
        foreach ($rows as $row)\App\Message::create(["name"=>$row]);
    }
}
