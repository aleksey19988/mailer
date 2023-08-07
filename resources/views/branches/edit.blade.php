@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование филиала</h2>
            </div>
            <div class="pull-right mt-3">
                <a class="btn btn-primary" href="{{ route('branches.index') }}">На главную</a>
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

    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
            <div class="form-group">
                <p>Когда добавили: <strong>{{ $branch->created_at ?? 'Неизвестно' }}</strong></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
            <div class="form-group">
                <p>Когда последний раз меняли: <strong>{{ $branch->updated_at ?? 'Неизвестно'}}</strong></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <strong>Наименование филиала:</strong>
                    <input type="text" name="name" value="{{ $branch->name }}" class="form-control" placeholder="Например, Липецк">
                </div>
                <div class="form-group mb-3">
                    <strong>Город:</strong>
                    <select class="form-select" name="city_id" id="">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $branch->city_id == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <strong>Дата открытия:</strong>
                    <input type="text" name="opening_date" class="form-control" placeholder="01.01.1991" value="{{ $branch->opening_date }}">
                </div>
                <div class="form-group mb-3">
                    <strong>Адрес:</strong>
                    <input type="text" name="address" class="form-control" placeholder="Липецк, ул. Ленина, 16" value="{{ $branch->address }}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>
@endsection
