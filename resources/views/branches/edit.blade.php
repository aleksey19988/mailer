@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование филиала</h2>
            </div>
            <div class="pull-right mt-3">
                <a class="btn btn-primary" href="{{ route('branches.index') }}">Все филиалы</a>
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
                <p>Когда добавили: <strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $branch->created_at)->format('d.m.Y') ?? 'Неизвестно' }}</strong></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
            <div class="form-group">
                <p>Когда последний раз меняли: <strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $branch->updated_at)->format('d.m.Y') ?? 'Неизвестно'}}</strong></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <label for="name">
                        <strong>Наименование филиала:</strong>
                    </label>
                    <input type="text" id="name" name="name" value="{{ $branch->name }}" class="form-control" placeholder="Например, Липецк">
                </div>
                <div class="form-group mb-3">
                    <label for="city_id">
                        <strong>Город:</strong>
                    </label>
                    <select class="form-select" name="city_id" id="city_id">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ (int)$branch->city_id === (int)$city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="opening_date">
                        <strong>Дата открытия:</strong>
                    </label>
                    <input type="text" id="opening_date" name="opening_date" class="form-control" placeholder="01.01.1991" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $branch->opening_date)->format('d.m.Y') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="address">
                        <strong>Адрес:</strong>
                    </label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Липецк, ул. Ленина, 16" value="{{ $branch->address }}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>
@endsection
