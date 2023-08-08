@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Добавление нового сотрудника</h2>
            </div>
            <div class="pull-right">
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
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="first_name">
                                <strong>Имя:</strong>
                            </label>
                            <input type="text" id="first_name" name="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name') }}" placeholder="Алексей">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="last_name">
                                <strong>Фамилия:</strong>
                            </label>
                            <input type="text" id="last_name" name="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name') }}" placeholder="Иванов">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="patronymic">
                            <strong>Отчество:</strong>
                        </label>
                        <input type="text" id="patronymic" name="patronymic"
                               class="form-control @error('patronymic') is-invalid @enderror"
                               value="{{ old('patronymic') }}" placeholder="Николаевич">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="department_id">
                                <strong>Отдел:</strong>
                            </label>
                            <select id="department_id" class="form-select @error('department_id') is-invalid @enderror"
                                    name="department_id">
                                @foreach($departments as $department)
                                    <option
                                        value="{{ $department->id }}" {{ (int)old('department_id') === $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="branch_id">
                                <strong>Филиал:</strong>
                            </label>
                            <select id="branch_id" class="form-select @error('branch_id') is-invalid @enderror"
                                    name="branch_id">
                                @foreach($branches as $branch)
                                    <option
                                        value="{{ $branch->id }}" {{ (int)old('branch_id') === $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="position_id">
                                <strong>Должность:</strong>
                            </label>
                            <select id="position_id" class="form-select @error('position_id') is-invalid @enderror"
                                    name="position_id">
                                @foreach($positions as $position)
                                    <option
                                        value="{{ $position->id }}" {{ (int)old('position_id') === $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="email">
                        <strong>Email:</strong>
                    </label>
                    <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="test@example.com">
                </div>
                <div class="form-group mb-3">
                    <label for="birthday">
                        <strong>Дата рождения:</strong>
                    </label>
                    <input id="birthday" type="text" name="birthday"
                           class="form-control @error('birthday') is-invalid @enderror" value="{{ old('birthday') }}" placeholder="01.01.1991">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
    </form>
@endsection
