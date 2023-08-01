@extends('layouts.app')
@section('content')
    <div class="list-group">
        <a href="{{ route('emails.index') }}" class="list-group-item list-group-item-action">Список электронных адресов (e-mails)</a>
        <a href="{{ route('locations.index') }}" class="list-group-item list-group-item-action">Площадки</a>
        <a href="{{ route('request-types.index') }}" class="list-group-item list-group-item-action">Типы запросов</a>
        <a href="{{ route('holidays.index') }}" class="list-group-item list-group-item-action">Праздники</a>
    </div>
@endsection
