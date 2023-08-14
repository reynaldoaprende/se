<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Cicardian;
    use App\User;
    use App\Role;
    use Illuminate\Support\Facades\Auth;

class CicardianController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $userIdAssigned = isset($request->user_id)?$request->user_id:$user->id;
        if(isset($request->id))
            $data = Cicardian::find($request->id);
        else{
            $data = new Cicardian();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        $data->user_id = $userIdAssigned;

        $data->awake_hour_id = $request->awake_hour_id;
        $data->bed_down_hour_id = $request->bed_down_hour_id;
        $data->warning_alarm_clock_id = $request->warning_alarm_clock_id;
        $data->easy_awake_id = $request->easy_awake_id;
        $data->awake_first_half_hour_id = $request->awake_first_half_hour_id;
        $data->awake_appetite_first_half_hour_id = $request->awake_appetite_first_half_hour_id;
        $data->awake_feeling_first_half_hour_id = $request->awake_feeling_first_half_hour_id;
        $data->awake_not_commited_bed_down_id = $request->awake_not_commited_bed_down_id;
        $data->awake_exercise_internal_clock_id = $request->awake_exercise_internal_clock_id;
        $data->tired_bed_down_hour_id = $request->tired_bed_down_hour_id;
        $data->performance_plan_test_hour_id = $request->performance_plan_test_hour_id;
        $data->tired_sleep_id = $request->tired_sleep_id;
        $data->bed_down_later_habitual_awake_id = $request->bed_down_later_habitual_awake_id;
        $data->stay_awake_guard_id = $request->stay_awake_guard_id;
        $data->heavy_labor_id = $request->heavy_labor_id;
        $data->heavy_exercise_id = $request->heavy_exercise_id;
        $data->choose_schedule_id = $request->choose_schedule_id;
        $data->max_welfare_id = $request->max_welfare_id;
        $data->morning_evening_id = $request->morning_evening_id;

       
        $data->updated_at = Carbon::now('America/Bogota');
        $data->updated_user_at = $user->id;
        $data->save();

        $userDetail = User::find($userIdAssigned);
        $userDetail->last_form_code = "affectation";
        $userDetail->save();
        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

    public function detail($user_id) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $data = Cicardian::where("user_id",$user_id)->first();
        return response()->json([
            'success' => true, 'message'=>'Registro consulta con correctamente', "data"=>$data
        ]);
    }

}