<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container">
        <div class="card m-6 w-100">
            <div class="card-body">
                <h1 class="heading">Welcome, {{ $name }}</h1>
                <p>Thanks for choosing {{ $name }}! We are happy to see you on board.</p>
                {{-- <p>Hello {{ $name }},</p> --}}
                {{-- <p>Welcome to the {{ $instituteName }}</p> --}}

                <div class="text-div">
                    <p>Best regards,</p>
                    {{ $instituteName }}
                </div>
                {{-- <div class="text-div">{{ $instituteName }} Team.</div> --}}
            </div>
        </div>
    </div>
</body>

</html>
