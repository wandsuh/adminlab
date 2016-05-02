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
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['members.update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'members.store']) !!}
    @endif
    
	<div class="form-group">
	    {!! Form::label('nama', 'Nama:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('alamat', 'Alamat:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('umur', 'Umur:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('umur', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('hp', 'Hp:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('hp', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

	<div class="form-group">
	    {!! Form::label('gender', 'Gender:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('gender', null, ['class' => 'form-control']) !!}
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