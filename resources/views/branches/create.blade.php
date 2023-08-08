@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление нового филиала</h2>
            </div>
            <div class="pull-right mb-3">
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

    <form action="{{ route('branches.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <label for="name">
                        <strong>Наименование филиала:</strong>
                    </label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Волгоград, 'Пирамида'">
                </div>
                <div class="form-group mb-3">
                    <label for="city_id">
                        <strong>Город:</strong>
                    </label>
                    <select class="form-select @error('city_id') is-invalid @enderror" name="city_id" id="city_id">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ (int)old('city_id') === (int)$city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="opening_date">
                        <strong>Дата открытия:</strong>
                    </label>
                    <input type="text" id="opening_date" name="opening_date" class="form-control @error('opening_date') is-invalid @enderror" value="{{ old('opening_date') }}" placeholder="01.01.1991">
                </div>
                <div class="form-group mb-3">
                    <label for="address">
                        <strong>Адрес:</strong>
                    </label>
                    <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Липецк, ул. Ленина, 16">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
    </form>
@endsection
