<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddCustomerFromSj;
use App\Models\DeleteDoHdr;
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
                // // ->groupBy('do_hdr.do_no')
                // ->limit(106)
                // ->get();
                // $data = DB::table('entry_do_tbl')
                //         ->leftJoin('cus_price','cus_price.itemcode','=','entry_do_tbl.item_code')
                //         ->where('cust_id',$request->input('cust_id'))
                //         ->groupBy('do_no')
                //         ->get();

                // $a = $data[0]->do_no;
                // $b = $dataInvoice[0]->invoice;
                // if ($a == $b) {
                //     $dataBaru = DB::table('entry_do_tbl')
                //         ->leftJoin('cus_price','cus_price.itemcode','=','entry_do_tbl.item_code')
                //         ->where('cust_id',$request->input('cust_id'))
                //         ->groupBy('do_no')
                //         ->get();
                // }

                // $data = DB::select("
                //     SELECT custcode, do_no, dn_no, po_no, ref_no, sso_no, written, tot_amt
                // FROM do_hdr
                // WHERE custcode = ''
                // GROUP BY do_no");

                $invoice = DB::select("SELECT invoice FROM acc_customer_invoice");

                $do_no = DB::select("SELECT do_no FROM entry_do_tbl");
                // $data = DB::select("
                //     SELECT *
                //     FROM entry_do_tbl 
                //     WHERE entry_do_tbl.do_no <= 21020004
                //     GROUP BY do_no
                // ");
                $cust_id = DB::select("SELECT cust_id FROM entry_do_tbl");

                $cek_msuk = DB::select("
                     SELECT *
                     FROM entry_do_tbl 
                     WHERE entry_do_tbl.do_no <= 21020004
                     GROUP BY do_no
                 ");

               // if( $invoice == $do_no ) {
               //      echo $cek_msuk;
               //  } else {
               //      $result = implode(",", $cek_msuk);
               //      echo ($cek_msuk);

               //  }

                $data = DB::table('entry_do_tbl')
                        ->leftJoin('cus_price','cus_price.itemcode','=','entry_do_tbl.item_code')
                        ->leftJoin('acc_customer_invoice','acc_customer_invoice.invoice','=','entry_do_tbl.do_no')
                        ->where('entry_do_tbl.do_no', '<=', 21020004)
                        ->where('cust_id',$request->input('cust_id'))
                        ->groupBy('do_no')
                        ->get();


    			$response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $cek_msuk );
            	return $response;

    	} catch(\Illuminate\Database\QueryException $ex) {
    		$response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
    	}
    }

    public function destroy(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

            $data_do_hdr = DB::table('do_hdr')
                ->select(
                    'do_hdr.id',
                    'do_hdr.custcode',
                    'do_hdr.do_no',
                    'do_hdr.dn_no',
                    'do_hdr.po_no',
                    'do_hdr.ref_no',
                    'do_hdr.sso_no',
                    'do_hdr.written',
                    'do_hdr.tot_amt'
                )
                ->where('do_hdr.custcode', $request->input('custcode'))
                // ->groupBy('do_hdr.do_no')
                ->limit(106)
                ->get();

            $data = DeleteDoHdr::Where('do_no', $request->input('do_no'))->delete();;


                $response = array("error" => false, "errmsg" => "Data Berhasil Dihapus", "code" => 200, "data" => $data_do_hdr );

                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

}