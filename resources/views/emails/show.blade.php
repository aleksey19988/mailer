@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Просмотр</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('emails.index') }}"> На главную</a>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $email->email_address }}
            </div>
        </div>
    </div>
@endsection
