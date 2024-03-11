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
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('View Teacher') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card">
                    <div class="card-body">
                        @if (isset($subject))
                            <h3 class="card-title h3">Provide a list of teachers who have taught the {{ $subject }}
                                Subject
                            </h3>
                        @else
                            <h3 class="card-title h3">Following teachers are taught in the
                                {{ $institute->institute_name }}
                                Institute :-
                            </h3>
                        @endif
                        <ul class="m-6">
                            @foreach ($teachers as $teacher)
                                <li class="h5" style="list-style-type: disc">{{ $teacher->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
</body>

</html>
