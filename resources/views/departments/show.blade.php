@extends('layouts.app')
@section('content')

    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>{{ $department->name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('departments.index') }}">Вернуться</a>
                <a class="btn btn-primary" href="{{ route('departments.edit', $department) }}">Редактировать</a>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Поле</th>
            <th scope="col">Значение</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Наименование отдела</th>
            <td>{{ $department->name }}</td>
        </tr>
        <tr>
            <th scope="row">Адрес электронной почты отдела</th>
            <td>{{ is_null($department->email) ? 'Не указана' : $department->email }}</td>
        </tr>
        <tr>
            <th scope="row">Дата создания записи</th>
            <td>{{ $department->created_at }}</td>
        </tr>
        <tr>
            <th scope="row">Когда обновляли запись последний раз</th>
            <td>{{ $department->updated_at }}</td>
        </tr>
        <tr>
            <th scope="row">Активен</th>
            <td>{{ is_null($department->deleted_at) ? 'Да' : 'Нет' }} </td>
        </tr>
        </tbody>
    </table>
    <div class="employees-container mt-5">
        <h2>Список сотрудников:</h2>
        @if($department->employees->all())
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">Филиал</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($department->employees as $employee)
                    <tr>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>
                            @if(is_null($employee->patronymic))
                                <span class="text-danger">Не указано</span>
                            @else
                                {{ $employee->patronymic }}
                            @endif
                        </td>
                        <td>{{ \App\Models\Branch::query()->find($employee->branch_id)->name }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee->id) }}">Просмотр</a>
                            <a class="btn btn-primary" href="{{ route('employees.edit', $employee->id) }}">Редактировать</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="delete-item-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h5>Сотрудники отсутствуют</h5>
        @endif
    </div>

@endsection
