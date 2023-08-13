@extends('layouts.app')
@section('content')

    <div class="auth-form-container d-flex justify-content-center align-items-center flex-column">
        <div class="alert alert-primary" role="alert">
            Автоматизированный сервис генерации и отправки писем с поздравлениями
        </div>
        <form action="{{ route('login.authenticate') }}" method="post" class="p-5 auth-form">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
@endsection
