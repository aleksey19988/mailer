@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование отдела</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('departments.index') }}">Все отделы</a>
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

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
            <div class="form-group">
                <p>Когда добавили: <strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $department->created_at)->format('d.m.Y') ?? 'Неизвестно' }}</strong></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
            <div class="form-group">
                <p>Когда последний раз меняли: <strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $department->updated_at)->format('d.m.Y') ?? 'Неизвестно' }}</strong></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <label for="name">
                        <strong>Имя отдела:</strong>
                    </label>
                    <input type="text" id="name" name="name" value="{{ $department->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Например, бухгалтерия">
                </div>
                <div class="form-group mb-3">
                    <label for="email">
                        <strong>Почта отдела:</strong>
                    </label>
                    <input type="text" id="email" name="email" value="{{ $department->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="test@example.com">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection
