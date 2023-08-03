@extends('layouts.app')
@section('content')
    <div class="row mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Список площадок </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('locations.create') }}">Добавить площадку</a>
            </div>
        </div>
    </div>

    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if(!empty($locations->all()))
        <table class="table table-striped">
            <tr>
                <th>Наименование</th>
                <th>Действия</th>
            </tr>
            @foreach ($locations as $location)
                <tr>
                    <td class="email-address-header">{{ $location->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('locations.show', $location->id) }}">Просмотр</a>
                        <a class="btn btn-primary" href="{{ route('locations.edit', $location->id) }}">Редактировать</a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="delete-item-form">
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
            Самое время добавить первую площадку!
        </div>
    @endif


@endsection
