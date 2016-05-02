@extends('layouts.app')

@section('content')
<div class="container">
  	<div class="panel panel-default">
	<div class="panel-heading">Dashboard</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<?php $lab = session('company_code'); ?>
			<tr><td> @if( !empty(Auth::user()->name) ) Hi...<br>Selamat datang {{ ucwords(Auth::user()->name) }} @else Silakan login terlebih dahulu @endif </td></tr>
		</thead>

	</table>
	</div>
</div>
@stop