@extends('layouts.app')

@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Data Detail</title>
</head>
<body>
<div style="margin:0 auto;display: block;max-width: 600px;text-align: center;font-family: arial;line-height: 30px;">
    <div style=" border:#999 solid 1px; margin-top: 30px;">
        <h1 style="	border-bottom: #999 solid 1px; padding-bottom: 20px; margin-bottom: 0;">Rincian Pesanan Pemeriksaan</h1>
        <div style=" padding: 30px 30px; text-align: left;"> {!! dump($pasien) !!}
            <?php $ps = explode('#', $pasien->other);?>
            <label style=" display: block; font-weight: bold; ">Nama Pasien : {!! $pasien->name !!}</label>
            <label style=" display: block; font-weight: bold; ">Tanggal Lahir : {!! date('d F Y', strtotime($pasien->birth)) !!}</label>
            <label style=" display: block; font-weight: bold; ">Jenis Kelamin : @if( $pasien->gender = 1) Pria @elseif( $pasien->gender = 0) Wanita @endif </label>
            <label style=" display: block; font-weight: bold; ">Alamat : {!! $pasien->address !!}</label>
            <label style=" display: block; font-weight: bold; ">Email : {!! $pasien->email !!}</label>
            <label style=" display: block; font-weight: bold; ">Telp : {!! $pasien->phone !!}</label>
            <label style=" display: block; font-weight: bold; ">Layanan : @if( $ps[6] == 1) Periksa di Lab @elseif( $ps[6] == 0) Home Service @endif</label>
            <label style=" display: block; font-weight: bold; ">Tanggal Pemeriksaan : {{ date('d F Y', strtotime($pasien->valid_until)) }}</label>
            <label style=" display: block; font-weight: bold;">Perkiraan Jam Home Service :
                @if( !empty($ps[8]))
                    <?php $xxo = DB::table('home_service_time')->where('id' , $ps[8])->first(); ?> {!! $xxo->time !!}
                @else
                    -
                @endif
            </label>
            <label style=" display: block; font-weight: bold; ">Dokter Pengirim : {!! $pasien->doctor !!} </label>
            <label style=" display: block; font-weight: bold; ">Form Dokter :
                @if(!empty($pasien->gambar)) <img src="http://dev.pesanlab.com/upload/form/{!! $pasien->gambar !!}" >  @endif
            </label>

            <div style="margin-top: 30px;">Detail Pemeriksaan</div>
            <div style=" border-top: #999 solid 1px; border-left: #999 solid 1px; border-right: #999 solid 1px; border-bottom: #999 solid 1px;	padding: 30px 20px;">
                <table width="495">

                    <!-- Bagian Items -->
                    @if(!empty($trans_item))
                        @foreach ($trans_item as $value)
                            @foreach ($value as $k => $v)
                                <tr>
                                    <td> <span style="width: 5px; height: 5px; margin-right: 5px; margin-left: 25px; vertical-align: middle; display: inline-block; background: #999;"></span>{{$v->name}} </td>
                                    <td style="text-align: right;">@if($v->price_disc == 0 ) Rp. {{ number_format($v->price) }} @else Rp. {{ number_format($v->price_disc) }}  @endif </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                    <!-- End Bagian Items -->

                    @if(!empty($panels) && !empty($trans_item))
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                    @endif

                    <!-- Bagian Panels -->
                    @if(!empty($panels))
                        @foreach ($panels as $pan)
                            <tr>
                                <td><span style=" background: #999;	width: 15px; height: 15px; margin-right: 7px;display: inline-block;"></span> <strong>{{ $pan->panel_name }}</strong></td>
                                <td style="text-align: right;"><strong></strong></td>
                            </tr>

                            @foreach ($trans_panels as $kx => $ve)
                                @if($pan->panel_code == $ve->panel_code )
                                    <tr>
                                        <td> <span style="width: 5px; height: 5px; margin-right: 5px; margin-left: 25px; vertical-align: middle; display: inline-block; background: #999;"></span>
                                            {{ $ve->name }}</td>
                                        <td style="text-align: right;">@if($ve->price_disc == 0 ) Rp. {{ number_format($ve->price) }} @else Rp. {{ number_format($ve->price_disc) }}  @endif </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                    <!-- End Bagian Panels -->

                    <!-- Bagian Panels -->
                    @if(!empty($pakets))
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        @foreach ($pakets as $pak)
                            <tr>
                                <td><span style=" background: #999;	width: 15px; height: 15px; margin-right: 7px;display: inline-block;"></span> <strong>{{ $pak->nama_paket }} : {{ $pak->package_code }}</strong></td>
                                <td style="text-align: right;"><strong></strong></td>
                            </tr>

                            @foreach ($panels_paket as $kpp => $vpp)
                                @if($pak->package_code == $vpp->package_code )
                                    <tr>
                                        <td> <span style="width: 5px; height: 5px; margin-right: 5px; margin-left: 25px; vertical-align: middle; display: inline-block; background: #999;"></span>
                                            <b>{{ $vpp->nama_panel }}</td>
                                        <td style="text-align: right;"></td>
                                    </tr>

                                        @foreach ($trans_pakets as $ktp => $vtp)
                                        @if($pak->package_code == $vtp->package_code)
                                            @if($vpp->panel_code == $vtp->panel_code)

                                                <tr>
                                                    <td> <span style="width: 5px; height: 5px; margin-right: 5px; margin-left: 25px; vertical-align: middle; display: inline-block; background: #999;"></span>
                                                        {{ $vtp->name }}  </td>
                                                    <td style="text-align: right;">@if($vtp->price_disc == 0 ) Rp. {{ number_format($vtp->price, 0, ',', '.') }} @else Rp. {{ number_format($vtp->price_disc, 0, ',', '.') }} @endif </td>
                                                </tr>
                                            @endif
                                        @endif
                                        @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                    <!-- End Bagian Panels -->

                </table>
            </div>
        </div>
    </div>

    <p style="margin-top: 5px;	margin-bottom: 5px;">&nbsp;</p>
    <p style="margin-top: 5px;	margin-bottom: 5px;"> {!! $total_harga->nama_lab !!} Cabang {!! $total_harga->address !!}</p>
    <p style="margin-top: 5px;	margin-bottom: 5px;">&nbsp;</p>
    <hr/>
    <table style="text-align: left; width:100%;">
        <tr>
            <td>Total Harga Pemeriksaan</td>
            <td style="color:#00d985;">
                @if($total_harga->grand_total_disc != 0)
                    <span style=" text-decoration: line-through;	font-size: 12px; color:#000; display: block;">Rp. {{ number_format($total_harga->grand_total, 0, ',', '.') }}</span>
                    <strong> Rp. {{ number_format($total_harga->grand_total_disc, 0, ',', '.') }}</strong>
                @else
                    <strong> Rp. {{ number_format($total_harga->grand_total, 0, ',', '.') }}</strong>
                @endif
            </td>
            <td >
                @if($total_harga->grand_total_disc != 0)
                    <span style=" font-size: 12px; display: block;">Anda Hemat</span><span style="color:#ffdb4d;">Rp. {{ number_format(($total_harga->grand_total - $total_harga->grand_total_disc), 0, ',', '.') }}</span>
                @endif
            </td>
        </tr>
    </table>
    <hr/>


    <table style="width:100%;">
        <tr>
            <td><strong>Email:</strong> info@labconx.net</td>
            <td><strong>BlackBerry Pin:</strong> 524E3F04</td>
            <td><strong>WhatsApp:</strong> 081288648288</td>
        </tr>
        <tr>
            <td colspan="3">
                <hr/>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                &copy;PT. Mitra Digital Laboratorindo (Labconx) 2016
            </td>
        </tr>
    </table>
</div><!-- /container -->
</body>
</html>
@endsection