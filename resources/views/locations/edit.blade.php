@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование площадки</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('locations.index') }}"> На главную</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-6 col-md-4 mb-3">
            <div class="form-group">
                <p>Когда добавили: <strong>{{ $location->created_at }}</strong></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 mb-3">
            <div class="form-group">
                <p>Когда последний раз меняли: <strong>{{ $location->updated_at }}</strong></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="name" value="{{ $location->name }}" class="form-control" placeholder="Например, Липецк">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
