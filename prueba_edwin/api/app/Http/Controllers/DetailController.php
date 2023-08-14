<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Detail;
    use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function detail($code) {
        $user = JWTAuth::parseToken()->authenticate();
        $data = Detail::select("details.*","dt.name as detail_type_name")->join("detail_types as dt","details.detail_type_id","=","dt.id")->where("dt.code",$code)->get();
        return response()->json([
            'success' => true, 'message'=>'Registro confirmado', "data"=>$data
        ]);
    }

}