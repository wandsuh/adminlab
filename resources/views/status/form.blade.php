@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['status.update', $model->orders_code]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'status.store']) !!}
    @endif

	<div class="form-group">
		{!! Form::label('date', 'Tgl Order:', ['class' => 'col-md-2 control-label']) !!}
		<div class="col-sm-9">
			{!! Form::text('date', null, ['class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
	    {!! Form::label('nama', 'Nama Pasien:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">

	    </div>
	</div>

	<div class="form-group">
		{!! Form::label('gender', 'Gender:', ['class' => 'col-md-2 control-label']) !!}
		<div class="col-sm-9">

		</div>
	</div>

	<div class="form-group">
	    {!! Form::label('alamat', 'Alamat:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">

	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('Telp', 'Telp:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">

	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('tgl_tes_lab', 'Tgl Tes Lab:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">

	    </div>
	</div>

	<div class="form-group">
		{!! Form::label('layanan', 'Layanan:', ['class' => 'col-md-2 control-label']) !!}
		<div class="col-sm-9">

		</div>
	</div>

	<div class="form-group">
		{!! Form::label('jam_layanan', 'Jam Layanan:', ['class' => 'col-md-2 control-label']) !!}
		<div class="col-sm-9">

		</div>
	</div>

    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>