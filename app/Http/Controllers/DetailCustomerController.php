<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailCustomer;

class DetailCustomerController extends Controller
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

    public function show(Request $request)
    {
    	try {
    			$header = $request->header('Authorization');

    			if ($header == '' || $header != $this->appkey) {
    				$response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                	return $response;
    			}

    			// $data = DetailCustomer::find($request->input('id'));

    			$data = DetailCustomer::where('id', $request->input('id'))->get();

    			$response = array("error" => false, "errmsg" => "Data Ditampilkan", "code" => 200, "data" => $data );

            	return $response;

    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }
}