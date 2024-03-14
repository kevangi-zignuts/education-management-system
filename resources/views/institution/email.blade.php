<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .card {
            width: 75%
        }

        @media screen and (width <=600px) {
            .card {
                width: 100%;
            }
        }
    </style>
</head>

{{-- <body class="bg-slate-500" style="background: rgb(212, 210, 210)"> --}}

<body style="background: rgb(212, 210, 210)">
    <div class="container mx-auto mt-5">
        <div class="card mx-auto mx-100 p-3">
            <div class="card-body">
                <p class="heading h4">Welcome, {{ $name }} </p>
                <p class="mb-5 mt-3">Thanks for choosing {{ $instituteName }} ! We are happy to see you on board.</p>
                <div class="text-div border-top mw-100">
                    <p class="pt-3 text-muted mb-0">Best regards,<br> {{ $instituteName }} </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
