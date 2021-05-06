<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccCustomerInvoice;

class AccCustomerController extends Controller
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
            if ($header == '' || $header != $this->appkey){
                //return abort(404);
                $response = array("error" => true, "errmsg" => "you have no authorized", "code" => 400, "data" => null );
                return $response;
            }
            
            $data = AccCustomerInvoice::limit(100)->get();
            //return response()->json($data);
            $response = array("error" => false, "errmsg" => "", "code" => 200, "data" => $data );
            return $response;
        } catch(\Illuminate\Database\QueryException $ex){ 
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
