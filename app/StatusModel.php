<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class StatusModel extends Model
{
    //

    public static function getOrder() {
        $lab_code = session::get('lab_code');
        $com_code = session::get('company_code'); //print $com_code;
        $data = '';
        if($lab_code == 0) {
            $data = DB::table('orders')
                ->join('lab', 'lab.lab_code','=','orders.company_code')
                ->where('lab.company_code' , $com_code)
                ->select('orders.*', 'lab.name as nama_lab')
                ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->paginate(10);

        }else {
            $data = DB::table('orders')
                ->join('lab', 'lab.lab_code','=','orders.company_code')
                ->where('orders.company_code' , $lab_code)
                ->select('orders.*', 'lab.name as nama_lab')
                ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->paginate(10);
        }

        return $data;
    }

    public static function getDataPasien($id) {
        $data = DB::table('orders')->where('orders_code', $id)->first();
        return $data;
    }

    public static function updateDataPasien($data) {
        $ss = DB::table('orders')
                ->where('orders_code', $data->orders_code)
                ->update(['status' => $data->status] );

        return $ss;
    }

}
