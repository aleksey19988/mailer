@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление нового праздника</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-primary" href="{{ route('holidays.index') }}">Вернуться</a>
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

    <form action="{{ route('holidays.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <strong>Имя праздника:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Например, день рождения">
                </div>
                <div class="form-group mb-3">
                    <strong>Дата празднования:</strong>
                    <input type="text" name="date_of_celebration" class="form-control" placeholder="{{ \Carbon\Carbon::now()->format('d.m.Y') }}" value="{{ \Carbon\Carbon::now()->format('d.m.Y') }}">
                    <small class="text-secondary">Не обязательно для дня рождения</small>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>
@endsection
