<?php

namespace App\Http\Controllers;

use App\OrdersModel;
use App\StatusModel;
use Illuminate\Http\Request;

use App\Http\Requests;
Use Session;

class StatusController extends Controller
{
    //
    public function index()
    {
        $orders = StatusModel::getOrder();
        $ts = ['orders' => $orders];
        return view('status.index', $ts);
    }

    public function edit($id) {
        $member = StatusModel::getDataPasien($id);
        return view('status.edit', ['member' => $member]);
    }

    public function update(Request $data) {
        $data = StatusModel::updateDataPasien($data);
        if($data) {
            return redirect('status');
        }else {
            return redirect('status/edit');
        }
    }

    public function search(Request $data)
    {
        $orders = OrdersModel::getOrderByFilter($data);
        $ts = ['orders' => $orders];
        return view('status.search', $ts);
    }

}
