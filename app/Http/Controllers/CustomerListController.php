<?php

namespace App\Http\Controllers;

use App\Models\CustomerList;
use Illuminate\Http\Request;
use DB;

class CustomerListController extends Controller 
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

    public function index(Request $request)
    {
    	try {
    			$header = $request->header('Authorization');

    			if ($header == '' || $header != $this->appkey) {
    				$response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
               		 return $response;
    			}

    			$data = CustomerList::limit(10)->get();

    			$response = array("error" => false, "errmsg" => "Data Ditampilkan", "code" => 200, "data" => $data );

            	return $response;
    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }

    public function create(Request $request)
    {
    	try {
    			$header = $request->header('Authorization');

    			if ($header == '' || $header != $this->appkey) {
    				$response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
    			}

    			$data = new CustomerList;

    			$data->custcode = $request->input('custcode');
    			$data->cus_level = $request->input('cus_level');

    			$data->save();

    			$response = array("error" => false, "errmsg" => "Data Berhasil Didaftarkan", "code" => 200, "data" => $data );

                return $response;
    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }

}