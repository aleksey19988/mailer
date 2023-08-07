@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-3">
                <h2>Список городов</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('cities.create') }}">Добавить город</a>
            </div>
        </div>
    </div>
    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($cities->all()))
        <div class="alert alert-info" role="alert">
            Если ты хочешь добавить филиал, тебе <a href="{{ route('branches.create') }}">сюда</a>!
        </div>
        <table class="table table-striped">
            <tr>
                <th>Наименование</th>
                <th>Филиалы</th>
                <th>Действия</th>
            </tr>
            @foreach ($cities as $city)
                <tr>
                    <td class="city-header">{{ $city->name }}</td>
                    <td class="branches-header">
                        @if(!empty($city->branches->all()))
                            @foreach($city->branches as $branch)
                                <p class="branch-list-item">- {{ $branch->name }}</p>
                            @endforeach
                        @else
                            <span class="text-danger">Не указано</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('cities.show', $city->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('cities.edit', $city->id) }}">Редактировать</a>
                        <form action="{{ route('cities.destroy', $city->id) }}" method="POST" class="delete-item-form">
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
            Самое время добавить первый город!
        </div>
    @endif


@endsection
