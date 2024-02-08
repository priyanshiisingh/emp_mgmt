@extends('layouts.app')
@section('content')
<div class="container mt-5">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $employee->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $employee->email }}
        </div>
    </div>
</div>
</div>
@endsection