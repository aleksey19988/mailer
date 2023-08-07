@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление нового города</h2>
            </div>
            <div class="pull-right mb-3 mt-3">
                <a class="btn btn-primary" href="{{ route('cities.index') }}">Вернуться</a>
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

    <form action="{{ route('cities.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="name">
                        <strong>Город:</strong>
                    </label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Например, Саранск">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
    </form>
@endsection
