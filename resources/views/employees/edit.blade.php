@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Редактирование сотрудника</h2>
            </div>
            <div class="pull-right mt-3">
                <a class="btn btn-primary" href="{{ route('employees.index') }}">Все сотрудники</a>
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

    <form action="{{ route('employees.update', $employee) }}" method="POST">
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
                            <label for="last_name">
                                <strong>Фамилия:</strong>
                            </label>
                            <input id="last_name" type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Иванов" value="{{ $employee->last_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="first_name">
                                <strong>Имя:</strong>
                            </label>
                            <input id="first_name" type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="Алексей" value="{{ $employee->first_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="patronymic">
                            <strong>Отчество:</strong>
                        </label>
                        <input id="patronymic" type="text" name="patronymic" class="form-control @error('patronymic') is-invalid @enderror" placeholder="Николаевич" value="{{ $employee->patronymic }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="department_id">
                                <strong>Отдел:</strong>
                            </label>
                            <select id="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id" >
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="branch_id">
                                <strong>Филиал:</strong>
                            </label>
                            <select id="branch_id" class="form-select @error('branch_id') is-invalid @enderror" name="branch_id">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ $employee->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="position_id">
                                <strong>Должность:</strong>
                            </label>
                            <select id="position_id" class="form-select @error('position_id') is-invalid @enderror" name="position_id">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}" {{ $employee->position_id == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="email">
                        <strong>Email:</strong>
                    </label>
                    <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="test@example.com" value="{{ $employee->email }}">
                </div>
                <div class="form-group mb-3">
                    <label for="birthday">
                        <strong>Дата рождения:</strong>
                    </label>
                    <input id="birthday" type="text" name="birthday" class="form-control @error('birthday') is-invalid @enderror" placeholder="01.01.1991" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->birthday)->format('d.m.Y') }}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Обновить</button>
        </div>
    </form>
@endsection
