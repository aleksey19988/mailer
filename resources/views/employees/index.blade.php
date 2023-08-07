@php use Carbon\Carbon; @endphp
@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Список сотрудников</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employees.create') }}">Добавить сотрудника</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($employees->all()))
        <table class="table table-striped">
            <tr>
                <th>Полное имя</th>
                <th>Email</th>
                <th>Дата рождения</th>
                <th>Действия</th>
            </tr>
            @foreach ($employees as $employee)
                <tr>
                    <td class="full-name-header">{{ $employee->first_name }} {{ $employee->last_name }} {{ $employee->patronymic }}</td>
                    <td class="branch-header">{{ $employee->email }}</td>
                    <td class="branch-header">{{ Carbon::createFromFormat('Y-m-d H:i:s', $employee->birthday)->format('d.m.Y') }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('employees.show', $employee->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('employees.edit', $employee->id) }}">Редактировать</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                              class="delete-item-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-primary" role="alert">
            Самое время добавить первого сотрудника!
        </div>
    @endif

@endsection
