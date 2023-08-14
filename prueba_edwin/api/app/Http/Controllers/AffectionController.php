<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Affection;
    use App\User;
    use Illuminate\Support\Facades\Auth;

class AffectionController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $userIdAssigned = isset($request->user_id)?$request->user_id:$user->id;
        if(isset($request->id))
            $data = Affection::find($request->id);
        else{
            $data = new Affection();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        $data->user_id = $userIdAssigned;

        $data->many_times_feel_nervous_id = $request->many_times_feel_nervous_id;
        $data->feel_confident_in_life_id = $request->feel_confident_in_life_id;
        $data->im_brave_id = $request->im_brave_id;
        $data->feel_tired_last_months_id = $request->feel_tired_last_months_id;
        $data->worried_last_times_id = $request->worried_last_times_id;
        $data->have_determination_want_it_id = $request->have_determination_want_it_id;
        $data->feel_guilt_did_past_id = $request->feel_guilt_did_past_id;
        $data->appasionate_things_i_do_id = $request->appasionate_things_i_do_id;
        $data->many_situations_happiness_recent_times_id = $request->many_situations_happiness_recent_times_id;
        $data->angry_when_contradict_me_id = $request->angry_when_contradict_me_id;
        $data->people_say_moody_id = $request->people_say_moody_id;
        $data->lately_been_situations_angry_id = $request->lately_been_situations_angry_id;
        $data->general_feel_strong_id = $request->general_feel_strong_id;
        $data->pleasure_experiences_new_things_id = $request->pleasure_experiences_new_things_id;
        $data->feel_satisfied_myself_id = $request->feel_satisfied_myself_id;
        $data->irritated_easily_id = $request->irritated_easily_id;
        $data->im_brave_faced_challenge_id = $request->im_brave_faced_challenge_id;
        $data->im_happy_person_id = $request->im_happy_person_id;
        $data->recent_times_felt_humiliated_id = $request->recent_times_felt_humiliated_id;
        $data->feeling_sad_lately_id = $request->feeling_sad_lately_id;

       
        $data->updated_at = Carbon::now('America/Bogota');
        $data->updated_user_at = $user->id;
        $data->save();

        $userDetail = User::find($userIdAssigned);
        $userDetail->last_form_code = "violence";
        $userDetail->save();
        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

    public function detail($user_id) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $data = Affection::where("user_id",$user_id)->first();
        return response()->json([
            'success' => true, 'message'=>'Registro consulta con correctamente', "data"=>$data
        ]);
    }

}