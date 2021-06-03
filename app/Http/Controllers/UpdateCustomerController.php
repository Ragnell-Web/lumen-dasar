<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerList;
use Illuminate\Support\Facades\DB;

class UpdateCustomerController extends Controller
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


    public function updateTabelCustomer(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                // $data = TabelCustomer::Where('custcode', $request->input('custcode'))->put();
                $custcode = $request->input('custcode');

                 $data = CustomerList::where('custcode',"=",$custcode)->first();

                $data->contact = $request->input('contact');
                $data->source = $request->input('source');
                // $data->custcode = $request->input('custcode');
                $data->company = $request->input('company');
                $data->taxrate = $request->input('taxrate');
                $data->save();

                // $data = DB::table('customer')
                // ->join('acc_customer_invoice', 'customer.id', '=', 'acc_customer_invoice.id')
                // // ->find('customer.custcode')
                // ->where('customer.custcode', $request->input('custcode'))
                // ->limit(100)
                // ->update();

                // $custcode = $request->input('custcode');

                // $getairId = DB::table('customer')
                //       ->join('acc_customer_invoice','customer.id','=','acc_customer_invoice.id')
                //       ->select(
                //         'contact'=>$request->input('contact'),
                //         'source'=>$request->input('source'),
                //         'com'=>$request->input('com'),
                //         'contact'=>$request->input('contact'),
                //         'contact'=>$request->input('contact')
                //     )
                //       ->where('customer.custcode','=', $custcode)
                //       ->update(array("customer.custcode"=>$custcode));

                $response = array("error" => false, "errmsg" => "Data Berhasil Diperbaharui", "code" => 200, "data" => $data );
                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

}
