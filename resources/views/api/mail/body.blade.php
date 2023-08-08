<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap');
        * {
            font-family: 'Comfortaa', cursive;
        }
        td {
            padding: 0 60px;
        }
    </style>
</head>
<body>
<table style="margin:0 auto;background-color:#151F6D;background-size:cover;border-radius:45px;width:50vw;position:relative;">
    <tr>
        <td>
            <h2 style="color:#E04E39;font-weight: bold;font-size: 40px;padding-top:35px;">С днём рождения, {{ $employee->first_name }} &#128150;</h2>
        </td>
    </tr>
    <tr>
        <td>
            <p style="color:white;font-weight:normal;margin:25px 0 35px;line-height:30px;font-size:17px">{{ $congratulationMessage }} &#128151;</p>
        </td>
    </tr>
</table>
<p style="color:gray;font-weight: normal;margin-top:50px;">Создано <a href="https://t.me/dev_kono" target="_blank">Кононенко Алексеем</a> с использвованием технологий <a href="https://openai.com/" target="_blank">OpenAI</a></p>
</body>
</html>


