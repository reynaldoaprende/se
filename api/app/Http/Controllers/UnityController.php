<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Unity;
    use App\User;
    use Illuminate\Support\Facades\Auth;
class UnityController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $userIdAssigned = isset($request->user_id)?$request->user_id:$user->id;
        if(isset($request->id))
            $data = Unity::find($request->id);
        else{
            $data = new Unity();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        $data->user_id = $userIdAssigned;
        
        $data->how_often_affected_unexpectedly_id = $request->how_often_affected_unexpectedly_id;
        $data->how_often_felt_unable_control_your_life_id = $request->how_often_felt_unable_control_your_life_id;
        $data->how_often_nervous_or_stressed_id = $request->how_often_nervous_or_stressed_id;
        $data->how_often_ability_handle_personal_problems_id = $request->how_often_ability_handle_personal_problems_id;
        $data->how_often_things_going_well_you_id = $request->how_often_things_going_well_you_id;
        $data->how_often_cope_all_things_id = $request->how_often_cope_all_things_id;
        $data->how_often_control_difficulties_id = $request->how_often_control_difficulties_id;
        $data->how_often_all_under_control_id = $request->how_often_all_under_control_id;
        $data->how_often_angry_out_control_id = $request->how_often_angry_out_control_id;
        $data->how_often_difficulties_cannot_overcome_id = $request->how_often_difficulties_cannot_overcome_id;
        
        $data->feel_nervous_anxious_id = $request->feel_nervous_anxious_id;
        $data->feel_scares_no_reason_id = $request->feel_scares_no_reason_id;
        $data->feel_angry_easily_or_panic_id = $request->feel_angry_easily_or_panic_id;
        $data->feel_falling_apart_id = $request->feel_falling_apart_id;
        $data->feel_arms_legs_shake_id = $request->feel_arms_legs_shake_id;
        $data->feel_bothered_headaches_neck_pain_id = $request->feel_bothered_headaches_neck_pain_id;
        $data->feel_week_easily_tired_id = $request->feel_week_easily_tired_id;
        $data->feel_hear_beating_fast_id = $request->feel_hear_beating_fast_id;
        $data->feel_dizziness_bothers_id = $request->feel_dizziness_bothers_id;
        $data->feel_faint_fainting_spells_id = $request->feel_faint_fainting_spells_id;
        $data->feel_numbness_tingling_fingers_toes_id = $request->feel_numbness_tingling_fingers_toes_id;
        $data->feel_bother_stomach_aches_id = $request->feel_bother_stomach_aches_id;
        $data->feel_empty_bladder_id = $request->feel_empty_bladder_id;
        $data->feel_red_hot_face_id = $request->feel_red_hot_face_id;
        $data->feel_nightmares_id = $request->feel_nightmares_id;

        $data->stop_being_sad_id = $request->stop_being_sad_id;
        $data->felt_depressed_id = $request->felt_depressed_id;
        $data->thought_my_life_has_been_failure_id = $request->thought_my_life_has_been_failure_id;
        $data->felt_nervous_id = $request->felt_nervous_id;
        $data->was_happy_id = $request->was_happy_id;
        $data->felt_alone_id = $request->felt_alone_id;
        $data->enjoyed_life_id = $request->enjoyed_life_id;
        $data->have_crying_crisis_id = $request->have_crying_crisis_id;
        $data->felt_sad_id = $request->felt_sad_id;
        $data->felt_couldnt_go_on_id = $request->felt_couldnt_go_on_id;

        
        $data->have_thought_life_not_worth_living_id = $request->have_thought_life_not_worth_living_id;
        $data->have_wished_were_dead_id = $request->have_wished_were_dead_id;
        $data->have_thought_ending_your_life_id = $request->have_thought_ending_your_life_id;
        $data->have_tried_kill_yourself_id = $request->have_tried_kill_yourself_id;

        $data->do_you_have_someone_talk_id = $request->do_you_have_someone_talk_id;
        $data->do_you_have_friend_talk_id = $request->do_you_have_friend_talk_id;
        $data->do_you_have_someone_family_solve_poblems_id = $request->do_you_have_someone_family_solve_poblems_id;
        $data->have_friend_solve_personal_problem_id = $request->have_friend_solve_personal_problem_id;
        $data->your_parents_show_love_affection_id = $request->your_parents_show_love_affection_id;
        $data->do_you_have_friend_show_affection_id = $request->do_you_have_friend_show_affection_id;
        $data->do_you_trust_family_things_worry_id = $request->do_you_trust_family_things_worry_id;
        $data->do_you_trust_friend_things_worry_id = $request->do_you_trust_friend_things_worry_id;
        $data->someone_family_support_problems_school_id = $request->someone_family_support_problems_school_id;
        $data->someone_friend_help_homework_work_id = $request->someone_friend_help_homework_work_id;
        $data->someone_friend_support_problems_school_id = $request->someone_friend_support_problems_school_id;
        $data->family_talk_problems_all_supports_id = $request->family_talk_problems_all_supports_id;
        $data->satisfied_support_family_id = $request->satisfied_support_family_id;
        $data->satisfied_support_friend_id = $request->satisfied_support_friend_id;

       
        $data->updated_at = Carbon::now('America/Bogota');
        $data->updated_user_at = $user->id;
        $data->save();

        $userDetail = User::find($userIdAssigned);
        $userDetail->last_form_code = "pittsburgh";
        $userDetail->save();
        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

    public function detail($user_id) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $data = Unity::where("user_id",$user_id)->first();
        return response()->json([
            'success' => true, 'message'=>'Registro consulta con correctamente', "data"=>$data
        ]);
    }

}