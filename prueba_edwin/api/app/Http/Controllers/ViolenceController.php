<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Violence;
    use App\User;
    use Illuminate\Support\Facades\Auth;

class ViolenceController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $userIdAssigned = isset($request->user_id)?$request->user_id:$user->id;
        if(isset($request->id))
            $data = Violence::find($request->id);
        else{
            $data = new Violence();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        $data->user_id = $userIdAssigned;
        
        $data->frequency_my_partner_told_me_grooming_id = $request->frequency_my_partner_told_me_grooming_id;
        $data->frequency_my_partner_pushed_me_hard_id = $request->frequency_my_partner_pushed_me_hard_id;
        $data->frequency_my_partner_gets_angry_what_wants_id = $request->frequency_my_partner_gets_angry_what_wants_id;
        $data->frequency_my_partner_criticizes_me_lover_id = $request->frequency_my_partner_criticizes_me_lover_id;
        $data->frequency_my_partner_rejects_have_sex_id = $request->frequency_my_partner_rejects_have_sex_id;
        $data->frequency_my_partner_monitors_everything_id = $request->frequency_my_partner_monitors_everything_id;
        $data->frequency_my_partner_said_ugly_unattractive_id = $request->frequency_my_partner_said_ugly_unattractive_id;
        $data->frequency_my_partner_take_account_sexual_id = $request->frequency_my_partner_take_account_sexual_id;
        $data->frequency_my_partner_forbids_friends_id = $request->frequency_my_partner_forbids_friends_id;
        $data->frequency_my_partner_uses_money_control_me_id = $request->frequency_my_partner_uses_money_control_me_id;
        $data->frequency_my_partner_hit_something_scare_me_id = $request->frequency_my_partner_hit_something_scare_me_id;
        $data->frequency_my_partner_threatened_leave_me_id = $request->frequency_my_partner_threatened_leave_me_id;
        $data->frequency_i_have_afraid_partner_id = $request->frequency_i_have_afraid_partner_id;
        $data->frequency_my_partner_has_forced_have_sex_id = $request->frequency_my_partner_has_forced_have_sex_id;
        $data->frequency_my_partner_upset_successes_id = $request->frequency_my_partner_upset_successes_id;
        $data->frequency_my_partner_has_hit_me_id = $request->frequency_my_partner_has_hit_me_id;
        $data->frequency_my_partner_forbids_work_studying_id = $request->frequency_my_partner_forbids_work_studying_id;
        $data->frequency_my_partner_verbally_assaults_id = $request->frequency_my_partner_verbally_assaults_id;
        $data->frequency_my_partner_angry_children_should_id = $request->frequency_my_partner_angry_children_should_id;
        $data->frequency_my_partner_angry_tell_money_id = $request->frequency_my_partner_angry_tell_money_id;
        $data->frequency_my_partner_gets_upset_food_works_id = $request->frequency_my_partner_gets_upset_food_works_id;
        $data->frequency_my_partner_gets_jealous_friends_id = $request->frequency_my_partner_gets_jealous_friends_id;
        $data->frequency_my_partner_manages_money_id = $request->frequency_my_partner_manages_money_id;
        $data->frequency_my_partner_blackmails_me_money_id = $request->frequency_my_partner_blackmails_me_money_id;
        $data->frequency_my_partner_has_come_insult_me_id = $request->frequency_my_partner_has_come_insult_me_id;
        $data->frequency_my_partner_financially_angry_id = $request->frequency_my_partner_financially_angry_id;
        $data->frequency_my_partner_made_fun_some_part_body_id = $request->frequency_my_partner_made_fun_some_part_body_id;
        $data->frequency_ive_told_hes_blame_our_problems_id = $request->frequency_ive_told_hes_blame_our_problems_id;
        $data->frequency_i_have_come_yell_partner_id = $request->frequency_i_have_come_yell_partner_id;
        $data->frequency_i_have_angry_contradicts_disagrees_id = $request->frequency_i_have_angry_contradicts_disagrees_id;
        $data->frequency_i_have_come_insult_my_partner_id = $request->frequency_i_have_come_insult_my_partner_id;
        $data->frequency_i_have_threatened_partner_leave_id = $request->frequency_i_have_threatened_partner_leave_id;
        $data->frequency_when_he_verbally_attack_my_partner_id = $request->frequency_when_he_verbally_attack_my_partner_id;
        $data->frequency_i_take_sexual_needs_partner_id = $request->frequency_i_take_sexual_needs_partner_id;
        $data->frequency_i_have_forbidden_partner_friends_id = $request->frequency_i_have_forbidden_partner_friends_id;
        $data->frequency_i_have_physically_hurt_partner_id = $request->frequency_i_have_physically_hurt_partner_id;
        $data->frequency_it_bothers_my_partner_spends_money_id = $request->frequency_it_bothers_my_partner_spends_money_id;
        $data->frequency_i_have_required_my_partner_spends_id = $request->frequency_i_have_required_my_partner_spends_id;
        $data->frequency_i_have_told_my_partner_is_ugly_id = $request->frequency_i_have_told_my_partner_is_ugly_id;
      
        $data->damage_my_partner_told_me_grooming_id = $request->damage_my_partner_told_me_grooming_id;
        $data->damage_my_partner_pushed_me_hard_id = $request->damage_my_partner_pushed_me_hard_id;
        $data->damage_my_partner_gets_angry_what_wants_id = $request->damage_my_partner_gets_angry_what_wants_id;
        $data->damage_my_partner_criticizes_me_lover_id = $request->damage_my_partner_criticizes_me_lover_id;
        $data->damage_my_partner_rejects_have_sex_id = $request->damage_my_partner_rejects_have_sex_id;
        $data->damage_my_partner_monitors_everything_id = $request->damage_my_partner_monitors_everything_id;
        $data->damage_my_partner_said_ugly_unattractive_id = $request->damage_my_partner_said_ugly_unattractive_id;
        $data->damage_my_partner_take_account_sexual_id = $request->damage_my_partner_take_account_sexual_id;
        $data->damage_my_partner_forbids_friends_id = $request->damage_my_partner_forbids_friends_id;
        $data->damage_my_partner_uses_money_control_me_id = $request->damage_my_partner_uses_money_control_me_id;
        $data->damage_my_partner_hit_something_scare_me_id = $request->damage_my_partner_hit_something_scare_me_id;
        $data->damage_my_partner_threatened_leave_me_id = $request->damage_my_partner_threatened_leave_me_id;
        $data->damage_i_have_afraid_partner_id = $request->damage_i_have_afraid_partner_id;
        $data->damage_my_partner_has_forced_have_sex_id = $request->damage_my_partner_has_forced_have_sex_id;
        $data->damage_my_partner_upset_successes_id = $request->damage_my_partner_upset_successes_id;
        $data->damage_my_partner_has_hit_me_id = $request->damage_my_partner_has_hit_me_id;
        $data->damage_my_partner_forbids_work_studying_id = $request->damage_my_partner_forbids_work_studying_id;
        $data->damage_my_partner_verbally_assaults_id = $request->damage_my_partner_verbally_assaults_id;
        $data->damage_my_partner_angry_children_should_id = $request->damage_my_partner_angry_children_should_id;
        $data->damage_my_partner_angry_tell_money_id = $request->damage_my_partner_angry_tell_money_id;
        $data->damage_my_partner_gets_upset_food_works_id = $request->damage_my_partner_gets_upset_food_works_id;
        $data->damage_my_partner_gets_jealous_friends_id = $request->damage_my_partner_gets_jealous_friends_id;
        $data->damage_my_partner_manages_money_id = $request->damage_my_partner_manages_money_id;
        $data->damage_my_partner_blackmails_me_money_id = $request->damage_my_partner_blackmails_me_money_id;
        $data->damage_my_partner_has_come_insult_me_id = $request->damage_my_partner_has_come_insult_me_id;
        $data->damage_my_partner_financially_angry_id = $request->damage_my_partner_financially_angry_id;
        $data->damage_my_partner_made_fun_some_part_body_id = $request->damage_my_partner_made_fun_some_part_body_id;
        $data->damage_ive_told_hes_blame_our_problems_id = $request->damage_ive_told_hes_blame_our_problems_id;
        $data->damage_i_have_come_yell_partner_id = $request->damage_i_have_come_yell_partner_id;
        $data->damage_i_have_angry_contradicts_disagrees_id = $request->damage_i_have_angry_contradicts_disagrees_id;
        $data->damage_i_have_come_insult_my_partner_id = $request->damage_i_have_come_insult_my_partner_id;
        $data->damage_i_have_threatened_partner_leave_id = $request->damage_i_have_threatened_partner_leave_id;
        $data->damage_when_he_verbally_attack_my_partner_id = $request->damage_when_he_verbally_attack_my_partner_id;
        $data->damage_i_take_sexual_needs_partner_id = $request->damage_i_take_sexual_needs_partner_id;
        $data->damage_i_have_forbidden_partner_friends_id = $request->damage_i_have_forbidden_partner_friends_id;
        $data->damage_i_have_physically_hurt_partner_id = $request->damage_i_have_physically_hurt_partner_id;
        $data->damage_it_bothers_my_partner_spends_money_id = $request->damage_it_bothers_my_partner_spends_money_id;
        $data->damage_i_have_required_my_partner_spends_id = $request->damage_i_have_required_my_partner_spends_id;
        $data->damage_i_have_told_my_partner_is_ugly_id = $request->damage_i_have_told_my_partner_is_ugly_id;
      

       
        $data->updated_at = Carbon::now('America/Bogota');
        $data->updated_user_at = $user->id;
        $data->save();

        $userDetail = User::find($userIdAssigned);
        $userDetail->last_form_code = "finish";
        $userDetail->save();
        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

    public function detail($user_id) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $data = Violence::where("user_id",$user_id)->first();
        return response()->json([
            'success' => true, 'message'=>'Registro consulta con correctamente', "data"=>$data
        ]);
    }

}