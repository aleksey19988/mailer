@extends('layouts.app')
@section('content')
    <div class="welcome-section row p-3">
        <div class="mb-2 col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h3>Справочники</h3>
            <div class="list-group">
                <a href="{{ route('cities.index') }}" class="list-group-item list-group-item-action">Города</a>
                <a href="{{ route('positions.index') }}" class="list-group-item list-group-item-action">Должности</a>
                <a href="{{ route('departments.index') }}" class="list-group-item list-group-item-action">Отделы</a>
                <a href="{{ route('holidays.index') }}" class="list-group-item list-group-item-action">Праздники</a>
                <a href="{{ route('employees.index') }}" class="list-group-item list-group-item-action">Сотрудники</a>
                <a href="{{ route('branches.index') }}" class="list-group-item list-group-item-action">Филиалы</a>
            </div>
        </div>
        <div class="mb-2 col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h3>Отправка</h3>
            <div class="list-group">
                <a href="{{ route('api.index') }}" class="list-group-item list-group-item-action">Тестирование API
                    ChatGPT</a>
                <a href="{{ route('email.index') }}" class="list-group-item list-group-item-action">Ручная отправка
                    писем</a>
            </div>
        </div>
        <div class="mb-2 col-xl-4 col-lg-4 col-md-6 col-sm-12">
            <h3>Логи</h3>
            <div class="list-group">
                <a href="{{ route('request-to-api-log.index') }}" class="list-group-item list-group-item-action">Запросы
                    к API</a>
                <a href="{{ route('email-log.index') }}" class="list-group-item list-group-item-action">Отправка
                    писем</a>
            </div>
        </div>
    </div>
    <div class="welcome-section row p-3 mt-5">
        <h2>Сегодня {{ \Carbon\Carbon::today()->format('d.m.Y') }}</h2>
        @if($birthdayEmployees)
            <h4>Именинники:</h4>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Полное имя</th>
                    <th scope="col">Дата рождения</th>
                    <th scope="col">Поздравление отправлено</th>
                </tr>
                </thead>
                <tbody>
                @foreach($birthdayEmployees as $employee)
                    <tr>
                        <td>{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->patronymic }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->birthday)->format('d.m.Y') }}</td>
                        <td>
                        <?php
                            $logByEmail = \App\Models\EmailLog::query()
                                ->where([['addressee_letter_email', '=', $employee->email]])
                                ->first();
                            if ($logByEmail) {
                                $emailSentToday = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $logByEmail->created_at)->format('d.m.Y') == \Carbon\Carbon::today()->format('d.m.Y');
                                if ($emailSentToday) {
                                    echo '<span class="text-success">Да</span>';
                                } else {
                                    echo '<span class="text-danger">Нет</span>';
                                }
                            } else {
                                echo '<span class="text-danger">Нет</span>';
                            }
                        ?>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h4>Именинников нет</h4>
        @endif
    </div>
@endsection
