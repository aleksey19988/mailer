@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление нового филиала</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-primary" href="{{ route('branches.index') }}">Вернуться</a>
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
                    <strong>Наименование филиала:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Волгоград, 'Пирамида'">
                </div>
                <div class="form-group mb-3">
                    <strong>Город:</strong>
                    <select class="form-select" name="city_id" id="">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <strong>Дата открытия:</strong>
                    <input type="text" name="opening_date" class="form-control" placeholder="01.01.1991">
                </div>
                <div class="form-group mb-3">
                    <strong>Адрес:</strong>
                    <input type="text" name="address" class="form-control" placeholder="Липецк, ул. Ленина, 16">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
    </form>
@endsection
