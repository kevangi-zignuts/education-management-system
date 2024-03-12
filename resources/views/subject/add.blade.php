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
                {{ __('Add Subject') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="container bg-white p-6">
                    @php
                        $route = $user->role === 'Teacher' ? 'user.teacher.index' : 'user.student.index';
                    @endphp
                    <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route($route) }}" role="button">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>

                    <div class="card shadow-lg p-3 m-3 mt-0 bg-white border-0 rounded">
                        <div class="card-body">
                            <form action="{{ route('user.subject.store', ['id' => $user->id]) }}" method="post">
                                @csrf
                                <label class="h4 p-6">Select Subjects:-</label>
                                <div class="row ml-6">
                                    @foreach ($subjects as $subject)
                                        <div class="form-check col-4">
                                            @if (in_array($subject->id, $userSubjectIds))
                                                <input class="form-check-input" type="checkbox" name="subjects[]"
                                                    value="{{ $subject->id }}" id="subject_{{ $subject->id }}"
                                                    checked>
                                                <label class="form-check-label h5" for="subject_{{ $subject->id }}">
                                                    {{ $subject->subject_name }}
                                                </label>
                                            @else
                                                <input class="form-check-input" type="checkbox" name="subjects[]"
                                                    value="{{ $subject->id }}" id="subject_{{ $subject->id }}">
                                                <label class="form-check-label h5" for="subject_{{ $subject->id }}">
                                                    {{ $subject->subject_name }}
                                                </label>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-outline-secondary m-6"
                                    onclick="return confirm('Are you sure you want to add?')">Add Selected
                                    Subjects</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>

</body>

</html>
