<?php

namespace App\Http\Controllers;

use App\Models\CustomerWhereId;
use Illuminate\Http\Request;
use DB;

class CustomerWhereIdController extends Controller 
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */

    private $appkey;
    public function __construct()
    {
    	$value = env('APP_KEY', true);
        $this->appkey = str_replace('base64:', '', $value);
    }

    public function show(Request $request)
    {
    	try {
    			$header = $request->header('Authorization');

    			if ($header == '' || $header != $this->appkey) {
    				$response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
               		 return $response;
    			}

    			$data = CustomerWhereId::Where('id', $request->input('id'))->get();

    			$response = array("error" => false, "errmsg" => "Data Ditampilkan", "code" => 200, "data" => $data );

            	return $response;
    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }

}