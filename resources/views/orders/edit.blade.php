@extends('layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Member
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('members.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('members.form', ['model' => $member])
        </div>
    </div>

@stop