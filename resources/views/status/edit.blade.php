@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('status/update') }}">
        <div class="panel panel-default">
            <div class="panel-heading">
                Status Order
                <div class="panel-nav pull-right" style="margin-top: -7px;">
                    <a href="{!! URL::to('status') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
            <div class="panel-body">
                <?php $otr = explode("#", $member->other);  ?>

                <input name="orders_code" value="{!! $member->orders_code !!}" hidden="hidden">
                <table class="table table-stripped table-bordered">
                    <tr>
                        <td>Status Order</td>
                        <td>
                            <select name="status">
                                @if($member->status == 0)
                                    <option value="0" selected="selected"> Pending </option>
                                    <option value="1"> On Process </option>
                                    <option value="3"> Hasil Sudah Diemail </option>
                                @elseif($member->status == 1)
                                    <option value="0"> Pending </option>
                                    <option value="1" selected="selected"> On Process </option>
                                    <option value="3"> Hasil Sudah Diemail </option>
                                @elseif($member->status == 3)
                                    <option value="0"> Pending </option>
                                    <option value="1"> On Process </option>
                                    <option value="3" selected="selected"> Hasil Sudah Diemail </option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tgl Order</td>
                        <td>{!! date('d F Y, H:i:s', strtotime($member->date)) !!}</td>
                    </tr>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>{!! $otr[0] !!}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>@if( $otr[2] == 1) Pria @elseif( $otr[2] == 0) Wanita @endif</td>
                    </tr>
                    <tr>
                        <td>Tgl Tes Lab</td>
                        <td>{{ date('d F Y', strtotime($otr[7])) }}</td>
                    </tr>
                    <tr>
                        <td>Layanan Lab</td>
                        <td>@if( $otr[6] == 1) Periksa di Lab @elseif( $otr[6] == 0) Home Service @endif</td>
                    </tr>
                    <tr>
                        <td>Jam Layanan</td>
                        <td>@if( !empty($otr[8]))
                                <?php $data = DB::table('home_service_time')->where('id' , $otr[8])->first();?> {!! $data->time !!}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i>Update Status
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@stop