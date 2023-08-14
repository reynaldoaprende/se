<?php   
namespace App\Http\Controllers;
    use App\Demographic;
    use App\Consent;
    use App\MenuRole;
    use App\Message;
    use App\User;
    use App\Role;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use App\Mail\WelcomeEmail;
    use App\Mail\RecoverPassword;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB, Mail;
    use PDF;

    use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

    public function current()
    {
        return response()->json($this->guard()->user());
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('document', 'password');
        $user = User::where('document',$request->document)->with("role")->first();
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success'=>false,'user'=>$user,'data'=>$credentials,'message' => 'Contraseña y/o documento inválido'], 200);
            }
        } catch (JWTException $e) {
            $response = [
                'success'=>false,
                'user'=>$user,
                'data'=>$credentials,
                'error'=>$e,
                'message' => 'Error al iniciar sesión.'
            ];

            return response()->json($response, 200);
        }
        $messages = Message::get();
        $menu = MenuRole::select("m.*")->join("menus as m","menu_roles.menu_id","=","m.id")->where("menu_roles.role_id",$user->role_id)->get();
        
        //Check consent
        $consent = null;
        if(is_null($user->content_date))$consent = Consent::first();
        return response()->json(['success'=>true,'consent'=>$consent,'menu'=>$menu,'data'=>$credentials,'message'=>'Bienvenido(a)','user' => $user,'token'=>$token,'messages'=>$messages]);
    }

    public function valid()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('user'));
    }
        /**
         * Log out
         * Invalidate the token, so user cannot use it anymore
         * They have to relogin to get a new token
         *
         * @param Request $request
         */
        public function logout(Request $request) {
            $this->guard()->logout();
            return response()->json([
                'success' => true, 'message'=>'Se cerro la sesión exitosamente'
            ]);
            // return response(null, 204);
        }

        public function store(Request $request) {
            $user = JWTAuth::parseToken()->authenticate();
            $data = User::find($request->id);
            $validator = Validator::make($request->all(), [
                'document' => 'required|max:150|unique:users,document,'.$data->id,
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255'
            ])
            ->setAttributeNames([
                'document' => 'documento de identidad',
                'name' => 'nombre',
                'last_name' => 'apellido',
                'phone' => 'teléfono',
                'address' => 'dirección'
            ]);

            if($validator->fails()){
                    return response()->json(["success"=>false, "validators"=>$validator->errors(), "message"=>null], 200);
            }
            if(!$data)$data = new User();

            $data->document = $request->document;
            $data->address = $request->address;
            $data->phone = $request->phone;
            $data->name = strtoupper($request->name);
            $data->last_name = strtoupper($request->last_name);
            $data->email = $request->email;
            if($request->password)$data->password = Hash::make($request->password);
            $data->save();
            return response()->json([
                'success' => true, 'message'=>'Cambios registrados correctamente', "data"=>$data
            ]);
        }

        public function confirmconsent(Request $request) {
            $user = JWTAuth::parseToken()->authenticate();
            $data = User::find($user->id);
            $data->consent_id = $request->id;
            $data->consent_date = Carbon::now('America/Bogota');
            $data->save();
            
            return response()->json([
                'success' => true, 'message'=>'Actualizado correctamente', "data"=>$data
            ]);
        }

        public function remove(Request $request) {
            $user = JWTAuth::parseToken()->authenticate();
            $data = User::find($request->id);
            $data->deleted_user_at = $user->id;
            $data->deleted_at = Carbon::now('America/Bogota');
            $data->save();
            
            return response()->json([
                'success' => true, 'message'=>'Eliminado correctamente', "data"=>$data
            ]);
        }

        public function list(Request $request) {
            $user = JWTAuth::parseToken()->authenticate();
            $data = User::where('id','<>',$user->id)->with('role')->get();
            return response()->json([
                'success' => true, 'message'=>'Listado correctamente', "data"=>$data
            ]);
        }


        public function find(Request $request) {
            $user = JWTAuth::parseToken()->authenticate();
            $userRole = Role::where("name","Usuario")->first();
            $data = null;
            if($userRole->id!=$user->role_id){
                $data = User::where('document',$request->document)->where("role_id",$userRole->id);
                $data = $data->first();
            }
            return response()->json([
                'success' => true, 'message'=>'Consultado correctamente', "data"=>$data
            ]);
        }

        public function detail(Request $request) {
            $user = JWTAuth::parseToken()->authenticate();
            $data = User::where('id',$user->id)->first();
            return response()->json([
                'success' => true, 'message'=>'Consultado correctamente', "data"=>$data
            ]);
        }

        public function recover(Request $request) {
            $validator = Validator::make($request->all(), [
                'document' => 'required',
                'email' => 'required|string|email',
            ])
            ->setAttributeNames([
                'document' => 'documento de identidad',
                'email' => 'email',
            ]);

            if($validator->fails())
                    return response()->json(["success"=>false, "validators"=>$validator->errors(), "message"=>null], 200);
            
            $data = User::where('document',$request->document)->where('email',$request->email)->first();
            $success = false;
            $message = "No existe este usuario";
            $newPassword = null;
            if(!is_null($data)){
                $newPassword = rand(5555,9999);
                $message = "Tu nueva contraseña fue enviada a tu correo eletrónico";
                $success = true;
                $data->password = Hash::make($newPassword);
                $data->save();
            }
            Mail::to($request->email)->send(new RecoverPassword($request->name.' '.$request->last_name, $newPassword));
            return response()->json([
                'success' => $success, 'message'=>$message
            ]);
        }

    public function init(Request $request) {
        $role = Role::where("name","Usuario")->first();
        $data = User::where('document',$request->document)->first();
        $exist = !is_null($data);
        $success = false;
        $isAdmin = $exist&&$role->id!=$data->role_id;
        if($exist&&$role->id!=$data->role_id){
            $success = true;
            $message = "Ingresa tu contraseña para poder ingresar";
        }else if($exist&&$role->id==$data->role_id){
            $success = true;
            $message = "Hola, bienvenido nuevamente. Tienes una sesión iniciada, ¿DESEAS CONTINUAR?";
        }else if(!$exist){
            $success = true;
            $message = "¿Eres nuevo? Si es así, ¿deseas continuar y responder el formulario?";
        }

        return response()->json([
            'success' => $success,'exist'=>$exist, 'message'=>$message, 'admin'=>$isAdmin,'document'=>$data
        ]);
    }

    public function last($user_id){
        $last_form = null;
        $search = Demographic::select(
            "demographics.user_id",
            "demographics.id as demo",
            "u.id as unity",
            "p.id as pittsburgh",
            "c.id as cicardian",
            "a.id as affection",
            "v.id as violence",
            DB::raw("
            CASE
                WHEN v.id IS NOT NULL THEN 'finish'
                WHEN a.id IS NOT NULL THEN 'violence'
                WHEN c.id IS NOT NULL THEN 'affection'
                WHEN p.id IS NOT NULL THEN 'cicardian'
                WHEN u.id IS NOT NULL THEN 'pittsburgh'
                WHEN demographics.id IS NOT NULL THEN 'unity'
                ELSE NULL
            END as current")
        )
        ->leftJoin("unity as u","demographics.user_id","=","u.user_id")
        ->leftJoin("pittsburgh as p","demographics.user_id","=","p.user_id")
        ->leftJoin("cicardian as c","demographics.user_id","=","c.user_id")
        ->leftJoin("affection as a","demographics.user_id","=","a.user_id")
        ->leftJoin("violence as v","demographics.user_id","=","v.user_id")
        ->where("demographics.user_id",$user_id)
        ->first();
        $last_form = is_null($search)?NULL:$search->current;
        return $last_form;
    }

    public function enter(Request $request) {
        $data = User::where('document',$request->document)->first();
        $menu = [];
        if(is_null($data)){
            $role = Role::where("name","Usuario")->first();
            $data = new User();
            $data->document = $request->document;
            $data->role_id = $role->id; //Rol de Usuario
            $data->enabled = Carbon::now('America/Bogota'); //Habilitado al tener la fecha desde que se registra
            $data->created_at = Carbon::now('America/Bogota');
            $data->save();
        }
        $menu = MenuRole::select("m.*")->join("menus as m","menu_roles.menu_id","=","m.id")->where("menu_roles.role_id",$data->role_id)->get();
        $token = JWTAuth::fromUser($data);
        $messages = Message::get();
        //Check last form
        if(!is_null($data)&&$data->last_form_code==null){
            $l = $this->last($data->id);
            $notNull = $l!=null&&$data->last_form_code==null;
            $data->last_form_code = $l;
            if($notNull)$data->save();
        }
        //Check consent
        $consent = null;
        if(is_null($data->content_date))$consent = Consent::first();
        return response()->json([
            'success' => true,'last'=>$this->last($data->id),'consent'=>$consent,'menu'=>$menu,'token'=>$token,'messages'=>$messages,'user'=>$data,'message'=>"Bienvenido, recuerda concentrarte para responder las preguntas con calma"
        ]);
    }

    public function report(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();

        $roles = Role::get();
        $userRole = $roles->where("name","Usuario")->first();
        $adminRole = $roles->where("name","Administrador")->first();
        $coordRole = $roles->where("name","Coordinador")->first();
        $isAdmin = !is_null($adminRole) && $adminRole->id==$user->role_id;
        $isCoord = !is_null($coordRole) && $coordRole->id==$user->role_id;

        $created_user_at = ($isCoord?$user->id:null);

        $demographics = $this->demographic_report($request->user_id,$created_user_at);
        $pittsburgh = $this->pittsburgh_report($request->user_id,$created_user_at);
        $unity = $this->unity_report($request->user_id,$created_user_at);
        $cicardian = $this->cicardian_report($request->user_id,$created_user_at);
        $affection = $this->affection_report($request->user_id,$created_user_at);
        $violence_damage = $this->violence_damage_report($request->user_id,$created_user_at);
        $violence_frequency = $this->violence_frequency_report($request->user_id,$created_user_at);

        //Merge Violence Frequency and Damage
        //All objects
        $violence = [];
        foreach($violence_frequency as $vf){
            $res = $vf->toArray();
            $vd = $violence_damage->where("user_id",$vf->user_id)->first();
            if(!is_null($vd))$res = array_merge($res,$vd->toArray());
            array_push($violence,$res);
        }

        foreach($pittsburgh as $r)$r = $this->pittsburgh($r);
        foreach($unity as $r)$r = $this->unity($r);
        foreach($cicardian as $r)$r = $this->cicardian($r);
        foreach($affection as $r)$r = $this->affection($r);
        foreach($violence as $v){
            $v = $this->violence($v);
        }
        //Violence
        for ($i = 0; $i <= count($violence)-1; $i++) {
            $violence[$i] = $this->violence($violence[$i]);
        }
        // return response()->json($violence);
        //All objects
        $result = [];
        foreach($demographics as $d){
            $res = $d->toArray();
            
            $u = $unity->where("user_id",$d->user_id)->first();
            if(!is_null($u))$res = array_merge($res,$u->toArray());

            $p = $pittsburgh->where("user_id",$d->user_id)->first();
            if(!is_null($p))$res = array_merge($res,$p->toArray());
            
            $c = $cicardian->where("user_id",$d->user_id)->first();
            if(!is_null($c))$res = array_merge($res,$c->toArray());
            
            $a = $affection->where("user_id",$d->user_id)->first();
            if(!is_null($a))$res = array_merge($res,$a->toArray());
            
            $v = collect($violence)->where("user_id",$d->user_id)->first();
            if(!is_null($v))$res = array_merge($res,$v);

            $res = (object)$res;
            array_push($result,$res);
        }
        
        $objects = null;
        $query = null;
        $objects["demographics"] = $demographics;
        $objects["pittsburgh"] = $pittsburgh;
        $objects["unity"] = $unity;
        $objects["cicardian"] = $cicardian;
        $objects["affection"] = $affection;
        $objects["violence"] = $violence;
        return response()->json([
            'success' => true,'data'=>$result,'query'=>$query,'objects'=>$objects, 'isAdmin'=>$isAdmin,'created_user_at'=>$created_user_at
        ]);
    }

    public function demographic_report($user_id,$created_user_at){
        $demographics = User::select("d.user_id","users.id as userid","loc.name as birthdate_place","locr.name as city")
        ->join("demographics as d","users.id","=","d.user_id")
        ->join("locations as loc","d.birthdate_place_id","=","loc.id")
        ->join("locations as locr","d.city_id","=","locr.id");
        $demographics = $demographics->addSelect(
            DB::raw("(select GROUP_CONCAT(dtconcat.name) from details as dtconcat inner join demographic_symptoms as ds on dtconcat.id=ds.symptoms_last_week_id where ds.demographic_id=d.id group by d.id limit 1) as demographic_symptoms"));
        $columnsDetails = [
            'document_type_id'
            ,'gender_id'
            ,'civil_status_id'
            ,"scholarship_id"
            ,"pandemic_affectation_way_id"
            ,"psychoactive_substances_id"
        ];
        $columnsDetailsOptionals = [
            'applied_vaccine_id'
            ,"reason_not_vaccinated_id"
            ,"disability_type_id"
        ];
        $columns = [
            'd.name'
            ,'d.age'
            ,'d.document'
            ,'d.birthdate_place_id'
            ,'d.birthdate'
            ,"d.occupation"
            ,"d.email"
            ,"d.socioeconomic"
            ,"d.sick_covid"
            ,"d.vaccinate_covid"
            ,"d.relative_covid"
            ,"d.full_dose"
            ,"d.disability"
        ];
        for ($i = 0; $i <= count($columnsDetails)-1; $i++) {
            $cd = $columnsDetails[$i];
            $demographics = $demographics->join('details as dt'.$i,"d.".$cd,"=","dt".$i.".id");
            $demographics = $demographics->addSelect('dt'.$i.'.name as '.$cd);
        }
        for ($i = 0; $i <= count($columnsDetailsOptionals)-1; $i++) {
            $cd = $columnsDetailsOptionals[$i];
            $demographics = $demographics->leftJoin('details as dto'.$i,"d.".$cd,"=","dto".$i.".id");
            $demographics = $demographics->addSelect('dto'.$i.'.name as '.$cd);
        }
        foreach($columns as $c)$demographics = $demographics->addSelect($c);
        if(isset($user_id))$demographics = $demographics->where("users.id",$user_id);
        if(isset($created_user_at))$demographics = $demographics->where("d.created_user_at",$created_user_at);
        $demographics = $demographics->get();
        return $demographics;
    }

    public function unity_report($user_id,$created_user_at){
        $unity = User::select("unity.user_id","users.id as userid")
        ->join('unity as unity',"users.id","=","unity.user_id");
        $columnsDetails = [    
            'how_often_affected_unexpectedly_id'
            ,'how_often_felt_unable_control_your_life_id'
            ,'how_often_nervous_or_stressed_id'
            ,'how_often_ability_handle_personal_problems_id'
            ,'how_often_things_going_well_you_id'
            ,'how_often_cope_all_things_id'
            ,'how_often_control_difficulties_id'
            ,'how_often_all_under_control_id'
            ,'how_often_angry_out_control_id'
            ,'how_often_difficulties_cannot_overcome_id'
            
            ,'feel_nervous_anxious_id'
            ,'feel_scares_no_reason_id'
            ,'feel_angry_easily_or_panic_id'
            ,'feel_falling_apart_id'
            ,'feel_arms_legs_shake_id'
            ,'feel_bothered_headaches_neck_pain_id'
            ,'feel_week_easily_tired_id'
            ,'feel_hear_beating_fast_id'
            ,'feel_dizziness_bothers_id'
            ,'feel_faint_fainting_spells_id'
            ,'feel_numbness_tingling_fingers_toes_id'
            ,'feel_bother_stomach_aches_id'
            ,'feel_empty_bladder_id'
            ,'feel_red_hot_face_id'
            ,'feel_nightmares_id'

            ,'stop_being_sad_id'
            ,'felt_depressed_id'
            ,'thought_my_life_has_been_failure_id'
            ,'felt_nervous_id'
            ,'was_happy_id'
            ,'felt_alone_id'
            ,'enjoyed_life_id'
            ,'have_crying_crisis_id'
            ,'felt_sad_id'
            ,'felt_couldnt_go_on_id'

            
            ,'have_thought_life_not_worth_living_id'
            ,'have_wished_were_dead_id'
            ,'have_thought_ending_your_life_id'
            ,'have_tried_kill_yourself_id'

            ,'do_you_have_someone_talk_id'
            ,'do_you_have_friend_talk_id'
            ,'do_you_have_someone_family_solve_poblems_id'
            ,'have_friend_solve_personal_problem_id'
            ,'your_parents_show_love_affection_id'
            ,'do_you_have_friend_show_affection_id'
            ,'do_you_trust_family_things_worry_id'
            ,'do_you_trust_friend_things_worry_id'
            ,'someone_family_support_problems_school_id'
            ,'someone_friend_help_homework_work_id'
            ,'someone_friend_support_problems_school_id'
            ,'family_talk_problems_all_supports_id'
            ,'satisfied_support_family_id'
            ,'satisfied_support_friend_id'
        ];
        for ($i = 0; $i <= count($columnsDetails)-1; $i++) {
            $cd = $columnsDetails[$i];
            $unity = $unity->join('details as dtunity'.$i,"unity.".$cd,"=","dtunity".$i.".id");
            $unity = $unity->addSelect('dtunity'.$i.'.name as '.$cd);
            $unity = $unity->addSelect('dtunity'.$i.'.value as '.$cd.'_value');
        }
        if(isset($user_id))$unity = $unity->where("users.id",$user_id);
        if(isset($created_user_at))$unity = $unity->where("unity.created_user_at",$created_user_at);
        $unity = $unity->get();
        return $unity;
    }

    public function pittsburgh_report($user_id,$created_user_at){
        $pittsburgh = User::select("p.user_id","users.id as userid")
        ->join('pittsburgh as p',"users.id","=","p.user_id");
        $columnsDetails = [
            'last_month_time_asleep_id'
            ,'cant_asleep_first_half_hour_id'
            ,'awaking_half_night_id'
            ,'awaking_go_to_bathroom_id'
            ,'cant_breathe_well_id'
            ,'cough_loudly_id'
            ,'cold_feel_id'
            ,'heat_feel_id'
            ,'have_nightmares_id'
            ,'have_smells_id'
            ,'other_reasons_id'
            ,'take_pill_id'
            ,'last_month_problems_stay_awake_id'
            ,'last_month_enthusiasm_id'
            ,'last_month_sleep_quality_id'
        ];
        $columns = [
            'p.time_sleep_night'
            ,'p.last_month_awaing_habitually_morning'
            ,'p.last_month_hours_sleep_each_night'
        ];
        for ($i = 0; $i <= count($columnsDetails)-1; $i++) {
            $cd = $columnsDetails[$i];
            $pittsburgh = $pittsburgh->join('details as dtp'.$i,"p.".$cd,"=","dtp".$i.".id");
            $pittsburgh = $pittsburgh->addSelect('dtp'.$i.'.name as '.$cd);
            $pittsburgh = $pittsburgh->addSelect('dtp'.$i.'.value as '.$cd.'_value');
        }
        foreach($columns as $c)$pittsburgh = $pittsburgh->addSelect($c);
        if(isset($user_id))$pittsburgh = $pittsburgh->where("users.id",$user_id);
        if(isset($created_user_at))$pittsburgh = $pittsburgh->where("p.created_user_at",$created_user_at);
        $pittsburgh = $pittsburgh->get();
        return $pittsburgh;
    }

    public function violence_damage_report($user_id,$created_user_at){
        $violence_damage = User::select("vd.user_id","users.id as userid")
        ->join('violence as vd',"users.id","=","vd.user_id");
        $columnsDetails = [
            'damage_my_partner_told_me_grooming_id'
            ,'damage_my_partner_pushed_me_hard_id'
            ,'damage_my_partner_gets_angry_what_wants_id'
            ,'damage_my_partner_criticizes_me_lover_id'
            ,'damage_my_partner_rejects_have_sex_id'
            ,'damage_my_partner_monitors_everything_id'
            ,'damage_my_partner_said_ugly_unattractive_id'
            ,'damage_my_partner_take_account_sexual_id'
            ,'damage_my_partner_forbids_friends_id'
            ,'damage_my_partner_uses_money_control_me_id'
            ,'damage_my_partner_hit_something_scare_me_id'
            ,'damage_my_partner_threatened_leave_me_id'
            ,'damage_i_have_afraid_partner_id'
            ,'damage_my_partner_has_forced_have_sex_id'
            ,'damage_my_partner_upset_successes_id'
            ,'damage_my_partner_has_hit_me_id'
            ,'damage_my_partner_forbids_work_studying_id'
            ,'damage_my_partner_verbally_assaults_id'
            ,'damage_my_partner_angry_children_should_id'
            ,'damage_my_partner_angry_tell_money_id'
            ,'damage_my_partner_gets_upset_food_works_id'
            ,'damage_my_partner_gets_jealous_friends_id'
            ,'damage_my_partner_manages_money_id'
            ,'damage_my_partner_blackmails_me_money_id'
            ,'damage_my_partner_has_come_insult_me_id'
            ,'damage_my_partner_financially_angry_id'
            ,'damage_my_partner_made_fun_some_part_body_id'
            ,'damage_ive_told_hes_blame_our_problems_id'
            ,'damage_i_have_come_yell_partner_id'
            ,'damage_i_have_angry_contradicts_disagrees_id'
            ,'damage_i_have_come_insult_my_partner_id'
            ,'damage_i_have_threatened_partner_leave_id'
            ,'damage_when_he_verbally_attack_my_partner_id'
            ,'damage_i_take_sexual_needs_partner_id'
            ,'damage_i_have_forbidden_partner_friends_id'
            ,'damage_i_have_physically_hurt_partner_id'
            ,'damage_it_bothers_my_partner_spends_money_id'
            ,'damage_i_have_required_my_partner_spends_id'
            ,'damage_i_have_told_my_partner_is_ugly_id'
        ];
        for ($i = 0; $i <= count($columnsDetails)-1; $i++) {
            $cd = $columnsDetails[$i];
            $violence_damage = $violence_damage->join('details as dtviolencedamage'.$i,"vd.".$cd,"=","dtviolencedamage".$i.".id");
            $violence_damage = $violence_damage->addSelect('dtviolencedamage'.$i.'.name as '.$cd);
            $violence_damage = $violence_damage->addSelect('dtviolencedamage'.$i.'.value as '.$cd.'_value');
        }
        if(isset($user_id))$violence_damage = $violence_damage->where("users.id",$user_id);
        if(isset($created_user_at))$violence_damage = $violence_damage->where("vd.created_user_at",$created_user_at);
        $violence_damage = $violence_damage->get();
        return $violence_damage;
    }

    public function violence_frequency_report($user_id,$created_user_at){
        $violence_frequency = User::select("vf.user_id","users.id as userid")
        ->join('violence as vf',"users.id","=","vf.user_id");
        $columnsDetails = [    
            'frequency_my_partner_told_me_grooming_id'
            ,'frequency_my_partner_pushed_me_hard_id'
            ,'frequency_my_partner_gets_angry_what_wants_id'
            ,'frequency_my_partner_criticizes_me_lover_id'
            ,'frequency_my_partner_rejects_have_sex_id'
            ,'frequency_my_partner_monitors_everything_id'
            ,'frequency_my_partner_said_ugly_unattractive_id'
            ,'frequency_my_partner_take_account_sexual_id'
            ,'frequency_my_partner_forbids_friends_id'
            ,'frequency_my_partner_uses_money_control_me_id'
            ,'frequency_my_partner_hit_something_scare_me_id'
            ,'frequency_my_partner_threatened_leave_me_id'
            ,'frequency_i_have_afraid_partner_id'
            ,'frequency_my_partner_has_forced_have_sex_id'
            ,'frequency_my_partner_upset_successes_id'
            ,'frequency_my_partner_has_hit_me_id'
            ,'frequency_my_partner_forbids_work_studying_id'
            ,'frequency_my_partner_verbally_assaults_id'
            ,'frequency_my_partner_angry_children_should_id'
            ,'frequency_my_partner_angry_tell_money_id'
            ,'frequency_my_partner_gets_upset_food_works_id'
            ,'frequency_my_partner_gets_jealous_friends_id'
            ,'frequency_my_partner_manages_money_id'
            ,'frequency_my_partner_blackmails_me_money_id'
            ,'frequency_my_partner_has_come_insult_me_id'
            ,'frequency_my_partner_financially_angry_id'
            ,'frequency_my_partner_made_fun_some_part_body_id'
            ,'frequency_ive_told_hes_blame_our_problems_id'
            ,'frequency_i_have_come_yell_partner_id'
            ,'frequency_i_have_angry_contradicts_disagrees_id'
            ,'frequency_i_have_come_insult_my_partner_id'
            ,'frequency_i_have_threatened_partner_leave_id'
            ,'frequency_when_he_verbally_attack_my_partner_id'
            ,'frequency_i_take_sexual_needs_partner_id'
            ,'frequency_i_have_forbidden_partner_friends_id'
            ,'frequency_i_have_physically_hurt_partner_id'
            ,'frequency_it_bothers_my_partner_spends_money_id'
            ,'frequency_i_have_required_my_partner_spends_id'
            ,'frequency_i_have_told_my_partner_is_ugly_id'
        ];
        for ($i = 0; $i <= count($columnsDetails)-1; $i++) {
            $cd = $columnsDetails[$i];
            $violence_frequency = $violence_frequency->join('details as dtviolencefrequency'.$i,"vf.".$cd,"=","dtviolencefrequency".$i.".id");
            $violence_frequency = $violence_frequency->addSelect('dtviolencefrequency'.$i.'.name as '.$cd);
            $violence_frequency = $violence_frequency->addSelect('dtviolencefrequency'.$i.'.value as '.$cd.'_value');
        }
        if(isset($user_id))$violence_frequency = $violence_frequency->where("users.id",$user_id);
        if(isset($created_user_at))$violence_frequency = $violence_frequency->where("vf.created_user_at",$created_user_at);
        $violence_frequency = $violence_frequency->get();
        return $violence_frequency;
    }

    public function affection_report($user_id,$created_user_at){
        $affection = User::select("a.user_id","users.id as userid")
        ->join('affection as a',"users.id","=","a.user_id");
        $columnsDetails = [    
            'many_times_feel_nervous_id'
            ,'feel_confident_in_life_id'
            ,'im_brave_id'
            ,'feel_tired_last_months_id'
            ,'worried_last_times_id'
            ,'have_determination_want_it_id'
            ,'feel_guilt_did_past_id'
            ,'appasionate_things_i_do_id'
            ,'many_situations_happiness_recent_times_id'
            ,'angry_when_contradict_me_id'
            ,'people_say_moody_id'
            ,'lately_been_situations_angry_id'
            ,'general_feel_strong_id'
            ,'pleasure_experiences_new_things_id'
            ,'feel_satisfied_myself_id'
            ,'irritated_easily_id'
            ,'im_brave_faced_challenge_id'
            ,'im_happy_person_id'
            ,'recent_times_felt_humiliated_id'
            ,'feeling_sad_lately_id'
        ];
        for ($i = 0; $i <= count($columnsDetails)-1; $i++) {
            $cd = $columnsDetails[$i];
            $affection = $affection->join('details as dtaffection'.$i,"a.".$cd,"=","dtaffection".$i.".id");
            $affection = $affection->addSelect('dtaffection'.$i.'.name as '.$cd);
            $affection = $affection->addSelect('dtaffection'.$i.'.value as '.$cd.'_value');
        }
        if(isset($user_id))$affection = $affection->where("users.id",$user_id);
        if(isset($created_user_at))$affection = $affection->where("a.created_user_at",$created_user_at);
        $affection = $affection->get();
        return $affection;
    }

    public function cicardian_report($user_id,$created_user_at){
        $cicardian = User::select("c.user_id","users.id as userid")
        ->join('cicardian as c',"users.id","=","c.user_id");
        $columnsDetails = [
            'awake_hour_id'
            ,'bed_down_hour_id'
            ,'warning_alarm_clock_id'
            ,'easy_awake_id'
            ,'awake_first_half_hour_id'
            ,'awake_appetite_first_half_hour_id'
            ,'awake_feeling_first_half_hour_id'
            ,'awake_not_commited_bed_down_id'
            ,'awake_exercise_internal_clock_id'
            ,'tired_bed_down_hour_id'
            ,'performance_plan_test_hour_id'
            ,'tired_sleep_id'
            ,'bed_down_later_habitual_awake_id'
            ,'stay_awake_guard_id'
            ,'heavy_labor_id'
            ,'heavy_exercise_id'
            ,'choose_schedule_id'
            ,'max_welfare_id'
            ,'morning_evening_id'
        ];
        for ($i = 0; $i <= count($columnsDetails)-1; $i++) {
            $cd = $columnsDetails[$i];
            $cicardian = $cicardian->join('details as dtcicardian'.$i,"c.".$cd,"=","dtcicardian".$i.".id");
            $cicardian = $cicardian->addSelect('dtcicardian'.$i.'.name as '.$cd);
            $cicardian = $cicardian->addSelect('dtcicardian'.$i.'.value as '.$cd.'_value');
        }
        if(isset($user_id))$cicardian = $cicardian->where("users.id",$user_id);
        if(isset($created_user_at))$cicardian = $cicardian->where("c.created_user_at",$created_user_at);
        $cicardian = $cicardian->get();
        return $cicardian;
    }

    public function pittsburgh($r) {
        $r["Eficiencia habitual del sueño - sumatoria"] = $r["last_month_sleep_quality_id_value"];
        $r["Duración total del sueño - sumatoria"] = ($r["last_month_time_asleep_id_value"]+$r["cant_asleep_first_half_hour_id_value"]);
        $r["Latencia del sueño - sumatoria"] = $r["last_month_hours_sleep_each_night"];
        $r["Perturbaciones del sueño - sumatoria"] = 0;
        $r["Calidad del sueño - sumatoria"] = (
            $r["awaking_half_night_id_value"]
            + $r["awaking_go_to_bathroom_id_value"]
            + $r["cant_breathe_well_id_value"]
            + $r["cough_loudly_id_value"]
            + $r["cold_feel_id_value"]
            + $r["heat_feel_id_value"]
            + $r["have_nightmares_id_value"]
            + $r["have_smells_id_value"]
            + $r["other_reasons_id_value"]
        );
        $r["Uso de medicación para dormir - sumatoria"] = $r["take_pill_id_value"];
        $r["Disfunción diurna del sueño - sumatoria"] = ($r["last_month_problems_stay_awake_id_value"]+$r["last_month_enthusiasm_id_value"]);
        

        //Calculos
        $r["Eficiencia habitual del sueño"] = $r["last_month_sleep_quality_id_value"];

        if($r["Duración total del sueño - sumatoria"]==0){
            $r["Duración total del sueño"] = 0;
        }else if($r["Duración total del sueño - sumatoria"]<=2){
            $r["Duración total del sueño"] = 1;
        }else if($r["Duración total del sueño - sumatoria"]<=4){
            $r["Duración total del sueño"] = 2;
        }else if($r["Duración total del sueño - sumatoria"]<=6){
            $r["Duración total del sueño"] = 3;
        }

        $r["_Pittsburgh_Componente_1"] = $r["Duración total del sueño"];
        $r["_Pittsburgh_Componente_2"] = $r["Duración total del sueño - sumatoria"];
        
        if($r["Latencia del sueño - sumatoria"]<5){
            $r["Latencia del sueño"] = 3;
        }else if($r["Latencia del sueño - sumatoria"]<=6){
            $r["Latencia del sueño"] = 2;
        }else if($r["Latencia del sueño - sumatoria"]<=8){
            $r["Latencia del sueño"] = 1;
        }else if($r["Latencia del sueño - sumatoria"]>8){
            $r["Latencia del sueño"] = 0;
        }
        $r["_Pittsburgh_Componente_3"] = $r["Latencia del sueño"];

        $r["Perturbaciones del sueño"] = null;
        $r['__time_sleep_night_value_hour'] = Carbon::parse($r['time_sleep_night'])->format('Hi');
        $r['__last_month_awaing_habitually_morning_value_hour'] = Carbon::parse($r['last_month_awaing_habitually_morning'])->format('Hi');
        $item1 = Carbon::parse($r['time_sleep_night'])->format('Hi');
        $item3 = Carbon::parse($r['last_month_awaing_habitually_morning'])->format('Hi');
        $item4 = ($r['last_month_hours_sleep_each_night'])*100;
        $hBed = null;
        $component4 = null;
        if($item1>=1200){
            $hBed = ((2400-$item1)+$item3);
        }else{
            $hBed = $item3-$item1;
        }
        if($hBed>0)$r["Perturbaciones del sueño - sumatoria"] = ($item4/$hBed)*100;
        if($r["Perturbaciones del sueño - sumatoria"]<65){
            $r["Perturbaciones del sueño"] = 3;
        }else  if($r["Perturbaciones del sueño - sumatoria"]<=74){
            $r["Perturbaciones del sueño"] = 2;
        }else  if($r["Perturbaciones del sueño - sumatoria"]<=84){
            $r["Perturbaciones del sueño"] = 1;
        }else  if($r["Perturbaciones del sueño - sumatoria"]>84){
            $r["Perturbaciones del sueño"] = 0;
        }
        $r["_Pittsburgh_Componente_4_Item_1"] = $item1;
        $r["_Pittsburgh_Componente_4_Item_3"] = $item3;
        $r["_Pittsburgh_Componente_4_Item_4"] = $item4;
        $r["_Pittsburgh_Componente_4_Horas_Cama"] = $hBed;
        $r["_Pittsburgh_Componente_4"] = $r["Perturbaciones del sueño"];


        
        if($r["Calidad del sueño - sumatoria"]==0){
            $r["Calidad del sueño"] = 0;
        }else  if($r["Calidad del sueño - sumatoria"]<=9){
            $r["Calidad del sueño"] = 1;
        }else  if($r["Calidad del sueño - sumatoria"]<=18){
            $r["Calidad del sueño"] = 2;
        }else  if($r["Calidad del sueño - sumatoria"]<=27){
            $r["Calidad del sueño"] = 3;
        }
        $r["_Pittsburgh_Componente_5_Valor"] = $r["Calidad del sueño - sumatoria"];
        $r["_Pittsburgh_Componente_5"] = $r["Calidad del sueño"];

        $r["Uso de medicación para dormir"] = $r["take_pill_id_value"];
        $r["_Pittsburgh_Componente_6"] = $r["Uso de medicación para dormir"];
        
        if($r["Disfunción diurna del sueño - sumatoria"]==0){
            $r["Disfunción diurna del sueño"] = 0;
        }else if($r["Disfunción diurna del sueño - sumatoria"]<=2){
            $r["Disfunción diurna del sueño"] = 1;
        }else if($r["Disfunción diurna del sueño - sumatoria"]<=4){
            $r["Disfunción diurna del sueño"] = 2;
        }else if($r["Disfunción diurna del sueño - sumatoria"]<=6){
            $r["Disfunción diurna del sueño"] = 3;
        }
        $r["_Pittsburgh_Componente_7_Valor"] = $r["Disfunción diurna del sueño - sumatoria"];
        $r["_Pittsburgh_Componente_7"] = $r["Disfunción diurna del sueño"];

        //Calculamos el global
        $r["Pittsburgh puntuación global - sumatoria"] = (
            $r["Eficiencia habitual del sueño"]
            + $r["Duración total del sueño"]
            + $r["Latencia del sueño"]
            + $r["Perturbaciones del sueño"]
            + $r["Calidad del sueño"]
            + $r["Uso de medicación para dormir"]
            + $r["Disfunción diurna del sueño"]
        );
        
        if($r["Pittsburgh puntuación global - sumatoria"]<=4){
            $r["Pittsburgh puntuación global"] = "Buena calidad de sueño";
        }else if($r["Pittsburgh puntuación global - sumatoria"]<=10){
            $r["Pittsburgh puntuación global"] = "Mala Calidad de sueño ";
        }else if($r["Pittsburgh puntuación global - sumatoria"]>10){
            $r["Pittsburgh puntuación global"] = "Disturbios de sueño";
        }
        return $r;
    }

    public function unity($r){
        $r["_Unity_Estres - sumatoria"] = ( 
            $r['how_often_affected_unexpectedly_id_value']+
            $r['how_often_felt_unable_control_your_life_id_value']+
            $r['how_often_nervous_or_stressed_id_value']+
            $r['how_often_ability_handle_personal_problems_id_value']+
            $r['how_often_things_going_well_you_id_value']+
            $r['how_often_cope_all_things_id_value']+
            $r['how_often_control_difficulties_id_value']+
            $r['how_often_all_under_control_id_value']+
            $r['how_often_angry_out_control_id_value']+
            $r['how_often_difficulties_cannot_overcome_id_value']
        );

        if($r["_Unity_Estres - sumatoria"]<=20)
            $r["_Unity_Estres"] = "Estrés Bajo";
        else if($r["_Unity_Estres - sumatoria"]<=30)
            $r["_Unity_Estres"] = "Estrés Medio";
        else if($r["_Unity_Estres - sumatoria"]<=40)
            $r["_Unity_Estres"] = "Estrés Alto";


        $r["_Unity_Ansiedad - sumatoria"] = (
            $r['feel_nervous_anxious_id_value']
            +$r['feel_scares_no_reason_id_value']
            +$r['feel_angry_easily_or_panic_id_value']
            +$r['feel_falling_apart_id_value']
            +$r['feel_arms_legs_shake_id_value']
            +$r['feel_bothered_headaches_neck_pain_id_value']
            +$r['feel_week_easily_tired_id_value']
            +$r['feel_hear_beating_fast_id_value']
            +$r['feel_dizziness_bothers_id_value']
            +$r['feel_faint_fainting_spells_id_value']
            +$r['feel_numbness_tingling_fingers_toes_id_value']
            +$r['feel_bother_stomach_aches_id_value']
            +$r['feel_empty_bladder_id_value']
            +$r['feel_red_hot_face_id_value']
            +$r['feel_nightmares_id_value']
        );

        if($r["_Unity_Ansiedad - sumatoria"]<=30)
            $r["_Unity_Ansiedad"] = "Ansiedad Baja";
        else if($r["_Unity_Ansiedad - sumatoria"]<=45)
            $r["_Unity_Ansiedad"] = "Ansiedad Media";
        else if($r["_Unity_Ansiedad - sumatoria"]<=60)
            $r["_Unity_Ansiedad"] = "Ansiedad Alta";


        $r["_Unity_Depresion - sumatoria"] = (
            $r['stop_being_sad_id_value']
            +$r['felt_depressed_id_value']
            +$r['thought_my_life_has_been_failure_id_value']
            +$r['felt_nervous_id_value']
            +$r['was_happy_id_value']
            +$r['felt_alone_id_value']
            +$r['enjoyed_life_id_value']
            +$r['have_crying_crisis_id_value']
            +$r['felt_sad_id_value']
            +$r['felt_couldnt_go_on_id_value']
        );
        
        if($r["_Unity_Depresion - sumatoria"]<=20)
            $r["_Unity_Depresion"] = "Depresión Baja";
        else if($r["_Unity_Depresion - sumatoria"]<=30)
            $r["_Unity_Depresion"] = "Depresión Media";
        else if($r["_Unity_Depresion - sumatoria"]<=40)
            $r["_Unity_Depresion"] = "Depresión Alta";


        $r["_Unity_Suicida - sumatoria"] = (
            $r['have_thought_life_not_worth_living_id_value']
            +$r['have_wished_were_dead_id_value']
            +$r['have_thought_ending_your_life_id_value']
            +$r['have_tried_kill_yourself_id_value']
        );
        
        if($r["_Unity_Suicida - sumatoria"]<=8)
            $r["_Unity_Suicida"] = "Suicidalidad Baja";
        else if($r["_Unity_Suicida - sumatoria"]<=12)
            $r["_Unity_Suicida"] = "Suicidalidad Media";
        else if($r["_Unity_Suicida - sumatoria"]<=16)
            $r["_Unity_Suicida"] = "Suicidalidad Alta";

        $r["_Unity_Unidad - sumatoria"] = (
            +$r['do_you_have_someone_talk_id_value']
            +$r['do_you_have_friend_talk_id_value']
            +$r['do_you_have_someone_family_solve_poblems_id_value']
            +$r['have_friend_solve_personal_problem_id_value']
            +$r['your_parents_show_love_affection_id_value']
            +$r['do_you_have_friend_show_affection_id_value']
            +$r['do_you_trust_family_things_worry_id_value']
            +$r['do_you_trust_friend_things_worry_id_value']
            +$r['someone_family_support_problems_school_id_value']
            +$r['someone_friend_help_homework_work_id_value']
            +$r['someone_friend_support_problems_school_id_value']
            +$r['family_talk_problems_all_supports_id_value']
            +$r['satisfied_support_family_id_value']
            +$r['satisfied_support_friend_id_value']
        );
        
        if($r["_Unity_Unidad - sumatoria"]<=8)
            $r["_Unity_Unidad"] = "UFyA Baja";
        else if($r["_Unity_Unidad - sumatoria"]<=12)
            $r["_Unity_Unidad"] = "UFyA Media";
        else if($r["_Unity_Unidad - sumatoria"]<=56)
            $r["_Unity_Unidad"] = "UFyA Alta";
        return $r;
    }

    public function cicardian($r){
        $r["_Cicardian - sumatoria"] = (
            $r["awake_hour_id_value"]
        +$r["bed_down_hour_id_value"]
        +$r["warning_alarm_clock_id_value"]
        +$r["easy_awake_id_value"]
        +$r["awake_first_half_hour_id_value"]
        +$r["awake_appetite_first_half_hour_id_value"]
        +$r["awake_feeling_first_half_hour_id_value"]
        +$r["awake_not_commited_bed_down_id_value"]
        +$r["awake_exercise_internal_clock_id_value"]
        +$r["tired_bed_down_hour_id_value"]
        +$r["performance_plan_test_hour_id_value"]
        +$r["tired_sleep_id_value"]
        +$r["bed_down_later_habitual_awake_id_value"]
        +$r["stay_awake_guard_id_value"]
        +$r["heavy_labor_id_value"]
        +$r["heavy_exercise_id_value"]
        +$r["choose_schedule_id_value"]
        +$r["max_welfare_id_value"]
        +$r["morning_evening_id_value"]
        );
        
        if($r["_Cicardian - sumatoria"]>=16 && $r["_Cardian - sumatoria"]<=30)
            $r["_Cicardian_"] = "Vespertino extremo";
        else if($r["_Cicardian - sumatoria"]<=41)
            $r["_Cicardian_"] = "Vespertino moderado";
        else if($r["_Cicardian - sumatoria"]<=58)
            $r["_Cicardian_"] = "Intermedio";
        else if($r["_Cicardian - sumatoria"]<=69)
            $r["_Cicardian_"] = "Matutino Moderado";
        else if($r["_Cicardian - sumatoria"]<=86)
            $r["_Cicardian_"] = "Matutino Extremo";

        
        return $r;
    }

    public function affection($r){
        $r["_Affection_Positive_ - sumatoria"] = (
            // +$r["many_times_feel_nervous_id_value"]
            +$r["feel_confident_in_life_id_value"]
            +$r["im_brave_id_value"]
            // +$r["feel_tired_last_months_id_value"]
            // +$r["worried_last_times_id_value"]
            +$r["have_determination_want_it_id_value"]
            // +$r["feel_guilt_did_past_id_value"]
            +$r["appasionate_things_i_do_id_value"]
            +$r["many_situations_happiness_recent_times_id_value"]
            // +$r["angry_when_contradict_me_id_value"]
            // +$r["people_say_moody_id_value"]
            // +$r["lately_been_situations_angry_id_value"]
            +$r["general_feel_strong_id_value"]
            +$r["pleasure_experiences_new_things_id_value"]
            +$r["feel_satisfied_myself_id_value"]
            // +$r["irritated_easily_id_value"]
            +$r["im_brave_faced_challenge_id_value"]
            +$r["im_happy_person_id_value"]
            // +$r["recent_times_felt_humiliated_id_value"]
            // +$r["feeling_sad_lately_id_value"]
        );
        $r["_Affection_Negative_ - sumatoria"] = (
            +$r["many_times_feel_nervous_id_value"]
            // +$r["feel_confident_in_life_id_value"]
            // +$r["im_brave_id_value"]
            +$r["feel_tired_last_months_id_value"]
            +$r["worried_last_times_id_value"]
            // +$r["have_determination_want_it_id_value"]
            +$r["feel_guilt_did_past_id_value"]
            // +$r["appasionate_things_i_do_id_value"]
            // +$r["many_situations_happiness_recent_times_id_value"]
            +$r["angry_when_contradict_me_id_value"]
            +$r["people_say_moody_id_value"]
            +$r["lately_been_situations_angry_id_value"]
            // +$r["general_feel_strong_id_value"]
            // +$r["pleasure_experiences_new_things_id_value"]
            // +$r["feel_satisfied_myself_id_value"]
            +$r["irritated_easily_id_value"]
            // +$r["im_brave_faced_challenge_id_value"]
            // +$r["im_happy_person_id_value"]
            +$r["recent_times_felt_humiliated_id_value"]
            +$r["feeling_sad_lately_id_value"]
        );
        
        if($r["_Affection_Positive_ - sumatoria"]<=20)
            $r["_Affection_Positive_"] = "Bajo";
        else if($r["_Affection_Positive_ - sumatoria"]<=30)
            $r["_Affection_Positive_"] = "Medio";
        else if($r["_Affection_Positive_ - sumatoria"]<=50)
            $r["_Affection_Positive_"] = "Alto";
        
        if($r["_Affection_Negative_ - sumatoria"]<=20)
            $r["_Affection_Negative_"] = "Bajo";
        else if($r["_Affection_Negative_ - sumatoria"]<=30)
            $r["_Affection_Negative_"] = "Medio";
        else if($r["_Affection_Negative_ - sumatoria"]<=50)
            $r["_Affection_Negative_"] = "Alto";

        
        return $r;
    }

    public function violence($r){
        //VIOLENCE SUFFERED

        //--Psychological_Social
        $r["_Violence_Suffered_Psychological_Social_Frequency_ - sumatoria"] = (
            /*6*/+$r["frequency_my_partner_monitors_everything_id_value"]
            /*9*/+$r["frequency_my_partner_forbids_friends_id_value"]
            /*15*/+$r["frequency_my_partner_upset_successes_id_value"]
            /*17*/+$r["frequency_my_partner_forbids_work_studying_id_value"]
            /*18*/+$r["frequency_my_partner_verbally_assaults_id_value"]
            /*19*/+$r["frequency_my_partner_angry_children_should_id_value"]
            /*21*/+$r["frequency_my_partner_gets_upset_food_works_id_value"]
            /*22*/+$r["frequency_my_partner_gets_jealous_friends_id_value"]
        );
        $r["_Violence_Suffered_Psychological_Social_Damage_ - sumatoria"] = (
            /*6*/+$r["damage_my_partner_monitors_everything_id_value"]
            /*9*/+$r["damage_my_partner_forbids_friends_id_value"]
            /*15*/+$r["damage_my_partner_upset_successes_id_value"]
            /*17*/+$r["damage_my_partner_forbids_work_studying_id_value"]
            /*18*/+$r["damage_my_partner_verbally_assaults_id_value"]
            /*19*/+$r["damage_my_partner_angry_children_should_id_value"]
            /*21*/+$r["damage_my_partner_gets_upset_food_works_id_value"]
            /*22*/+$r["damage_my_partner_gets_jealous_friends_id_value"]
        );
        $r["_Violence_Suffered_Psychological_Social_Frequency_ - percentage"] = $r["_Violence_Suffered_Psychological_Social_Frequency_ - sumatoria"]/8;
        $r["_Violence_Suffered_Psychological_Social_Damage_ - percentage"] = $r["_Violence_Suffered_Psychological_Social_Damage_ - sumatoria"]/8;
        $r["_Violence_Suffered_Psychological_Social_Frequency_"] = $this->violence_interpretation($r["_Violence_Suffered_Psychological_Social_Frequency_ - percentage"]);
        $r["_Violence_Suffered_Psychological_Social_Damage_"] = $this->violence_interpretation($r["_Violence_Suffered_Psychological_Social_Damage_ - percentage"]);

        //--Physical_Intimidation_Assault
        $r["_Violence_Suffered_Physical_Intimidation_Assault_Frequency_ - sumatoria"] = (
            /*2*/+$r["frequency_my_partner_pushed_me_hard_id_value"]
            /*3*/+$r["frequency_my_partner_gets_angry_what_wants_id_value"]
            /*11*/+$r["frequency_my_partner_hit_something_scare_me_id_value"]
            /*12*/+$r["frequency_my_partner_threatened_leave_me_id_value"]
            /*13*/+$r["frequency_i_have_afraid_partner_id_value"]
            /*16*/+$r["frequency_my_partner_has_hit_me_id_value"]
            /*25*/+$r["frequency_my_partner_has_come_insult_me_id_value"]
        );
        $r["_Violence_Suffered_Physical_Intimidation_Assault_Damage_ - sumatoria"] = (
            /*2*/+$r["damage_my_partner_pushed_me_hard_id_value"]
            /*3*/+$r["damage_my_partner_gets_angry_what_wants_id_value"]
            /*11*/+$r["damage_my_partner_hit_something_scare_me_id_value"]
            /*12*/+$r["damage_my_partner_threatened_leave_me_id_value"]
            /*13*/+$r["damage_i_have_afraid_partner_id_value"]
            /*16*/+$r["damage_my_partner_has_hit_me_id_value"]
            /*25*/+$r["damage_my_partner_has_come_insult_me_id_value"]
        );
        $r["_Violence_Suffered_Physical_Intimidation_Assault_Frequency_ - percentage"] = $r["_Violence_Suffered_Physical_Intimidation_Assault_Frequency_ - sumatoria"]/7;
        $r["_Violence_Suffered_Physical_Intimidation_Assault_Damage_ - percentage"] = $r["_Violence_Suffered_Physical_Intimidation_Assault_Damage_ - sumatoria"]/7;
        $r["_Violence_Suffered_Physical_Intimidation_Assault_Frequency_"] = $this->violence_interpretation($r["_Violence_Suffered_Physical_Intimidation_Assault_Frequency_ - percentage"]);
        $r["_Violence_Suffered_Physical_Intimidation_Assault_Damage_"] = $this->violence_interpretation($r["_Violence_Suffered_Physical_Intimidation_Assault_Damage_ - percentage"]);

        //--Sexual
        $r["_Violence_Suffered_Sexual_Frequency_ - sumatoria"] = (
            /*1*/+$r["frequency_my_partner_told_me_grooming_id_value"]
            /*4*/+$r["frequency_my_partner_criticizes_me_lover_id_value"]
            /*5*/+$r["frequency_my_partner_rejects_have_sex_id_value"]
            /*7*/+$r["frequency_my_partner_said_ugly_unattractive_id_value"]
            /*8*/+$r["frequency_my_partner_take_account_sexual_id_value"]
            /*14*/+$r["frequency_my_partner_has_forced_have_sex_id_value"]
            /*27*/+$r["frequency_my_partner_made_fun_some_part_body_id_value"]
        );
        $r["_Violence_Suffered_Sexual_Damage_ - sumatoria"] = (
            /*1*/+$r["damage_my_partner_told_me_grooming_id_value"]
            /*4*/+$r["damage_my_partner_criticizes_me_lover_id_value"]
            /*5*/+$r["damage_my_partner_rejects_have_sex_id_value"]
            /*7*/+$r["damage_my_partner_said_ugly_unattractive_id_value"]
            /*8*/+$r["damage_my_partner_take_account_sexual_id_value"]
            /*14*/+$r["damage_my_partner_has_forced_have_sex_id_value"]
            /*27*/+$r["damage_my_partner_made_fun_some_part_body_id_value"]
        );
        $r["_Violence_Suffered_Sexual_Frequency_ - percentage"] = $r["_Violence_Suffered_Sexual_Frequency_ - sumatoria"]/7;
        $r["_Violence_Suffered_Sexual_Damage_ - percentage"] = $r["_Violence_Suffered_Sexual_Damage_ - sumatoria"]/7;
        $r["_Violence_Suffered_Sexual_Frequency_"] = $this->violence_interpretation($r["_Violence_Suffered_Sexual_Frequency_ - percentage"]);
        $r["_Violence_Suffered_Sexual_Damage_"] = $this->violence_interpretation($r["_Violence_Suffered_Sexual_Damage_ - percentage"]);

        //--Economic
        $r["_Violence_Suffered_Economic_Frequency_ - sumatoria"] = (
            /*10*/+$r["frequency_my_partner_uses_money_control_me_id_value"]
            /*20*/+$r["frequency_my_partner_angry_tell_money_id_value"]
            /*23*/+$r["frequency_my_partner_manages_money_id_value"]
            /*24*/+$r["frequency_my_partner_blackmails_me_money_id_value"]
            /*26*/+$r["frequency_my_partner_financially_angry_id_value"]
        );
        $r["_Violence_Suffered_Economic_Damage_ - sumatoria"] = (
            /*10*/+$r["damage_my_partner_uses_money_control_me_id_value"]
            /*20*/+$r["damage_my_partner_angry_tell_money_id_value"]
            /*23*/+$r["damage_my_partner_manages_money_id_value"]
            /*24*/+$r["damage_my_partner_blackmails_me_money_id_value"]
            /*26*/+$r["damage_my_partner_financially_angry_id_value"]
        );
        $r["_Violence_Suffered_Economic_Frequency_ - percentage"] = $r["_Violence_Suffered_Economic_Frequency_ - sumatoria"]/5;
        $r["_Violence_Suffered_Economic_Damage_ - percentage"] = $r["_Violence_Suffered_Economic_Damage_ - sumatoria"]/5;
        $r["_Violence_Suffered_Economic_Frequency_"] = $this->violence_interpretation($r["_Violence_Suffered_Economic_Frequency_ - percentage"]);
        $r["_Violence_Suffered_Economic_Damage_"] = $this->violence_interpretation($r["_Violence_Suffered_Economic_Damage_ - percentage"]);

        //VIOLENCE EXERTED

        //--Psychological
        $r["_Violence_Exerted_Psychological_Frequency_ - sumatoria"] = (
            /*28*/+$r["frequency_ive_told_hes_blame_our_problems_id_value"]
            /*29*/+$r["frequency_i_have_come_yell_partner_id_value"]
            /*30*/+$r["frequency_i_have_angry_contradicts_disagrees_id_value"]
            /*31*/+$r["frequency_i_have_come_insult_my_partner_id_value"]
            /*32*/+$r["frequency_i_have_threatened_partner_leave_id_value"]
        );
        $r["_Violence_Exerted_Psychological_Damage_ - sumatoria"] = (
            /*28*/+$r["damage_ive_told_hes_blame_our_problems_id_value"]
            /*29*/+$r["damage_i_have_come_yell_partner_id_value"]
            /*30*/+$r["damage_i_have_angry_contradicts_disagrees_id_value"]
            /*31*/+$r["damage_i_have_come_insult_my_partner_id_value"]
            /*32*/+$r["damage_i_have_threatened_partner_leave_id_value"]
        );
        $r["_Violence_Exerted_Psychological_Frequency_ - percentage"] = $r["_Violence_Exerted_Psychological_Frequency_ - sumatoria"]/5;
        $r["_Violence_Exerted_Psychological_Damage_ - percentage"] = $r["_Violence_Exerted_Psychological_Damage_ - sumatoria"]/5;
        $r["_Violence_Exerted_Psychological_Frequency_"] = $this->violence_interpretation($r["_Violence_Exerted_Psychological_Frequency_ - percentage"]);
        $r["_Violence_Exerted_Psychological_Damage_"] = $this->violence_interpretation($r["_Violence_Exerted_Psychological_Damage_ - percentage"]);

        //--Another
        $r["_Violence_Exerted_Another_Frequency_ - sumatoria"] = (
            /*33*/+$r["frequency_when_he_verbally_attack_my_partner_id_value"]
            /*34*/+$r["frequency_i_take_sexual_needs_partner_id_value"]
            /*35*/+$r["frequency_i_have_forbidden_partner_friends_id_value"]
            /*36*/+$r["frequency_i_have_physically_hurt_partner_id_value"]
            /*37*/+$r["frequency_it_bothers_my_partner_spends_money_id_value"]
            /*38*/+$r["frequency_i_have_required_my_partner_spends_id_value"]
            /*39*/+$r["frequency_i_have_told_my_partner_is_ugly_id_value"]
        );
        $r["_Violence_Exerted_Another_Damage_ - sumatoria"] = (
            /*33*/+$r["damage_when_he_verbally_attack_my_partner_id_value"]
            /*34*/+$r["damage_i_take_sexual_needs_partner_id_value"]
            /*35*/+$r["damage_i_have_forbidden_partner_friends_id_value"]
            /*36*/+$r["damage_i_have_physically_hurt_partner_id_value"]
            /*37*/+$r["damage_it_bothers_my_partner_spends_money_id_value"]
            /*38*/+$r["damage_i_have_required_my_partner_spends_id_value"]
            /*39*/+$r["damage_i_have_told_my_partner_is_ugly_id_value"]
        );
        $r["_Violence_Exerted_Another_Frequency_ - percentage"] = $r["_Violence_Exerted_Another_Frequency_ - sumatoria"]/7;
        $r["_Violence_Exerted_Another_Damage_ - percentage"] = $r["_Violence_Exerted_Another_Damage_ - sumatoria"]/7;
        $r["_Violence_Exerted_Another_Frequency_"] = $this->violence_interpretation($r["_Violence_Exerted_Another_Frequency_ - percentage"]);
        $r["_Violence_Exerted_Another_Damage_"] = $this->violence_interpretation($r["_Violence_Exerted_Another_Damage_ - percentage"]);
        
        //VIOLENCE SUFFERED GENERAL
        
        //-- Frequency
        $r["_Violence_Suffered_General_Frequency_ - sumatoria"] = (
            /*1*/$r['frequency_my_partner_told_me_grooming_id_value']
            /*2*/+$r['frequency_my_partner_pushed_me_hard_id_value']
            /*3*/+$r['frequency_my_partner_gets_angry_what_wants_id_value']
            /*4*/+$r['frequency_my_partner_criticizes_me_lover_id_value']
            /*5*/+$r['frequency_my_partner_rejects_have_sex_id_value']
            /*6*/+$r['frequency_my_partner_monitors_everything_id_value']
            /*7*/+$r['frequency_my_partner_said_ugly_unattractive_id_value']
            /*8*/+$r['frequency_my_partner_take_account_sexual_id_value']
            /*9*/+$r['frequency_my_partner_forbids_friends_id_value']
            /*10*/+$r['frequency_my_partner_uses_money_control_me_id_value']
            /*11*/+$r['frequency_my_partner_hit_something_scare_me_id_value']
            /*12*/+$r['frequency_my_partner_threatened_leave_me_id_value']
            /*13*/+$r['frequency_i_have_afraid_partner_id_value']
            /*14*/+$r['frequency_my_partner_has_forced_have_sex_id_value']
            /*15*/+$r['frequency_my_partner_upset_successes_id_value']
            /*16*/+$r['frequency_my_partner_has_hit_me_id_value']
            /*17*/+$r['frequency_my_partner_forbids_work_studying_id_value']
            /*18*/+$r['frequency_my_partner_verbally_assaults_id_value']
            /*19*/+$r['frequency_my_partner_angry_children_should_id_value']
            /*20*/+$r['frequency_my_partner_angry_tell_money_id_value']
            /*21*/+$r['frequency_my_partner_gets_upset_food_works_id_value']
            /*22*/+$r['frequency_my_partner_gets_jealous_friends_id_value']
            /*23*/+$r['frequency_my_partner_manages_money_id_value']
            /*24*/+$r['frequency_my_partner_blackmails_me_money_id_value']
            /*25*/+$r['frequency_my_partner_has_come_insult_me_id_value']
            /*26*/+$r['frequency_my_partner_financially_angry_id_value']
            /*27*/+$r['frequency_my_partner_made_fun_some_part_body_id_value']
        );
        
        //-- Damage
        $r["_Violence_Suffered_General_Damage_ - sumatoria"] = (
            /*1*/$r['damage_my_partner_told_me_grooming_id_value']
            /*2*/+$r['damage_my_partner_pushed_me_hard_id_value']
            /*3*/+$r['damage_my_partner_gets_angry_what_wants_id_value']
            /*4*/+$r['damage_my_partner_criticizes_me_lover_id_value']
            /*5*/+$r['damage_my_partner_rejects_have_sex_id_value']
            /*6*/+$r['damage_my_partner_monitors_everything_id_value']
            /*7*/+$r['damage_my_partner_said_ugly_unattractive_id_value']
            /*8*/+$r['damage_my_partner_take_account_sexual_id_value']
            /*9*/+$r['damage_my_partner_forbids_friends_id_value']
            /*10*/+$r['damage_my_partner_uses_money_control_me_id_value']
            /*11*/+$r['damage_my_partner_hit_something_scare_me_id_value']
            /*12*/+$r['damage_my_partner_threatened_leave_me_id_value']
            /*13*/+$r['damage_i_have_afraid_partner_id_value']
            /*14*/+$r['damage_my_partner_has_forced_have_sex_id_value']
            /*15*/+$r['damage_my_partner_upset_successes_id_value']
            /*16*/+$r['damage_my_partner_has_hit_me_id_value']
            /*17*/+$r['damage_my_partner_forbids_work_studying_id_value']
            /*18*/+$r['damage_my_partner_verbally_assaults_id_value']
            /*19*/+$r['damage_my_partner_angry_children_should_id_value']
            /*20*/+$r['damage_my_partner_angry_tell_money_id_value']
            /*21*/+$r['damage_my_partner_gets_upset_food_works_id_value']
            /*22*/+$r['damage_my_partner_gets_jealous_friends_id_value']
            /*23*/+$r['damage_my_partner_manages_money_id_value']
            /*24*/+$r['damage_my_partner_blackmails_me_money_id_value']
            /*25*/+$r['damage_my_partner_has_come_insult_me_id_value']
            /*26*/+$r['damage_my_partner_financially_angry_id_value']
            /*27*/+$r['damage_my_partner_made_fun_some_part_body_id_value']
        );
        $r["_Violence_Suffered_General_Frequency_ - percentage"] = $r["_Violence_Suffered_General_Frequency_ - sumatoria"]/27;
        $r["_Violence_Suffered_General_Damage_ - percentage"] = $r["_Violence_Suffered_General_Damage_ - sumatoria"]/27;
        $r["_Violence_Suffered_General_ - sumatoria"] = $r["_Violence_Suffered_General_Frequency_ - percentage"] + $r["_Violence_Suffered_General_Damage_ - percentage"];
        $r["_Violence_Suffered_General_ - percentage"] = $r["_Violence_Suffered_General_ - sumatoria"]/2;
        $r["_Violence_Suffered_General_ - percentage result"] = $r["_Violence_Suffered_General_ - percentage"]*100;
        $r["_Violence_Suffered_General_"] = $this->violence_interpretation($r["_Violence_Suffered_General_ - percentage"]);
        
        //VIOLENCE EXERTED GENERAL
        
        //-- Frequency
        $r["_Violence_Exerted_General_Frequency_ - sumatoria"] = (
            /*28*/$r['frequency_ive_told_hes_blame_our_problems_id_value']
            /*29*/+$r['frequency_i_have_come_yell_partner_id_value']
            /*30*/+$r['frequency_i_have_angry_contradicts_disagrees_id_value']
            /*31*/+$r['frequency_i_have_come_insult_my_partner_id_value']
            /*32*/+$r['frequency_i_have_threatened_partner_leave_id_value']
            /*33*/+$r['frequency_when_he_verbally_attack_my_partner_id_value']
            /*34*/+$r['frequency_i_take_sexual_needs_partner_id_value']
            /*35*/+$r['frequency_i_have_forbidden_partner_friends_id_value']
            /*36*/+$r['frequency_i_have_physically_hurt_partner_id_value']
            /*37*/+$r['frequency_it_bothers_my_partner_spends_money_id_value']
            /*38*/+$r['frequency_i_have_required_my_partner_spends_id_value']
            /*39*/+$r['frequency_i_have_told_my_partner_is_ugly_id_value']
        );
        
        //-- Damage
        $r["_Violence_Exerted_General_Damage_ - sumatoria"] = (
            /*28*/$r['damage_ive_told_hes_blame_our_problems_id_value']
            /*29*/+$r['damage_i_have_come_yell_partner_id_value']
            /*30*/+$r['damage_i_have_angry_contradicts_disagrees_id_value']
            /*31*/+$r['damage_i_have_come_insult_my_partner_id_value']
            /*32*/+$r['damage_i_have_threatened_partner_leave_id_value']
            /*33*/+$r['damage_when_he_verbally_attack_my_partner_id_value']
            /*34*/+$r['damage_i_take_sexual_needs_partner_id_value']
            /*35*/+$r['damage_i_have_forbidden_partner_friends_id_value']
            /*36*/+$r['damage_i_have_physically_hurt_partner_id_value']
            /*37*/+$r['damage_it_bothers_my_partner_spends_money_id_value']
            /*38*/+$r['damage_i_have_required_my_partner_spends_id_value']
            /*39*/+$r['damage_i_have_told_my_partner_is_ugly_id_value']
        );
        $r["_Violence_Exerted_General_Frequency_ - percentage"] = $r["_Violence_Exerted_General_Frequency_ - sumatoria"]/12;
        $r["_Violence_Exerted_General_Damage_ - percentage"] = $r["_Violence_Exerted_General_Damage_ - sumatoria"]/12;
        $r["_Violence_Exerted_General_ - sumatoria"] = $r["_Violence_Exerted_General_Frequency_ - percentage"] + $r["_Violence_Exerted_General_Damage_ - percentage"];
        $r["_Violence_Exerted_General_ - percentage"] = $r["_Violence_Exerted_General_ - sumatoria"]/2;
        $r["_Violence_Exerted_General_ - percentage result"] = $r["_Violence_Exerted_General_ - percentage"]*100;
        $r["_Violence_Exerted_General_"] = $this->violence_interpretation($r["_Violence_Exerted_General_ - percentage"]);

        return $r;
    }


    public function violence_interpretation($value){
        $i = "";
        if($value<=1.8)
            $i = "No presenta";
        else if($value<=2.60)
            $i = "Poca violencia";
        else if($value<=3.40)
            $i = "Bastante  violencia";
        else if($value<=4.20)
            $i = "Mucha violencia";
        else if($value<=5)
            $i = "Violencia extrema";
        return $i;
    }
}