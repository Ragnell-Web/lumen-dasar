<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddDoDtl;
use DB;

class AddDoDtlController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $appkey;
    public function __construct()
    {
        $value = env('APP_KEY', true);
        $this->appkey = str_replace('base64:', '', $value);
    }

    public function index(Request $request)
    {
    	try {
    			$header = $request->header('Authorization');

    			if ($header == '' || $header != $this->appkey) {
    				$response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                	return $response;
    			}

    			$data = DB::table('do_dtl')
                ->select(
                	'do_dtl.do_no',
                	'do_dtl.sso_no',
                    'do_dtl.descript',
                    'do_dtl.unit',
                    'do_dtl.quantity',
                    'do_dtl.price',
                    'do_dtl.cost',
                    'do_dtl.itemcode',
                    'do_dtl.part_no'
                )
<<<<<<< Updated upstream
                ->where(function ( $query) use ($request)
                {
                    $query->where('do_dtl.do_no', $request->input('do_no'))
                            ->orWhere('do_dtl.do_no', $request->input('do_no2'))
                            ->orWhere('do_dtl.do_no', $request->input('do_no3'))
                            ->orWhere('do_dtl.do_no', $request->input('do_no4'))
                            ->orWhere('do_dtl.do_no', $request->input('do_no5'))
                            ;
                })
=======
                ->where('do_dtl.do_no', $request->input('do_no'))
                ->orWhere('part_no', '55107-BZ480')
>>>>>>> Stashed changes
                ->limit(106)
                ->get();

                $response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $data );
            	return $response;

    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }
}