<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TtfArh;

class TtfArhController extends Controller
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

    public function create(Request $request)
    {
    	try {
    			$header = $request->header('Authorization');

    			if ($header == '' || $header != $this->appkey) {
    				$response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
    			}

    			$data = new TtfArh;
                $data->ttf_no = $request->input('ttf_no');
                $data->ref_no = $request->input('ref_no');
                $data->written = $request->input('written');
                $data->custcode = $request->input('custcode');
                $data->company = $request->input('company');
                $data->valas = $request->input('valas');
                $data->total_amt = $request->input('total_amt');
                $data->remark = $request->input('remark');
                $data->operator = $request->input('operator');
                $data->save();

                $response = array("error" => false, "errmsg" => "Data Berhasil Ditambah", "code" => 200, "data" => $data );
                return $response;

    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }
}