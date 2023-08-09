@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Тестирование запросов к ChatGPT</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('site.index') }}">Вернуться</a>
            </div>
        </div>
    </div>
    <div class="alert alert-success congratulation-success-alert">
        <p class="congratulation-success-content"></p>
    </div>
    <div class="alert alert-success congratulation-error-alert">
        <p class="congratulation-error-content"></p>
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

    <form action="{{ route('api.store') }}" method="POST" id="api-request-form">
        @csrf
        <div class="row mb-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="form-group mb-3">
                    <label for="question">
                        <strong>Напишите свой вопрос:</strong>
                    </label>
                    <textarea class="form-control" name="question" id="question" placeholder=""></textarea>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-success">Отправить запрос</button>
        </div>
    </form>
@endsection
