<?php   
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
use DB;
use JWTAuth;
use App\Family;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = null;
        if(isset($request->id))
            $data = Family::find($request->id);
        else{
            $data = new Family();
            $data->created_at = Carbon::now('America/Bogota');
            $data->created_user_at = $user->id;
        }
        $data->name = $request->name;
        $data->updated_at = Carbon::now('America/Bogota');
        $data->updated_user_at = $user->id;
        $data->save();
        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

    public function list() {
        $user = JWTAuth::parseToken()->authenticate();
        $roles = Role::get();
        $coordRole = Role::where("name","Coordinador")->first();
        $data = Family::whereNull("deleted_at");
        if($coordRole->id==$user->role_id){
            $data = $data->where("created_user_at",$user->id);
        }
        $data = $data->get();
        return response()->json([
            'success' => true, 'message'=>'Listado correctamente', "data"=>$data
        ]);
    }

    public function remove(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = Family::find($request->id);
        $data->deleted_at = Carbon::now('America/Bogota');
        $data->deleted_user_at = $user->id;
        $data->save();
        return response()->json([
            'success' => true, 'message'=>'Registrado correctamente', "data"=>$data
        ]);
    }

}