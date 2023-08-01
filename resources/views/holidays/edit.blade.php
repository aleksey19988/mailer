@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование праздника</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('holidays.index') }}"> На главную</a>
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

    <form action="{{ route('holidays.update', $holiday->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-6 col-md-4 mb-3">
            <div class="form-group">
                <p>Когда добавили: <strong>{{ $holiday->created_at }}</strong></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 mb-3">
            <div class="form-group">
                <p>Когда последний раз меняли: <strong>{{ $holiday->updated_at }}</strong></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <strong>Праздник:</strong>
                    <input type="text" name="name" value="{{ $holiday->name }}" class="form-control" placeholder="Например, Липецк">
                </div>
                <div class="form-group mb-3">
                    <strong>Дата празднования:</strong>
                    <input type="text" name="date_of_celebration" value="{{ $holiday->date_of_celebration }}" class="form-control" placeholder="{{ \Carbon\Carbon::now()->format('d.m.Y') }}">
                    <small class="text-secondary">Не обязательно для дня рождения</small>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
