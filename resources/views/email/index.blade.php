@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ручная отправка писем</h2>
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

    <form action="{{ route('email.store') }}" method="POST" id="send-email-form">
        @csrf
        <div class="row mb-3">
            <div class="col-12 col-sm-12 col-lg-6 col-xl-4">
                <div class="form-group mb-3">
                    <label for="employee_id">
                        <strong>Кого поздравляем?</strong>
                    </label>
                    <select class="form-select" name="employee_id" id="employee_id">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->patronymic }} ({{ $employee->department->name }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="holiday_id">
                        <strong>Какой праздник?</strong>
                    </label>
                    @if($holidays->all())
                    <select class="form-select" name="holiday_id" id="holiday_id">
                        @foreach($holidays->all() as $holiday)
                            <option value="{{ $holiday->id }}">{{ $holiday->name }}</option>
                        @endforeach
                    </select>
                    @else
                        <p class="text-danger">Ни один праздник не добавлен</p>
                        <a class="btn btn-primary" href="{{ route('holidays.create') }}">Добавить праздник</a>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="description">
                        <strong>Описание, которое поможет более точно сгенерировать поздравление:</strong>
                    </label>
                    <textarea class="form-control" name="description" id="description" placeholder=""></textarea>
                </div>
            </div>
        </div>
        <div class="pull-right">
            <button type="submit" class="btn btn-success col-12 col-sm-12 col-lg-6 col-xl-4">Отправить запрос</button>
        </div>
    </form>
@endsection
