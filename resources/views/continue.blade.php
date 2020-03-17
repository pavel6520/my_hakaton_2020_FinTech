<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hakaton_FinTech_2020</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <a href="/">
            <div class="title m-b-md">Laravel</div>
        </a>
        <a href="/auth/logout"><h4>Logout</h4></a>
        <h3>Тестовое приложение pavel6520</h3><br>
        <h2>Join as: {{$login}}</h2>
        @if (isset($url))
            <img src="{{$url}}" /><br>
            <a href="/auth/continue">Continue</a>
        @else
            <form action="/auth/continue" method="get">
                <div style="text-align: center;">
                    <input type="text" class="form-control" name="code" placeholder="******" style="font-size: xx-large;width: 200px;border-radius: 0px;text-align: center;display: inline;color: #0275d8;"><br> <br>
                    <button type="submit" class="btn btn-md btn-primary" style="width: 200px;border-radius: 0px;">Verify</button>
                </div>
            </form>
        @endif
    </div>
</div>
</body>
</html>
