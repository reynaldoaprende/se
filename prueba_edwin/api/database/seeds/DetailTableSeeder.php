<?php
use Illuminate\Database\Seeder;
use App\Detail;
use App\DetailType;
class DetailTableSeeder extends Seeder
{
    public function run()
    {
        $rows=[
            [
                "type"=>"Tipo de documento","code"=>"DEMO",
                "details"=>['PA','CE','CC','TI','RC']
            ],
            [
                "type"=>"Sexo","code"=>"DEMO",
                "details"=>["Femenino","Masculino","Intersex"]
            ],
            [
                "type"=>"Estado civil","code"=>"DEMO",
                "details"=>["Casado(a)","Soltero(a)","Unión libre","Noviazgo","Separado","Viudo","NA"]
            ],
            [
                "type"=>"Escolaridad","code"=>"DEMO",
                "details"=>["Primaria I","Primaria C","Bachiller I","Bachiller C","Técnico","Tecnólogo","Profesional","Posgrado","Sin estudios"]
            ],
            [
                "type"=>"Manera afectacion pandemia","code"=>"DEMO",
                "details"=>["Psicológico","Emocional","Físico","Familiar","Económico","Todas las anteriores"]
            ],
            [
                "type"=>"Vacuna aplicada","code"=>"DEMO",
                "details"=>["Pfizer","Moderna","Sinovac","Astrazeneca","Janssen"]
            ],
            [
                "type"=>"Vacuna razones","code"=>"DEMO",
                "details"=>["La vacuna contra el Covid - 19 puede causar variante","La vacuna contra Covid- 19 tiene un microchip","La vacuna es para manipular a las personas","La vacuna no sirve","Otro"]
            ],
            [
                "type"=>"Tipo de discapacidad","code"=>"DEMO",
                "details"=>["Auditiva","Visual","Sordoceguera","Intelectual","Psicosocial (mental)","Múltiple"]
            ],
            [
                "type"=>"Practica problematica sustancias","code"=>"DEMO",
                "details"=>["Sustancias psicoactivas","Alcohol","Juegos","Alimentos","Sexo","Trabajo","Dispositivos electrónicos","Ninguna de las anteriores"]
            ],
            [
                "type"=>"Sintomas ultima semana","code"=>"DEMO",
                "details"=>["Fiebre en 37,5 grados o más","Dolor de cabeza","Dificultad para respirar","Dolor de garganta","Tos seca y persistente","Perdida del olfato o del gusto","Secreciones nasales","Fatiga o decaimiento","Dolor en el cuerpo o malestar general","Ninguna de las anteriores"]
            ],

            [
                "type"=>"Tiempo en quedarse dormido","code"=>"pittsburgh",
                "details"=>[
                    ["name"=>"Menos de 15 minutos","value"=>0],
                    ["name"=>"16-30 minuto","value"=>1],
                    ["name"=>"31-60 minutos","value"=>2],
                    ["name"=>"Más de 60 minutos","value"=>3]
                ]
            ],
            [
                "type"=>"Likert Semana Mes","code"=>"pittsburgh",
                "details"=>[
                    ["name"=>"Ninguna vez en el último mes","value"=>0],
                    ["name"=>"Menos de una vez a la semana","value"=>1],
                    ["name"=>"Una o dos veces a la semana","value"=>2],
                    ["name"=>"Tres o más veces a la semana","value"=>3]
                ]
            ],
            [
                "type"=>"Likert Problematico","code"=>"pittsburgh",
                "details"=>[
                    ["name"=>"Nada problemático","value"=>0],
                    ["name"=>"Sólo ligeramente problemático","value"=>1],
                    ["name"=>"Moderadamente problemático","value"=>2],
                    ["name"=>"Muy problemático","value"=>3]
                ]
            ],
            [
                "type"=>"Likert Buena Mala","code"=>"pittsburgh",
                "details"=>[
                    ["name"=>"Muy buena","value"=>0],
                    ["name"=>"Bastante buena","value"=>1],
                    ["name"=>"Bastante mala","value"=>2],
                    ["name"=>"Muy mala","value"=>3]
                ]
            ],

            //Unidad Familiar y Amistad
            [
                "type"=>"Likert Nunca Siempre","code"=>"unity",
                "details"=>[
                    ["name"=>"Nunca","value"=>1],
                    ["name"=>"Algunas veces","value"=>2],
                    ["name"=>"Casi siempre","value"=>3],
                    ["name"=>"Siempre","value"=>4]
                ]
            ],
            [
                "type"=>"Likert Nunca Siempre Inversa","code"=>"unity",
                "details"=>[
                    ["name"=>"Nunca","value"=>4],
                    ["name"=>"Algunas veces","value"=>3],
                    ["name"=>"Casi siempre","value"=>2],
                    ["name"=>"Siempre","value"=>1]
                ]
            ],

            //Cicardiana
            [
                "type"=>"Likert Levantarse","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"05:00–06:30 h","value"=>5],
                    ["name"=>"06:30–07:45 h","value"=>4],
                    ["name"=>"07:45–09:45 h","value"=>3],
                    ["name"=>"09:45–11:00 h","value"=>2],
                    ["name"=>"11:00–12:00 h","value"=>1]
                ]
            ],
            [
                "type"=>"Likert Acostarse","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"20:00–21:00 h","value"=>5],
                    ["name"=>"21:00–22:15 h","value"=>4],
                    ["name"=>"22:15–00:30 h","value"=>3],
                    ["name"=>"00:30–01:45 h","value"=>2],
                    ["name"=>"01:45–03:00 h","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Aviso Despertador","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Ni un poco","value"=>4],
                    ["name"=>"Razonablemente","value"=>3],
                    ["name"=>"Moderadamente","value"=>2],
                    ["name"=>"Bastante","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Facil Levantarse","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Muy difícil","value"=>1],
                    ["name"=>"Razonablemente difícil","value"=>2],
                    ["name"=>"Razonablemente fácil","value"=>3],
                    ["name"=>"Muy fácil","value"=>4],
                ]
            ],
            [
                "type"=>"Likert Levantarse Primera Media Hora","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Nada alerta","value"=>1],
                    ["name"=>"Un poco alerta","value"=>2],
                    ["name"=>"Moderadamente alerta","value"=>3],
                    ["name"=>"Muy alerta","value"=>4],
                ]
            ],
            [
                "type"=>"Likert Levantarse Apetito Media Hora","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Nada de apetito","value"=>1],
                    ["name"=>"Apetito razonable","value"=>2],
                    ["name"=>"Apetito moderado","value"=>3],
                    ["name"=>"Mucho apetito","value"=>4],
                ]
            ],
            [
                "type"=>"Likert Levantarse Sentirse Media Hora","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Muy cansado","value"=>1],
                    ["name"=>"Un poco cansado","value"=>2],
                    ["name"=>"Moderadamente despierto","value"=>3],
                    ["name"=>"Muy despierto","value"=>4],
                ]
            ],
            [
                "type"=>"Likert Levantarse No Compromisos Acostarse","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Nunca después de lo habitual","value"=>4],
                    ["name"=>"Menos de una hora después de lo habitual","value"=>3],
                    ["name"=>"1 a 2 horas después de lo habitual","value"=>2],
                    ["name"=>"Más de 2 horas después de lo habitual","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Ejercicio Reloj Interno","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Estaría en buena forma","value"=>4],
                    ["name"=>"Estaría razonablemente en forma","value"=>3],
                    ["name"=>"Difícil","value"=>2],
                    ["name"=>"Muy difícil","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Cansado Dormir","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"20:00–21:00 h","value"=>5],
                    ["name"=>"21:00–22:15 h","value"=>4],
                    ["name"=>"22:15–00:45 h","value"=>3],
                    ["name"=>"00:45–02:00 h","value"=>2],
                    ["name"=>"02:00–03:00 h","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Rendimiento Planificar Prueba","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"08–10 h","value"=>6],
                    ["name"=>"11–13 h","value"=>4],
                    ["name"=>"15–17 h","value"=>2],
                    ["name"=>"19–21 h","value"=>0],
                ]
            ],
            [
                "type"=>"Likert Cansado 11 Dormir","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Nada cansado","value"=>0],
                    ["name"=>"Un poco cansado","value"=>2],
                    ["name"=>"Moderadamente cansado","value"=>3],
                    ["name"=>"Muy cansado","value"=>5],
                ]
            ],
            [
                "type"=>"Likert Acostarse Tarde Levantarse Habitual","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Despertaría en el horario usual y no volvería a dormir","value"=>4],
                    ["name"=>"Despertaría en el horario usual y después dormitaría","value"=>3],
                    ["name"=>"Despertaría en el horario usual y volvería a dormir","value"=>2],
                    ["name"=>"Despertaría más tarde de lo usual","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Permanecer Despierto Guardia","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"No acostarme hasta pasada la guardia","value"=>1],
                    ["name"=>"Echar una siesta antes y dormir después 3","value"=>2],
                    ["name"=>"Echar un buen sueño antes y una siesta después","value"=>3],
                    ["name"=>"Sólo dormirías antes de la guardia","value"=>4],
                ]
            ],
            [
                "type"=>"Likert Trabajo Fisico Pesado","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"08–10 h","value"=>1],
                    ["name"=>"11–13 h","value"=>2],
                    ["name"=>"15–17 h","value"=>3],
                    ["name"=>"19–21 h","value"=>4],
                ]
            ],
            [
                "type"=>"Likert Ejercicio Fisico Intenso","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Estaría en buena forma","value"=>1],
                    ["name"=>"Estaría en una forma aceptable","value"=>2],
                    ["name"=>"Me resultaría difícil","value"=>3],
                    ["name"=>"Me resultaría muy difícil","value"=>4],
                ]
            ],
            [
                "type"=>"Likert Escoger Horario","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Entre las 04:00 y las 08:00","value"=>5],
                    ["name"=>"Entre las 08:00 y las 09:00","value"=>4],
                    ["name"=>"Entre las 09:00 y las 14:00","value"=>3],
                    ["name"=>"Entre las 14:00 y las 17:00","value"=>2],
                    ["name"=>"Entre las 17:00 y las 04:00","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Maximo Bienestar","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Entre las 05:00 y las 08:00","value"=>5],
                    ["name"=>"Entre las 08:00 y las 10:00","value"=>4],
                    ["name"=>"Entre las 10:00 y las 17:00","value"=>3],
                    ["name"=>"Entre las 17:00 y las 22:00","value"=>2],
                    ["name"=>"Entre las 22:00 y las 05:00","value"=>1],
                ]
            ],
            [
                "type"=>"Likert Matunino Vespertino","code"=>"cicardiana",
                "details"=>[
                    ["name"=>"Un tipo claramente matutino.","value"=>6],
                    ["name"=>"Un tipo más matutino que vespertino.","value"=>4],
                    ["name"=>"Un tipo más vespertino que matutino.","value"=>2],
                    ["name"=>"Un tipo claramente vespertino.","value"=>0],
                ]
            ],

            //Affection
            [
                "type"=>"Likert General Affection","code"=>"affection",
                "details"=>[
                    ["name"=>"Completamente en desacuerdo","value"=>1],
                    ["name"=>"En desacuerdo","value"=>2],
                    ["name"=>"Ni de acuerdo ni en desacuerdo","value"=>3],
                    ["name"=>"De acuerdo","value"=>4],
                    ["name"=>"Completamente de acuerdo.","value"=>5]
                ]
            ],

            //Violence
            [
                "type"=>"Likert Violence Frequency","code"=>"violence",
                "details"=>[
                    ["name"=>"Nunca","value"=>1],
                    ["name"=>"Algunas veces","value"=>2],
                    ["name"=>"Bastante","value"=>3],
                    ["name"=>"Con mucha frecuencia","value"=>4],
                    ["name"=>"Siempre","value"=>5]
                ]
            ],
            [
                "type"=>"Likert Violence Damage","code"=>"violence",
                "details"=>[
                    ["name"=>"Nada","value"=>1],
                    ["name"=>"Muy poco","value"=>2],
                    ["name"=>"Poco","value"=>3],
                    ["name"=>"Bastante","value"=>4],
                    ["name"=>"Mucho","value"=>5]
                ]
            ],

            //Edwin
            [
                "type"=>"xxxx","code"=>"edwin",
                "details"=>[
                    ["name"=>"Reynaldo 1","value"=>1],
                    ["name"=>"Reynaldo 2","value"=>2],
                    ["name"=>"Reynaldo 3","value"=>3],
                    ["name"=>"Reynaldo 4","value"=>4]
                ]
            ],
            [
                "type"=>"yyyy","code"=>"edwin",
                "details"=>[
                    ["name"=>"Erick 1","value"=>1],
                    ["name"=>"Erick 2","value"=>2],
                    ["name"=>"Erick 3","value"=>3],
                    ["name"=>"Erick 4","value"=>4]
                ]
            ]
        ];
        foreach ($rows as $row){
            $t = DetailType::create([
                "name"=>$row["type"],
                "code"=>$row["code"]
            ]);
            foreach($row["details"] as $d){
                if(!isset($d["name"])){
                    $d = Detail::create([
                       "detail_type_id"=>$t->id,
                       "name"=> $d
                    ]);
                }else{
                    $d = Detail::create([
                        "detail_type_id"=>$t->id,
                        "name"=> $d["name"],
                        "value"=> $d["value"]
                     ]);
                }
            }
        }
    }
}
