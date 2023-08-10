<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    @vite('resources/js/app.js')
    <title>Document</title>
</head>
<body>
    <div class="spinner-container">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    <div class="container pt-3">
        <nav class="navbar navbar-dark p-3 mb-3">
            <div class="container">
                <div>
                    <a class="navbar-brand" href="{{ route('site.index') }}">АСГИОПСП</a>
                    @if(\Illuminate\Support\Facades\Route::currentRouteName() !== 'site.index')
                        <a type="button" class="btn btn-outline-light return-to-home-page-link" href="{{ route('site.index') }}">На главную</a>
                    @endif
                </div>
                <small class="text-light">Автоматизированный сервис генерации и отправки писем с поздравлениями</small>
            </div>
        </nav>
        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
