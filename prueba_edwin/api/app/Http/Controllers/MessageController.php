<?php   
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Carbon\Carbon;
    use DB;
    use JWTAuth;
    use App\Message;
    use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function list() {
        $user = JWTAuth::parseToken()->authenticate();
        $data = Message::get();
        return response()->json([
            'success' => true, 'message'=>'Listado correctamente', "data"=>$data
        ]);
    }

}