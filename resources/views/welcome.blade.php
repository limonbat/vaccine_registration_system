<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LAND OFFICE API SERVICE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .welcome-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body >


<div class="welcome-page">
    <div class="flex-center position-ref full-height">
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-primary" role="alert">
                {{ \Illuminate\Support\Facades\Session::get('message')  }}
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <h1>VACCINE REGISTRATION SYSTEM</h1>
            </div>
        </div>
        <div class="top-right links" style="text-align: center;font-size: 20px">
            <a href="{{ route('registration.create') }}" style="margin-right: 20px">Registration</a>
            <a href="{{ route('status.form') }}">Check Vaccination Status</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
