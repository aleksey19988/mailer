@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Список отделов</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('departments.create') }}">Добавить отдел</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($departments->all()))
        <table class="table table-striped">
            <tr>
                <th>Наименование отдела</th>
                <th>Почта отдела</th>
                <th>Действия</th>
            </tr>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->email }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('departments.show', $department->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('departments.edit', $department->id) }}">Редактировать</a>
                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="delete-item-form">
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
            Самое время добавить первый отдел!
        </div>
    @endif
@endsection
