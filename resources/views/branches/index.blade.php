@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Список филиалов</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('branches.create') }}">Добавить филиал</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($branches->all()))
        <table class="table table-striped">
            <tr>
                <th>Наименование</th>
                <th>Дата открытия</th>
                <th>Адрес</th>
                <th>Действия</th>
            </tr>
            @foreach ($branches as $branch)
                <tr>
                    <td class="branch-name-header">{{ $branch->name }}</td>
                    <td class="branch-opening_date-header">{{ $branch->opening_date }}</td>
                    <td class="branch-address-header">{{ $branch->address }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('branches.show', $branch->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('branches.edit', $branch->id) }}">Редактировать</a>
                        <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" class="delete-item-form">
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
            Самое время добавить первый филиал!
        </div>
    @endif


@endsection
