<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subjects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Subjects') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form action="{{ route('subject.store') }}" method="post" class="form-inline justify-center">
                    @csrf
                    <div class="form-group col-sm-10">
                        <x-text-input id="subject_name" class="form-control-lg w-75 m-3" type="text"
                            name="subject_name" :value="old('subject_name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <button type="submit" class="btn btn-outline-secondary"
                            onclick="return confirm('Are you sure you want to add?')">Add a New Subject</button>
                    </div>
                </form>
                @if (session('success'))
                    <div id="error-alert" class="alert alert-success m-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->has('subject_name'))
                    <div class="alert alert-danger m-4" id="error-alert">
                        {{ $errors->first('subject_name') }}
                    </div>
                @endif
                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger m-4">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table m-4 text-center h5">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="p-3">Subject Name</th>
                            <th class="p-3">Actions</th>
                            {{-- <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if ($subjects->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-danger">No Data Available</td>
                            </tr>
                        @else
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td scope="row" class="p-3">{{ $subject->subject_name }}</td>
                                    <td class="p-3"><a
                                            href="{{ route('subject.view.teacher', ['id' => $subject->id]) }}"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><i
                                                class="fa-solid fa-eye"></i> View
                                            Teachers</a>
                                        <a href="{{ route('subject.view.student', ['id' => $subject->id]) }}"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pl-6"><i
                                                class="fa-solid fa-eye"></i> View
                                            Students</a>
                                        <form action="{{ route('subject.delete', ['id' => $subject->id]) }}"
                                            method="post" class="d-inline ml-6">
                                            @csrf
                                            <button type="submit" class="btn-link"
                                                onclick="return confirm('Are you sure You want to delete User')"
                                                style="border: none; background: none;"><i
                                                    class="fa-solid fa-trash text-danger" data-bs-toggle="tooltip"
                                                    title="Delete Subject"></i></button>
                                        </form>
                                        <a href="{{ route('subject.edit', ['id' => $subject->id]) }}"
                                            class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pl-6"><i
                                                class="fa-solid fa-pen-to-square" data-bs-toggle="tooltip"
                                                title="Edit Subject"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $subjects->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </x-app-layout>

</body>

</html>
