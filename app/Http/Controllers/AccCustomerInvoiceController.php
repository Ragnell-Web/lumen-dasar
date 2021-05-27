<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccCustomerInvoice;
use App\Models\CustomerList;
use DB;

class AccCustomerInvoiceController extends Controller
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
                    //return abort(404);
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }
                
                // $data = AccCustomerInvoice::all();

                // $data = DB::table('customer')
                // ->join('acc_customer_invoice', 'customer.id', '=', 'acc_customer_invoice.id')
                // ->select(
                //     'customer.id',
                //     'acc_customer_invoice.invoice', 
                //     'acc_customer_invoice.inv_type', 
                //     'acc_customer_invoice.ref_no', 
                //     'acc_customer_invoice.period', 
                //     'acc_customer_invoicce.written',
                //     'customer.company',
                //     'customer.custcode',
                //     'customer.contact',
                //     'customer.do_addr1',
                //     'customer.do_addr2'
                // )
                // ->orderBy('invoice')
                // ->limit(100)
                // ->get();

                $data = DB::select("
                    SELECT customer.id, aci.invoice, customer.custcode, aci.inv_type, aci.ref_no, customer.company, customer.contact, customer.do_addr1, customer.do_addr2
                FROM customer
                INNER JOIN acc_customer_invoice AS aci
                ON customer.id = aci.id
                GROUP BY invoice");

                // $data = DB::table('customer')
                // ->join('acc_customer_invoice', 'customer.id', '=', 'acc_customer_invoice.id')
                // ->select(
                //     'customer.id',
                //     'acc_customer_invoice.invoice', 
                //     'acc_customer_invoice.inv_type', 
                //     'acc_customer_invoice.ref_no', 
                //     'acc_customer_invoice.period',  
                //     'customer.company',
                //     'customer.contact',
                //     'customer.do_addr1',
                //     'customer.do_addr2'
                // )
                // ->groupBy('acc_customer_invoice.id')
                // ->get();

                // $data = DB::table('customer')
                // ->join('acc_customer_invoice', 'acc_customer_invoice.id', '=', 'customer.id')
                // ->select('acc_customer_invoice.invoice')
                // ->groupBy('acc_customer_invoice.invoice')
                // ->get();

                //return response()->json($data);
                $response = array("error" => false, "errmsg" => "Data Ditampilkan", "code" => 200, "data" => $data );

                return $response;
        } catch(\Illuminate\Database\QueryException $ex) { 
            //dd($ex->getMessage()); 
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
            // Note any method of class PDOException can be called on $ex.
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                // $data = new AccCustomerInvoice;

                // $data->invoice = $request->input('invoice');
                // $data->inv_type = $request->input('inv_type');
                // $data->ref_no = $request->input('ref_no');
                // $data->pref_tax = $request->input('pref_tax');
                // $data->tax_no = $request->input('tax_no');
                // $data->period = $request->input('period');
                // $data->vperiod = $request->input('vperiod');
                // $data->written = $request->input('written');
                // $data->due = $request->input('due');
                // $data->printed = $request->input('printed');
                // $data->voided = $request->input('voided');
                // $data->posted = $request->input('posted');
                // $data->source = $request->input('source');
                // $data->pic = $request->input('pic');
                // $data->custcode = $request->input('custcode');
                // $data->combine_id = $request->input('combine_id');
                // $data->cus_type = $request->input('cus_type');
                // $data->do_addr = $request->input('do_addr');
                // $data->company = $request->input('company');
                // $data->contact = $request->input('contact');
                // $data->address1 = $request->input('address1');
                // $data->address2 = $request->input('address2');
                // $data->address3 = $request->input('address3');
                // $data->address4 = $request->input('address4');
                // $data->area = $request->input('area');
                // $data->valas = $request->input('valas');
                // $data->rate = $request->input('rate');
                // $data->amount_sub = $request->input('amount_sub');
                // $data->amount_dis = $request->input('amount_dis');
                // $data->amount_tax = $request->input('amount_tax');
                // $data->amount_cn = $request->input('amount_cn');
                // $data->amount_dn = $request->input('amount_dn');
                // $data->amount_pay = $request->input('amount_pay');
                // $data->amount_tot = $request->input('amount_tot');
                // $data->amount_bal = $request->input('amount_bal');
                // $data->amount_exp = $request->input('amount_exp');
                // $data->amount_cos = $request->input('amount_cos');
                // $data->commission = $request->input('commission');
                // $data->taxrate = $request->input('taxrate');
                // $data->xprinted = $request->input('xprinted');
                // $data->termofpay = $request->input('termofpay');
                // $data->totline = $request->input('totline');
                // $data->glar = $request->input('glar');
                // $data->no_pol = $request->input('no_pol');
                // $data->remark = $request->input('remark');
                // $data->lcurrent = $request->input('lcurrent');
                // $data->branch = $request->input('branch');
                // $data->warehouse = $request->input('warehouse');
                // $data->operator = $request->input('operator');
                // $data->mm_po_no = $request->input('mm_po_no');
                // $data->mm_do_no = $request->input('mm_do_no');
                // $data->je_no = $request->input('je_no');
                // $data->save();

                $data =  AccCustomerInvoice::insert($request->all());

                $response = array("error" => false, "errmsg" => "Data Berhasil Didaftarkan", "code" => 200, "data" => $data );

                return $response;
        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                $data = AccCustomerInvoice::find($request->input('id'));

                $response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $data );

                return $response;
        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                $data = AccCustomerInvoice::find($request->input('id'));

                $data->invoice = $request->input('invoice');
                $data->inv_type = $request->input('inv_type');
                $data->ref_no = $request->input('ref_no');
                $data->pref_tax = $request->input('pref_tax');
                $data->tax_no = $request->input('tax_no');
                $data->period = $request->input('period');
                $data->vperiod = $request->input('vperiod');
                $data->written = $request->input('written');
                $data->due = $request->input('due');
                $data->printed = $request->input('printed');
                $data->voided = $request->input('voided');
                $data->posted = $request->input('posted');
                $data->source = $request->input('source');
                $data->pic = $request->input('pic');
                $data->custcode = $request->input('custcode');
                $data->combine_id = $request->input('combine_id');
                $data->cus_type = $request->input('cus_type');
                $data->do_addr = $request->input('do_addr');
                $data->company = $request->input('company');
                $data->contact = $request->input('contact');
                $data->address1 = $request->input('address1');
                $data->address2 = $request->input('address2');
                $data->address3 = $request->input('address3');
                $data->address4 = $request->input('address4');
                $data->area = $request->input('area');
                $data->valas = $request->input('valas');
                $data->rate = $request->input('rate');
                $data->amount_sub = $request->input('amount_sub');
                $data->amount_dis = $request->input('amount_dis');
                $data->amount_tax = $request->input('amount_tax');
                $data->amount_cn = $request->input('amount_cn');
                $data->amount_dn = $request->input('amount_dn');
                $data->amount_pay = $request->input('amount_pay');
                $data->amount_tot = $request->input('amount_tot');
                $data->amount_bal = $request->input('amount_bal');
                $data->amount_exp = $request->input('amount_exp');
                $data->amount_cos = $request->input('amount_cos');
                $data->commission = $request->input('commission');
                $data->taxrate = $request->input('taxrate');
                $data->xprinted = $request->input('xprinted');
                $data->termofpay = $request->input('termofpay');
                $data->totline = $request->input('totline');
                $data->glar = $request->input('glar');
                $data->no_pol = $request->input('no_pol');
                $data->remark = $request->input('remark');
                $data->lcurrent = $request->input('lcurrent');
                $data->branch = $request->input('branch');
                $data->warehouse = $request->input('warehouse');
                $data->operator = $request->input('operator');
                $data->mm_po_no = $request->input('mm_po_no');
                $data->mm_do_no = $request->input('mm_do_no');
                $data->je_no = $request->input('je_no');
                $data->save();

                $response = array("error" => false, "errmsg" => "Data Berhasil Diperbaharui", "code" => 200, "data" => $data );

                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                $hapus = AccCustomerInvoice::find($request->input('id'));

                if ($hapus != null)
                    $hapus->delete();

                $response = array("error" => false, "errmsg" => "Data Berhasil Dihapus", "code" => 200, "data" => $hapus );

                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }  
    }

}
