@extends('layouts.master')

@section('content')
  <div class="panel panel-default">
	<div class="panel-heading">
		All Members
		<div class="panel-nav pull-right" style="margin-top: -7px;">
			<a href="{!! route('members.create') !!}" class="btn btn-default">Add New</a>
		</div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Umur</th>
			<th>Hp</th>
			<th>Gender</th>

			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach ($members as $member)
				<tr>
					<td class="text-center">{!! $index !!}</td>
					<td>{!! $member->nama !!}</td>
					<td>{!! $member->alamat !!}</td>
					<td>{!! $member->umur !!}</td>
					<td>{!! $member->hp !!}</td>
					<td>{!! $member->gender !!}</td>
		
					<td>{!! $member->created_at !!}</td>
					<td class="text-center">
						<div class="btn-group">
							{!! Form::open(['method' => 'DELETE', 'route' => ['members.destroy', $member->id]]) !!}
							<a href="{!! route('members.show', $member->id) !!}" class="btn btn-sm btn-default" title="View" data-toggle="tooltip"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{!! route('members.edit', $member->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
							<button type="submit" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></button>
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
				<?php $index++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="text-center">{!! $members !!}</div>
	</div>
</div>
@stop