<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Registration</title>
    <link href="{{ asset('/css/registration.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="width: 50%; margin: 0 auto">
    <!-- Display success message -->
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('registration.store') }}" method="POST">
        @csrf
        <div class="container">
            <h1 style="text-align: center">Vaccination Registration</h1>
            <hr>

            <label for="name"><b>Name</b> <span class="error" >*</span></label>
            <input type="text" placeholder="Enter Your Name" name="name" id="name" required>
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="nid"><b>NID</b> <span class="error" >*</span></label>
            <input type="text" placeholder="Enter Your NID" name="nid" id="nid" required>
            @error('nid')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Your Email" name="email" id="email" >
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="address"><b>Address</b></label>
            <input type="text" placeholder="Enter Your Address" name="address" id="address" >
            @error('address')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="email"><b>Vaccine center</b> <span class="error" >*</span></label>
            <select name="vaccine_center" id="vaccine_center" class="form-select @error('vaccine_center') is-invalid @enderror" required>
                <option value="">Select a Vaccine center</option>
                @foreach($centers as $center)
                    <option value="{{ $center->id }}">{{ $center->name }}</option>
                @endforeach
            </select>
            @error('vaccine_center')
            <div class="error">{{ $message }}</div>
            @enderror
            <hr>
            <button type="submit" class="register_btn">Register</button>
        </div>
    </form>
</div>
</body>
</html>
