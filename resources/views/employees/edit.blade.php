@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование сотрудника</h2>
            </div>
            <div class="pull-right mt-3">
                <a class="btn btn-primary" href="{{ route('employees.index') }}">На главную</a>
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

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
            <div class="form-group">
                <p>Когда добавили: <strong>{{ $employee->created_at ?? 'Неизвестно' }}</strong></p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 mb-3">
            <div class="form-group">
                <p>Когда последний раз меняли: <strong>{{ $employee->updated_at ?? 'Неизвестно'}}</strong></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <strong>Имя:</strong>
                            <input type="text" name="first_name" class="form-control" placeholder="Алексей" value="{{ $employee->first_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <strong>Фамилия:</strong>
                            <input type="text" name="last_name" class="form-control" placeholder="Иванов" value="{{ $employee->last_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <strong>Отчество:</strong>
                        <input type="text" name="patronymic" class="form-control" placeholder="Николаевич" value="{{ $employee->patronymic }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <strong>Отдел:</strong>
                            <select class="form-select" name="department_id" id="">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <strong>Филиал:</strong>
                            <select class="form-select" name="branch_id" id="">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ $employee->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <strong>Должность:</strong>
                            <select class="form-select" name="position_id" id="">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ $employee->position_id == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" placeholder="test@example.com" value="{{ $employee->email }}">
                </div>
                <div class="form-group mb-3">
                    <strong>Дата рождения:</strong>
                    <input type="text" name="birthday" class="form-control" placeholder="01.01.1991" value="{{ $employee->birthday }}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>
@endsection
