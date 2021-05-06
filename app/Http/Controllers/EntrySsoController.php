<?php

namespace App\Http\Controllers;

use App\Models\EntrySso;
use Illuminate\Http\Request;
use DB;

class EntrySsoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void_sso
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

                $data = DB::table('entry_sso_tbl')->get();

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

                $data = new EntrySso;
                $data->active_cls= $request->input('active_cls');
                $data->sso_period= $request->input('sso_period');
                $data->sso_ref_no= $request->input('sso_ref_no');
                $data->sso_header = $request->input('sso_header');
                $data->sso_detail = $request->input('sso_detail');
                $data->so_header = $request->input('so_header');
                $data->dn_no = $request->input('dn_no');
                $data->dn_term = $request->input('dn_term');
                $data->dn_date = $request->input('dn_date');
                $data->item_code = $request->input('item_code');
                $data->qty_sso = $request->input('qty_sso');
                $data->qty_sj = $request->input('qty_sj');
                $data->qty_billed = $request->input('qty_billed');
                $data->remark = $request->input('remark');
                $data->posted_by = $request->input('posted_by');
                $data->voided_by = $request->input('voided_by');
                $data->closed_by = $request->input('closed_by');
                $data->created_by = $request->input('created_by');
                $data->updated_by = $request->input('updated_by');
                $data->save();

                $response = array("error" => false, "errmsg" => "Data Berhasil Didaftarkan", "code" => 200, "data" => $data );

                return $response;
        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

    public function show(Request $request)
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                // $data = karyawan::find($request->input('id_sso'));

                $data = EntrySso::Where('id_sso', $request->input('id_sso'))->get();

                $response = array("error" => false, "errmsg" => "Data Ditampilkan", "code" => 200, "data" => $data );

                return $response;
        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

    public function update(Request $request) 
    {
        try {
                $header = $request->header('Authorization');

                if ($header == '' || $header != $this->appkey) {
                    $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                    return $response;
                }

                // kalau id_sso di ganti id bisa
                $data = EntrySso::find($request->input('id'));
                // $data = karyawan::Where('id_sso', $request->input('id_sso'))->put();

                $data->active_cls= $request->input('active_cls');
                $data->sso_period= $request->input('sso_period');
                $data->sso_ref_no= $request->input('sso_ref_no');
                $data->sso_header = $request->input('sso_header');
                $data->sso_detail = $request->input('sso_detail');
                $data->so_header = $request->input('so_header');
                $data->dn_no = $request->input('dn_no');
                $data->dn_term = $request->input('dn_term');
                $data->dn_date = $request->input('dn_date');
                $data->item_code = $request->input('item_code');
                $data->qty_sso = $request->input('qty_sso');
                $data->qty_sj = $request->input('qty_sj');
                $data->qty_billed = $request->input('qty_billed');
                $data->remark = $request->input('remark');
                $data->posted_by = $request->input('posted_by');
                $data->voided_by = $request->input('voided_by');
                $data->closed_by = $request->input('closed_by');
                $data->created_by = $request->input('created_by');
                $data->updated_by = $request->input('updated_by');
                $data->save();                

                $response = array("error" => false, "errmsg" => "Data Berhasil Diperbaharui", "code" => 200, "data" => $data );

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

                // $hapus = karyawan::find($request->input('id_sso'));
                $data = EntrySso::Where('id_sso', $request->input('id_sso'))->delete();
                // print_r($data);exit;


                $response = array("error" => false, "errmsg" => "Data Berhasil Dihapus", "code" => 200, "data" => $data );

                return $response;

        } catch(\Illuminate\Database\QueryException $ex) {
            $response = array("error" => true, "errmsg" => $ex->getMessage(), "code" => 412, "data" => null );
            return $response;
        }
    }

}