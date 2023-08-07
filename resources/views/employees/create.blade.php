@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление нового сотрудника</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}">Вернуться</a>
            </div>
        </div>
    </div>
    @if ($errors)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error['message'] }} <a class="" href="{{ route($error['route']) }}">исправить</a> </li>
                @endforeach
            </ul>
            <p class="error-message">Перед добавлением сотрудника следует исправить указанные ошибки</p>
        </div>
    @else
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <strong>Имя:</strong>
                                <input type="text" name="first_name" class="form-control" placeholder="Алексей">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <strong>Фамилия:</strong>
                                <input type="text" name="last_name" class="form-control" placeholder="Иванов">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <strong>Отчество:</strong>
                            <input type="text" name="patronymic" class="form-control" placeholder="Николаевич">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <strong>Отдел:</strong>
                                <select class="form-select" name="department_id" id="">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <strong>Филиал:</strong>
                                <select class="form-select" name="branch_id" id="">
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <strong>Должность:</strong>
                                <select class="form-select" name="position_id" id="">
                                    @foreach($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <strong>Email:</strong>
                        <input type="text" name="email" class="form-control" placeholder="test@example.com">
                    </div>
                    <div class="form-group mb-3">
                        <strong>Дата рождения:</strong>
                        <input type="text" name="birthday" class="form-control" placeholder="01.01.1991">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
    @endif
@endsection
