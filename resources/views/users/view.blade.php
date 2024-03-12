<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <x-app-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="conatiner bg-white p-6">
                    <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('dashboard') }}"
                        role="button"><i class="fa-solid fa-arrow-left"></i></a>
                    <div class="card shadow-lg p-3 m-3 bg-white border-0 rounded">
                        <div class="card-body">
                            <h3 class="h2 m-6">Here is the Details of {{ $user->name }} :- </h3>
                            <ol class="m-6 pl-6 h5" style="list-style-type: decimal">
                                <li class="p-2">Name :- {{ $user->name }}</li>
                                <li class="p-2">Email :- {{ $user->email }}</li>
                                <li class="p-2">Role :- {{ $user->role }}</li>
                                <li class="p-2">
                                    {{ $user->role === 'Teacher' ? 'Taught' : 'Studied' }} in class {{ $user->class }}
                                </li>
                                @if ($user->institute_id !== null)
                                    <li class="p-2">He taught in institute {{ $user->institute->institute_name }}
                                    </li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
</body>

</html>
