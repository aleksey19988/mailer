@extends('layouts.app')
@section('content')
    <div class="list-group">
        <a href="{{ route('emails.index') }}" class="list-group-item list-group-item-action">Список электронных адресов (e-mails)</a>
        <a href="{{ route('locations.index') }}" class="list-group-item list-group-item-action">Площадки</a>
        <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
    </div>
@endsection
