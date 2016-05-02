<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class LoginModel extends Model
{
    //

    public static function simpan($data)
    {
        $data_insert = DB::table('member')
                ->insert(array(
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => hash::make($data->password),
                    'company_code' => $data->comapny_code,
                    'lab_code' => $data->lab_code,
                    'created_at' => DB::raw('NOW()'),
                    'updated_at' => DB::raw('NOW()')
                ));


        $ss = DB::table('admins')
            ->insert(array(
                'name' => $data->name,
                'email' => $data->email,
                'password' => hash::make($data->password),
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ));

        return $data->name;
    }

    public static function getLab()
    {
        $data = DB::table('lab')->select('lab_code','name')->where('status', 1)->orderBy('name','asc')->get();
        return $data;
    }

    public static function getlabbyid($id)
    {
        $data = DB::table('lab')->select('lab_code','name')->where('company_code', $id->id)->orderBy('lab_code')->get();
        return $data;
    }

    public static function getCompany()
    {
        $data = DB::table('company')->select('company_code','name')->where('status', 1)->orderBy('name','asc')->get();
        return $data;
    }

    public static function getmemberid($request)
    {
        $data = DB::table('member')->select('company_code','lab_code')->where('email', $request->email)->get();
        return $data;
    }

}
