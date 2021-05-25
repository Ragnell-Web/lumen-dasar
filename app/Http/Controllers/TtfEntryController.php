<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TtfEntry;
use App\Models\DataTtfArl;
use App\Models\TtfArh;
use DB;

class TtfEntryController extends Controller
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
    			// $data = TtfEntry::all();

                $data = DB::select('
                        SELECT * FROM ttf_arh
                        ORDER BY ttf_arh.ttf_no
                        DESC LIMIT 1
                    '); 
                 
    			$response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $data );
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

                $data = new DataTtfArl;
                $data->ttf_no = $request->input('ttf_no');
                $data->received = $request->input('received');
                $data->valas = $request->input('valas');          
                $data->invoice = $request->input('invoice');
                $data->ref_no = $request->input('ref_no');
                $data->tax_no = $request->input('tax_no');
                $data->kw_no = $request->input('kw_no');
                $data->inv_date = $request->input('inv_date');
                $data->inv_due = $request->input('inv_due');
                $data->amount_tot = $request->input('amount_tot');
                $data->custcode = $request->input('custcode');
                $data->save();

                // $data = DB::table('ttf_arl')->insert([
                //             ['kw_no' => $request->input('kw_no'), 'invoice' => $request->input('invoice')],
                //             ['kw_no' => $request->input('kw_no2'), 'invoice' => $request->input('invoice2')]
                //         ]);

                $response = array("error" => false, "errmsg" => "Data Berhasil Ditambah", "code" => 200, "data" => $data );
                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

    public function updateTtfArh(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                // $data = TtfArh::Where('ttf_no', $request->input('ttf_no'))->first();
                $data =  TtfArh::where('ttf_no', $request->input('ttf_no'))->update($request->all());

                // $data->ref_no = $request->input('ref_no');
                // $data->written = $request->input('written');
                // $data->custcode = $request->input('custcode');
                // $data->valas = $request->input('valas');
                // $data->remark = $request->input('remark');
                // $data->total_amt = $request->input('total_amt');
                // $data->save();

                $response = array("error" => false, "errmsg" => "Data Berhasil Diperbaharui", "code" => 200, "data" => TtfArh::where('ttf_no', $request->input('ttf_no'))->first());

                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

    public function updateTtfArl(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                // $data = DataTtfArl::Where('ttf_no', $request->input('ttf_no'))->first();
                $data =  DataTtfArl::where('ttf_no', $request->input('ttf_no'))->update($request->all());


                // $data->ref_no = $request->input('ref_no');
                // $data->written = $request->input('written');
                // $data->custcode = $request->input('custcode');
                // $data->valas = $request->input('valas');
                // $data->remark = $request->input('remark');
                // $data->total_amt = $request->input('total_amt');
                // $data->save();

                $response = array("error" => false, "errmsg" => "Data Berhasil Diperbaharui", "code" => 200, "data" => DataTtfArl::where('ttf_no', $request->input('ttf_no'))->first() );

                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

}