@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление новой должности</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('positions.index') }}">Все должности</a>
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

    <form action="{{ route('positions.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <label for="name">
                        <strong>Имя должности:</strong>
                    </label>
                    <input type="text" id="name" name="name" class="form-control @error('') is-invalid @enderror" value="{{ old('name') }}" placeholder="Например, супервайзер">
                </div>
                <div class="form-group mb-3">
                    <label for="description">
                        <strong>Описание:</strong>
                    </label>
                    <textarea id="description" name="description" class="form-control @error('') is-invalid @enderror">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </form>
@endsection
