<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Country;
use JWTAuth;
use DB;
use Carbon\Carbon;
class CountryController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * API List
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $data = Country::get();
        return response()->json(['success'=> true,'message'=> 'Lista de registros.','data'=> $data]);
    }
}
