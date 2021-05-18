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

                // $data = DB::table('do_hdr')
                // ->select(
                //     'do_hdr.custcode',
                //     'do_hdr.do_no', 
                //     'do_hdr.dn_no', 
                //     'do_hdr.po_no', 
                //     'do_hdr.ref_no', 
                //     'do_hdr.sso_no',
                //     'do_hdr.written',
                //     'do_hdr.tot_amt'
                // )
                // ->where('do_hdr.custcode', $request->input('custcode'))
                // ->groupBy('do_hdr.do_no')
                // ->limit(106)
                // ->get();

                $data = DB::select("
                    SELECT custcode, do_no, dn_no, po_no, ref_no, sso_no, written, tot_amt
                FROM do_hdr
                GROUP BY do_no");


    			$response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $data );
            	return $response;

    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }

}