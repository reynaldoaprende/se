<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Pittsburgh;
    use App\User;
    use Illuminate\Support\Facades\Auth;

class PittsburghController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $userIdAssigned = isset($request->user_id)?$request->user_id:$user->id;
        if(isset($request->id))
            $data = Pittsburgh::find($request->id);
        else{
            $data = new Pittsburgh();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        $data->user_id = $userIdAssigned;

        $data->time_sleep_night = Carbon::createFromFormat('H:i', $request->time_sleep_night);
        $data->last_month_time_asleep_id = $request->last_month_time_asleep_id;
        $data->last_month_awaing_habitually_morning =Carbon::createFromFormat('H:i', $request->last_month_awaing_habitually_morning);
        $data->last_month_hours_sleep_each_night = $request->last_month_hours_sleep_each_night;
        $data->cant_asleep_first_half_hour_id = $request->cant_asleep_first_half_hour_id;

        $data->awaking_half_night_id = $request->awaking_half_night_id;
        $data->awaking_go_to_bathroom_id = $request->awaking_go_to_bathroom_id;
        $data->cant_breathe_well_id = $request->cant_breathe_well_id;
        $data->cough_loudly_id = $request->cough_loudly_id;
        $data->cold_feel_id = $request->cold_feel_id;
        $data->heat_feel_id = $request->heat_feel_id;
        $data->have_nightmares_id = $request->have_nightmares_id;
        $data->have_smells_id = $request->have_smells_id;
        $data->other_reasons_id = $request->other_reasons_id;
        $data->take_pill_id = $request->take_pill_id;
        $data->last_month_problems_stay_awake_id = $request->last_month_problems_stay_awake_id;
        $data->last_month_enthusiasm_id = $request->last_month_enthusiasm_id;
        $data->last_month_sleep_quality_id = $request->last_month_sleep_quality_id;

       
        $data->updated_at = Carbon::now('America/Bogota');
        $data->updated_user_at = $user->id;
        $data->save();

        $userDetail = User::find($userIdAssigned);
        $userDetail->last_form_code = "cicardian";
        $userDetail->save();
        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

    public function detail($user_id) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $data = Pittsburgh::where("user_id",$user_id)->first();
        return response()->json([
            'success' => true, 'message'=>'Registro consulta con correctamente', "data"=>$data
        ]);
    }

}