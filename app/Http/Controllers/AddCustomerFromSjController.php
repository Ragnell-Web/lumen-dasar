<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddCustomerFromSj;
use DB;

class AddCustomerFromSjController extends Controller
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

    	// 		$data = DB::select("
    	// 			SELECT 
					// 	entry_do_tbl.cust_id,
					// 	entry_do_tbl.do_no,
					// 	entry_do_tbl.dn_no,
					// 	entry_do_tbl.po_no,
					// 	entry_do_tbl.ref_no,
					// 	entry_do_tbl.sso_no,
					// 	entry_do_tbl.delivery_date,
					// 	entry_so_tbl.total_amount
					// FROM entry_do_tbl
					// INNER JOIN entry_so_tbl
					// ON entry_do_tbl.cust_id = entry_so_tbl.cust_id
    	// 			");

                $data = DB::table('entry_do_tbl')
                ->join('entry_so_tbl', 'entry_do_tbl.cust_id', '=', 'entry_so_tbl.cust_id')
                ->select(
                    'entry_do_tbl.cust_id',
                    'entry_do_tbl.do_no', 
                    'entry_do_tbl.dn_no', 
                    'entry_do_tbl.po_no', 
                    'entry_do_tbl.ref_no', 
                    'entry_do_tbl.sso_no',
                    'entry_do_tbl.delivery_date',
                    'entry_so_tbl.total_amount'
                )
                ->where('entry_so_tbl.cust_id', $request->input('cust_id'))
                ->get();

    			$response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $data );
            	return $response;

    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }

}