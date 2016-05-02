@extends('layouts.app')

@section('content')

<div class="container">
  	<div class="panel panel-default">
		<form action="{!! URL::to('orders/search') !!}" method="post">
		<div class="panel-heading">Filter by : &nbsp;
			<select name="filter_id"> 
				<option value="0">Silakan Pilih</option> 
				<option value="1">Nama Pasien</option> 
				<option value="2">Email</option> 
				<option value="3">Kode Voucher</option> 
			</select>
			&nbsp; <input type="text" name="filter_name" size="25">
		</div>
		<div class="panel-heading">
			Tanggal : &nbsp; <input type="text" id="tgl" name="filter_tgl">
		</div>
		<div class="panel-heading">
			<input type="submit" value="Search">
		</div>
		</form>

		<div class="panel-heading">Data Order Test Lab
		@if(!empty($error))
				&nbsp; - &nbsp; <font color="red">{!! $error !!}</font>
		@endif
		</div>

		<table class="table table-stripped table-bordered">

			<thead align="center">
				<th>Tgl Order</th>
				<th>Nama Pasien</th>
				<th>Gender</th>
				<th>Tgl Tes Lab</th>
				<th>Layanan</th>
				<th>Jam Layanan</th>
				<th>Grand Total</th>
				<th>Grand Total Disc</th>
				<th>Status</th>
				<th>Lab</th>
				<th class="text-center">Action</th>
			</thead>

			<tbody><?php $otr = ''; ?>
			@foreach ($orders as $o => $val)
				<?php $otr = ''; ?>
				<?php $otr = explode("#", $val->other);  ?>
				<tr>
					<td>{{dump($val->other)}} {!! date('d F Y, H:i:s', strtotime($val->date)) !!}</td>
					<td>  {!! ucwords($otr[0]) !!}</td>
					<td>@if( $otr[2] == 1) Pria @elseif( $otr[2] == 0) Wanita @endif</td>
					<td>{{ date('d F Y', strtotime($otr[7])) }}</td>
					<td>@if( $otr[6] == 1) Periksa di Lab @elseif( $otr[6] == 0) Home Service @endif</td>
					<td>
						@if( !empty($otr[8]))
							<?php $data = DB::table('home_service_time')->where('id' , $otr[8])->first();?> {!! $data->time !!}
						@else
							-
						@endif
					</td>
					<td>Rp. {!! number_format($val->grand_total, 0, ',', '.') !!}</td>
					<td>Rp. {!! number_format($val->grand_total_disc, 0, ',', '.') !!} - {!! $val->voucher_name !!}</td>
					<td>
						@if( $val->status == 0) Pending @elseif( $val->status == 1) On Process @elseif( $val->status == 3) Hasil Sudah Diemail @else Cancel @endif
					</td>
					<td>{!! $val->nama_lab !!}</td>
					<td class="text-center">
						<div class="btn-group">
							<a href="orders/show/{{ $val->orders_code }}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
						</div>
					</td>
				</tr>

			@endforeach
			</tbody>

		</table>
		<div class="panel-footer">
			<div class="text-center">{!! $orders->links() !!}</div>
		</div>
	</div>
</div>
@endsection