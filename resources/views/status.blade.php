<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/css/registration.css') }}" rel="stylesheet">
</head>
<body>

<form action="{{ route('status.check') }}" method="post">
    @csrf
    <div class="container" style="width: 50%; margin: 0 auto">
        <h1 style="text-align: center" >Check Vaccination Status</h1>
        <hr>
        <input type="text" placeholder="Enter Your NID" name="nid" required>
        <hr>
        <button type="submit" class="search_btn">Search</button>
    </div>
</form>
</body>
</html>
