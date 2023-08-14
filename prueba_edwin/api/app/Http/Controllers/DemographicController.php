<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Demographic;
    use App\Family;
    use App\Role;
    use App\User;
    use Illuminate\Support\Facades\Auth;

class DemographicController extends Controller
{

    public function assignUser($loginUser,$document){
        $userAssigned = null;
        $userRole = Role::where("name","Usuario")->first();
        $isAdmin = $userRole->id!=$loginUser->role_id;
        //Si es admin
        if($isAdmin){
            $newUser = User::where('document',$document)->first();
            if(is_null($newUser)){
                $role = Role::where("name","Usuario")->first();
                $newUser = new User();
                $newUser->document = $document;
                $newUser->role_id = $role->id; //Rol de Usuario
                $newUser->enabled = Carbon::now('America/Bogota'); //Habilitado al tener la fecha desde que se registra
                $newUser->created_at = Carbon::now('America/Bogota');
                $newUser->save();
            }
            $userAssigned = $newUser;
        }else{
            $userAssigned = $loginUser;
        }
        return $userAssigned;
    }

    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $userAssigned = $this->assignUser($user,$request->document);
        $data = null;
        if(isset($request->id))
            $data = Demographic::find($request->id);
        else{
            $data = new Demographic();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        //Family selected
        $data->family_id = $request->family_id;

        $data->user_id = $userAssigned->id;
        $data->name = $request->name;
        $data->age = $request->age;
        $data->document_type_id = $request->document_type_id;
        $data->document = $request->document;
        $data->gender_id = $request->gender_id;
        $data->birthdate_place_id = $request->birthdate_place_id;
        $data->birthdate = $request->birthdate;
        $data->civil_status_id = $request->civil_status_id;
        $data->occupation = $request->occupation;
        $data->scholarship_id = $request->scholarship_id;
        // $data->city = $request->city;
        $data->city_id = $request->city_id;
        $data->email = $request->email;
        $data->socioeconomic = $request->socioeconomic;
        $data->pandemic_affectation_way_id = $request->pandemic_affectation_way_id;
        $data->sick_covid = $request->sick_covid;
        $data->vaccinate_covid = $request->vaccinate_covid;
        $data->relative_covid = $request->relative_covid;
        $data->applied_vaccine_id = $request->applied_vaccine_id;
        $data->full_dose = $request->full_dose;
        $data->reason_not_vaccinated_id = $request->reason_not_vaccinated_id;
        $data->disability = $request->disability;
        $data->disability_type_id = $request->disability_type_id;
        $data->psychoactive_substances_id = $request->psychoactive_substances_id;
        // $data->symptoms_last_week_id = $request->symptoms_last_week_id;
        $data->updated_at = Carbon::now('America/Bogota');
        $data->updated_user_at = $user->id;
        $data->save();
        $demographic_symptoms = (collect($request->demographic_symptoms)->pluck("symptoms_last_week_id"));
        $data = Demographic::where("id",$data->id)->with("demographic_symptoms")->first();
        $data->demographic_symptoms()->attach($demographic_symptoms,[
            "created_at"=>Carbon::now('America/Bogota'),
            "created_user_at"=>$user->id,
            "updated_at"=>Carbon::now('America/Bogota'),
            "updated_user_at"=>$user->id
        ]);

        $userDetail = User::find($userAssigned->id);
        $userDetail->last_form_code = "edwin";
        $userDetail->save();

        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

    public function detail($user_id) {
        $user = JWTAuth::parseToken()->authenticate();
        $userRole = Role::where("name","Usuario")->first();
        $isAdmin = $userRole->id!=$user->role_id;
        $data = null;
        $data = Demographic::where("user_id",($isAdmin?$user_id:$user->id))->with("location")->first();
        $families = Family::whereNull("deleted_at")->get();
        return response()->json([
            'success' => true, 'message'=>'Registro consulta con correctamente', "data"=>$data,"families"=>$families, "isAdmin"=>$isAdmin
        ]);
    }

}