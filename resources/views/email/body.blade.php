<?php
$heartsEmoji = [
    '&#128140;',
    '&#128147;',
    '&#128149;',
    '&#128150;',
    '&#128151;',
    '&#128152;',
    '&#128153;',
    '&#128154;',
    '&#128155;',
    '&#128156;',
    '&#128157;',
    '&#128158;',
    '&#10084;',
];
?>
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
            font-family: 'Comfortaa', sans-serif;
        }

        td {
            padding: 0 30px;
        }

        .greeting-header {
            color: #E04E39;
            font-weight: bold;
            font-size: 30px;
        }

        .congratulationMessage {
            color: white;
            font-weight: normal;
            margin: 15px 0 25px;
            line-height: 25px;
            font-size: 15px;
        }

        .signature {
            font-size: 15px;
        }

        @media (min-width: 992px) {
            table {
                width: 70vw;
            }

            .greeting-header {
                font-size: 40px;
            }

            td {
                padding: 0 60px;
            }

            .signature {
                color: gray;
                font-weight: normal;
                margin-top: 50px;
            }
        }
    </style>
</head>
<body>
<table style="margin:0 auto;background-color:#151F6D;background-size:cover;border-radius:45px;">
    <tr>
        <td>
            <h2 class="greeting-header" style="">С днём
                рождения, {{ $employee->first_name }} <?= $heartsEmoji[random_int(0, count($heartsEmoji) - 1)]; ?></h2>
        </td>
    </tr>
    <tr>
        <td>
            <p class="congratulationMessage" style="">{{ $congratulationMessage }}</p>
        </td>
    </tr>
</table>
<p class="signature" style="">Создано <a href="https://t.me/dev_kono" target="_blank">Кононенко
        Алексеем</a> с использвованием технологий <a href="https://openai.com/" target="_blank">OpenAI</a></p>
</body>
</html>


