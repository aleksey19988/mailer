@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Список должностей</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('positions.create') }}">Добавить должность</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($positions->all()))
        <table class="table table-striped">
            <tr>
                <th>Наименование должности</th>
                <th>Описание должности</th>
                <th>Действия</th>
            </tr>
            @foreach ($positions as $position)
                <tr>
                    <td>{{ $position->name }}</td>
                    <td>{{ $position->description ?? 'Не указано' }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('positions.show', $position->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('positions.edit', $position->id) }}">Редактировать</a>
                        <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="delete-item-form">
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
            Самое время добавить первую должность!
        </div>
    @endif
@endsection
