<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Session;

class OrdersModel extends Model
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

    public static function getOrderByFilter($data) {
        $result = '';
        $lab_code = session::get('lab_code');
        $com_code = session::get('company_code');
        if($lab_code == 0) {
            if($data->filter_id != 0) {
                if(!empty($data->filter_tgl)){
                    if ($data->filter_id == 1) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('lab.company_code', $com_code)
                            ->where('orders.other', 'like', "%$data->filter_name%")
                            ->where('orders.other', 'like', "%$data->filter_tgl%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 2) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('lab.company_code', $com_code)
                            ->where('orders.patient_code', "%$data->filter_name%")
                            ->where('orders.other', 'like', "%$data->filter_tgl%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 3) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('lab.company_code', $com_code)
                            ->where('orders.voucher_name', "%$data->filter_name%")
                            ->where('orders.other', 'like', "%$data->filter_tgl%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    }
                }else {
                    if ($data->filter_id == 1) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('lab.company_code', $com_code)
                            ->where('orders.other', 'like', "%$data->filter_name%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 2) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('lab.company_code', $com_code)
                            ->where('orders.patient_code', "%$data->filter_name%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 3) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('lab.company_code', $com_code)
                            ->where('orders.voucher_name', "%$data->filter_name%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    }
                }
            }else {
                if(!empty($data->filter_tgl)){
                    $result = DB::table('orders')
                        ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                        ->where('lab.company_code', $com_code)
                        ->where('orders.other', 'like', "%$data->filter_tgl%")
                        ->select('orders.*', 'lab.name as nama_lab')
                        ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                }
            }
        }else {
            if($data->filter_id != 0) {
                if(!empty($data->filter_tgl)){
                    if ($data->filter_id == 1) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('orders.company_code', $lab_code)
                            ->where('orders.other', 'like', "%$data->filter_name%")
                            ->where('orders.other', 'like', "%$data->filter_tgl%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 2) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('orders.company_code', $lab_code)
                            ->where('orders.patient_code', "%$data->filter_name%")
                            ->where('orders.other', 'like', "%$data->filter_tgl%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 3) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('orders.company_code', $lab_code)
                            ->where('orders.voucher_name', "%$data->filter_name%")
                            ->where('orders.other', 'like', "%$data->filter_tgl%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    }
                }else {
                    if ($data->filter_id == 1) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('orders.company_code', $lab_code)
                            ->where('orders.other', 'like', "%$data->filter_name%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 2) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('orders.company_code', $lab_code)
                            ->where('orders.patient_code', "%$data->filter_name%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    } elseif ($data->filter_id == 3) {
                        $result = DB::table('orders')
                            ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                            ->where('orders.company_code', $lab_code)
                            ->where('orders.voucher_name', "%$data->filter_name%")
                            ->select('orders.*', 'lab.name as nama_lab')
                            ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                    }
                }
            }else {
                if(!empty($data->filter_tgl)){
                    $result = DB::table('orders')
                        ->join('lab', 'lab.lab_code', '=', 'orders.company_code')
                        ->where('orders.company_code', $lab_code)
                        ->where('orders.other', 'like', "%$data->filter_tgl%")
                        ->select('orders.*', 'lab.name as nama_lab')
                        ->orderBy('orders.date', 'desc')->groupBy('orders.orders_code')->get();

                }
            }
        }

        return $result;
    }

    public static function getOrderId($id) {
        $data = DB::table('orders')
            ->join('lab', 'lab.lab_code','=','orders.company_code')
            ->join('company', 'lab.company_code','=','company.company_code')
            ->where('orders.orders_code' , $id)
            ->select('orders.*','lab.name as nama_lab','lab.address','company.img')
            ->first();
        return $data;
    }

    public static function getPatientid($id) {
        //$data = DB::table('orders')->where('orders_code' , $id)->groupby('orders_code')->get();

        $data = DB::table('orders')
            ->join('patient', 'patient.email', '=', 'orders.patient_code')
            ->select('orders.*', 'patient.*','orders.img as gambar')
            ->where('orders.orders_code' , $id)
            ->first();
        return $data;
    }

    public static function getOrderDetailid($order_code) {
        $data = DB::table('orders_detail')
            ->where('orders_detail.orders_code' , $order_code)
            ->select('orders_detail.*')
            ->get();
        return $data;
    }

    public static function getTransItemsxx($item_code, $order_code) {
        $data = DB::table('orders_detail')
            ->join('trans_item', 'trans_item.orders_code', '=', 'orders_detail.orders_code')
            ->where('orders_detail.orders_code', $order_code)
            ->where('orders_detail.item_codepk', $item_code)
            //->where('trans_item.orders_code', $order_code)
            ->where('trans_item.item_code', $item_code)
            ->select('orders_detail.*', 'trans_item.group_item', 'trans_item.company_code', 'trans_item.disc',
                'trans_item.item_code', 'trans_item.master_code', 'trans_item.name', 'trans_item.price', 'trans_item.price_disc')
            ->toSql();

        return $data;
        dd();


    }

    public static function getTransItems($item_code, $order_code) {
        //return $item_code;
        $data = DB::table('trans_item')
            ->select('trans_item.*')
            ->where('trans_item.orders_code', $order_code)
            ->where('trans_item.item_code', $item_code)
            //->where('trans_item.orders_code', $order_code)
            //->where('trans_item.item_code','orders_detail.item_codepk')
            ->get();

        return $data;

    }

    public static function getTransPanel($item_code, $order_code) {
        //return $data;
        $data = DB::table('trans_panel_detail')
                ->join('panel', 'panel.panel_code', '=', 'trans_panel_detail.panel_code')
                ->where('trans_panel_detail.orders_code' , $order_code)
                ->select('trans_panel_detail.*','panel.name as panel_name')
                ->get();

        return $data;
    }

    public static function getPanelOrder($item_code, $order_code) {
        //return $data;
        $data = DB::table('trans_panel_detail')
            ->join('panel', 'panel.panel_code', '=', 'trans_panel_detail.panel_code')
            ->where('trans_panel_detail.orders_code' , $order_code)
            ->select('trans_panel_detail.panel_code','panel.name as panel_name')
            ->groupBy('trans_panel_detail.panel_code')
            ->get();

        return $data;
    }

    public static function getTransPaket($item_code, $order_code) {
        $data = DB::table('trans_package_detail')
            ->join('panel', 'panel.panel_code', '=', 'trans_package_detail.panel_code')
            ->where('trans_package_detail.orders_code' , $order_code)
            ->select('trans_package_detail.*','panel.name as panel_name')
            ->orderBy('trans_package_detail.panel_code')
            ->get();

        return $data;
    }

    public static function getPaketOrder($item_code, $order_code) {
        $data = DB::table('trans_package_detail')
            ->join('package', 'trans_package_detail.package_code', '=', 'package.package_code')
            ->join('package_master', 'package.package_master_code', '=', 'package_master.package_master_code')
            ->where('trans_package_detail.orders_code' , $order_code)
            ->select('trans_package_detail.package_code', 'trans_package_detail.orders_code', 'package.package_master_code', 'package_master.name as nama_paket')
            ->groupBy('trans_package_detail.package_code')
            ->get();

        return $data;
    }

    public static function getPanelPaketOrder($item_code, $order_code) {
        $data = DB::table('trans_package_detail')
            ->join('package', 'trans_package_detail.package_code', '=', 'package.package_code')
            ->join('panel', 'panel.panel_code', '=', 'trans_package_detail.panel_code')
            ->where('trans_package_detail.orders_code' , $order_code)
            ->select('trans_package_detail.package_code', 'trans_package_detail.panel_code',
                'trans_package_detail.orders_code', 'panel.name as nama_panel')
            ->groupBy('trans_package_detail.panel_code')
            ->get();

        return $data;
    }

}
