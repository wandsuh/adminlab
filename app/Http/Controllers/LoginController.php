<?php

namespace App\Http\Controllers;

use App\LoginModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Hash;

use Session;

class LoginController extends Controller
{
    //

    public function login()
    {
        if(!empty(Auth::user()->name)) {
            return redirect('home');
        }else {
            return view('auth.login'); //"Ini halaman Login";
        }

    }

    public function dologin(Request $request)
    {
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $data = LoginModel::getmemberid($request);

            if(empty($data)) {
                print "data kosong";
            } else {
                session_start();
                foreach ($data as $val) {
                    //print 'lab code : '.$val->lab_code .' ,   company code : '. $val->company_code; exit();
                    session(['lab_code' => $val->lab_code, 'company_code' => $val->company_code]);
                }
            }

            return redirect('home');
        }else {
            return redirect('login');
        }
    }

    function logout() {
        Auth::guard('web')->logout();
        //session()->forget('company_code'); // ini digunakan hapus session perdata
        //session()->forget('lab_code');
        session::flush();

        return redirect('login');
    }

    public function register()
    {
        if(!empty(Auth::user()->name)) {
            return redirect('home');
        }else {
            $data = LoginModel::getCompany();
            $ts = ['data' => $data];
            return view('auth.register', $ts);
        }

    }

    public function doregister(Request $data)
    {
        $data = LoginModel::simpan($data);
        return redirect('login');
    }

    public function getlabbyid(Request $id)
    {
        $data = LoginModel::getlabbyid($id);
        return $data;
    }

}
