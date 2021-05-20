<?php

namespace App\Http\Controllers;

use App\Models\AccCustomerInvoice;
use Illuminate\Http\Request;
use App\Models\DetailCustomer;
use Illuminate\Support\Facades\DB;

class UpdateInvoiceController extends Controller
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


    public function updateTabelInvoice(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                $custcode = $request->input('custcode');

                 $data = AccCustomerInvoice::where('custcode',"=",$custcode)->first();

                $data->period = $request->input('period');
                $data->written = $request->input('written');
                // $data->custcode = $request->input('custcode');
                $data->ref_no = $request->input('ref_no');
                $data->address1 = $request->input('address1');
                $data->address3 = $request->input('address3');
                $data->valas = $request->input('valas');
                $data->rate = $request->input('rate');
                $data->due = $request->input('due');
                $data->glar = $request->input('glar');
                $data->save();

                $response = array("error" => false, "errmsg" => "Data Berhasil Diperbaharui", "code" => 200, "data" => $data );
                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }
    
}
