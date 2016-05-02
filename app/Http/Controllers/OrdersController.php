<?php

namespace App\Http\Controllers;

use App\OrdersModel;
use Illuminate\Http\Request;

use App\Http\Requests;
Use Session;

class OrdersController extends Controller
{
    //
    public function index()
    {
        $orders = OrdersModel::getOrder();
        $ts = ['orders' => $orders];
        //print "<pre>";  print_r($orders); exit();
        return view('orders.index', $ts);
    }

    public function search(Request $data)
    {
        //if($data->filter_id != 0) {
            $orders = OrdersModel::getOrderByFilter($data);
            $ts = ['orders' => $orders];
            return view('orders.search', $ts);
        //}else {
        //    $error = "Silakan pilih filter dahulu";
        //    $orders = OrdersModel::getOrder();
        //    $ts = ['orders' => $orders, 'error' => $error];
        //    return view('orders.index', $ts);
        //}

    }

    public function show($id)
    {
        $trans_items  = '';
        $trans_panels = '';
        $trans_pakets = '';
        $panels = '';
        $pakets = '';
        $panels_paket = '';

        //$members = OrderModel::paginate(20);
        $order_code = $id; //'0051517';
        $pasien = OrdersModel::getPatientid($id);
        $order  = OrdersModel::getOrderDetailid($id);
        $total_harga  = OrdersModel::getOrderId($id);
        //$order  = OrdersModel::getOrderDetailid('0051517');
        //print "<pre>"; var_dump($pasien); exit();
        foreach($order as $item) {
            if(strpos($item->item_codepk, 'I')) { //ini ambil data trans item
                $trans_items[] = OrdersModel::getTransItems($item->item_codepk, $order_code);
                //print $item->item_codepk."<br>". $order_code."<br>";

            }elseif(strpos($item->item_codepk, 'PD')) { // ini ambil data trans ??
                $trans_panels = OrdersModel::getTransPanel($item->item_codepk, $order_code);
                $panels = OrdersModel::getPanelOrder($item->item_codepk, $order_code);
                //print $item->item_codepk."<br>". $order_code."<br>";

            }elseif(strpos($item->item_codepk, 'PC')) { // ini ambil data trans ??
                $trans_pakets = OrdersModel::getTransPaket($item->item_codepk, $order_code);
                $panels_paket = OrdersModel::getPanelPaketOrder($item->item_codepk, $order_code);
                $pakets = OrdersModel::getPaketOrder($item->item_codepk, $order_code);
                //print $item->item_codepk."<br>". $order_code."<br>";
            }
        } //print "<pre>";  print_r($total_harga); exit();

        //$ts = ['pasien' => $pasien, 'trans_item' =>  $trans_items, 'trans_panels' =>  $trans_panels, 'trans_pakets' =>  $trans_pakets, , 'panels' =>  $panels];

        $ts = ['pasien' => $pasien, 'trans_item' =>  $trans_items, 'trans_panels' =>  $trans_panels, 'panels' =>  $panels,
               'panels_paket' => $panels_paket ,'pakets' =>  $pakets, 'trans_pakets' => $trans_pakets, 'total_harga' => $total_harga];
        //return $ts;
        return view('orders.show', $ts);
    }

}
