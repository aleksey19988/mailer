<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Проект для автоматизированной отправки писем с поздравлениями на день рождения

- Каждый час запускается крон, который проверяет, есть ли сегодня именинники
- Если есть люди, которые ещё не были поздравлены, формируется письмо, текст которого пишет ChatGPT с учётом предоставленных ему данных об имениннике
- Письмо отправляется на почту, указанную у пользователя в БД
- При отправке логируются запрос к API ChatGPT и само письмо в соответствующие таблицы

### Для корректной работы проекта локально
#### Необходимо инициализировать в .env переменные со значениями:
- APP_ENV
- Переменыне, связанные с подключение к БД
- Переменная с токеном API ChatGPT
    - API_KEY
- Переменные для работы рассылки (smtp)
    - MAIL_USERNAME
    - MAIL_PASSWORD

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
