@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Data Pasien
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! URL::to('orders') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>Nama</b></td>
                <td>{!! $pasien->name !!}</td>
            </tr>

			
            <tr>
                <td><b>Email</b></td>
                <td>{!! $pasien->email !!}</td>
            </tr>			
            <tr>
                <td><b>Alamat</b></td>
                <td>{!! $pasien->address !!}</td>
            </tr>
            <tr>
                <td><b>Hp</b></td>
                <td>{!! $pasien->phone !!}</td>
            </tr>			
            <tr>
                <td><b>Gender</b></td>
                <td>{!! $pasien->gender !!}</td>
            </tr>
            <tr>
                <td><b>Tanggal Lahir</b></td>
                <td>{!! date('d F Y', strtotime($pasien->birth)) !!}</td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Data Medical
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>Nama</b></td>
                <td>{!! $pasien->name !!}</td>
            </tr>


            <tr>
                <td><b>Email</b></td>
                <td>{!! $pasien->email !!}</td>
            </tr>
            <tr>
                <td><b>Alamat</b></td>
                <td>{!! $pasien->address !!}</td>
            </tr>
            <tr>
                <td><b>Hp</b></td>
                <td>{!! $pasien->phone !!}</td>
            </tr>
            <tr>
                <td><b>Gender</b></td>
                <td>{!! $pasien->gender !!}</td>
            </tr>
            <tr>
                <td><b>Tanggal Lahir</b></td>
                <td>{!! date('d F Y', strtotime($pasien->birth)) !!}</td>
            </tr>
        </table>
    </div>
</div>
@endsection