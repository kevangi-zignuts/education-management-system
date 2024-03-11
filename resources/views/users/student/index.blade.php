<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Students') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('success'))
                    <div id="error-alert" class="alert alert-success m-4">
                        {{ session('success') }}
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
                            <th scope="col" class="p-3">Student Name</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td scope="row" class="p-3">{{ $student->name }}</td>
                                <td class="p-3">
                                    <a href="{{ route('subject.add', ['id' => $student->id]) }}"
                                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pr-6">Add
                                        a subject</a>
                                    <a href="{{ route('subject.view', ['id' => $student->id]) }}"
                                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pr-6">View
                                        a subject</a>
                                    <form action="{{ route('user.delete', ['id' => $student->id]) }}" method="post"
                                        class="d-inline ml-6">
                                        @csrf
                                        <button type="submit" class="btn-link"
                                            onclick="return confirm('Are you sure You want to delete User')"
                                            style="border: none; background: none;"><i
                                                class="fa-solid fa-trash text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </x-app-layout>
</body>

</html>
