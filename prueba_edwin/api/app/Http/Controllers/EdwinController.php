<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Edwin;
    use App\User;
    use App\Role;
    use Illuminate\Support\Facades\Auth;

class EdwinController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        $userIdAssigned = isset($request->user_id)?$request->user_id:$user->id;
        if(isset($request->id))
            $data = Edwin::find($request->id);
        else{
            $data = new Edwin();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        $data->user_id = $userIdAssigned;

        $data->xxxx_id = $request->xxxx_id;
        $data->yyyy_id = $request->yyyy_id;
       
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
        $data = Edwin::where("user_id",$user_id)->first();
        return response()->json([
            'success' => true, 'message'=>'Registro consulta con correctamente', "data"=>$data
        ]);
    }

}