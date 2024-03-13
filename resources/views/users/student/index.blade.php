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
                <a href="{{ route('user.create') }}" class="btn btn-secondary">Add a New User</a>
                <table class="table m-4 text-center h5">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="p-3">Student Name</th>
                            <th scope="col" class="p-3">Class</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($students->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-danger">No Data Available</td>
                            </tr>
                        @else
                            @foreach ($students as $student)
                                <tr>
                                    <td scope="row" class="p-3">{{ $student->name }}</td>
                                    <td scope="row" class="p-3">{{ $student->class }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('user.subject.add', ['id' => $student->id]) }}"
                                            class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><i
                                                class="fa-solid fa-plus" data-bs-toggle="tooltip"
                                                title="Add Subject"></i></a>
                                        <a href="{{ route('user.student.view', ['id' => $student->id]) }}"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pl-6"><i
                                                class="fa-solid fa-eye" data-bs-toggle="tooltip"
                                                title="View Student Details"></i></a>
                                        <form action="{{ route('user.delete', ['id' => $student->id]) }}" method="post"
                                            class="d-inline ml-6">
                                            @csrf
                                            <button type="submit" class="btn-link"
                                                onclick="return confirm('Are you sure You want to delete User')"
                                                style="border: none; background: none;"><i
                                                    class="fa-solid fa-trash text-danger" data-bs-toggle="tooltip"
                                                    title="Delete Student"></i></button>
                                        </form>
                                        <a href="{{ route('user.edit', ['id' => $student->id]) }}"
                                            class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pl-6"><i
                                                class="fa-solid fa-pen-to-square" data-bs-toggle="tooltip"
                                                title="Edit Student"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{-- <table class="table m-4 text-center h5">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="p-3">Student Name</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($students->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-danger">No Data Available</td>
                            </tr>
                        @else
                            @foreach ($students as $student)
                                <tr>
                                    <td scope="row" class="p-3">{{ $student->name }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('user.subject.add', ['id' => $student->id]) }}"
                                            class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><i
                                                class="fa-solid fa-plus" data-bs-toggle="tooltip"
                                                title="Add Subject"></i></a>
                                        <a href="{{ route('user.subject.view', ['id' => $student->id]) }}"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pl-6"><i
                                                class="fa-solid fa-eye" data-bs-toggle="tooltip"
                                                title="View Subject"></i></a>
                                        <form action="{{ route('user.delete', ['id' => $student->id]) }}"
                                            method="post" class="d-inline ml-6">
                                            @csrf
                                            <button type="submit" class="btn-link"
                                                onclick="return confirm('Are you sure You want to delete User')"
                                                style="border: none; background: none;"><i
                                                    class="fa-solid fa-trash text-danger" data-bs-toggle="tooltip"
                                                    title="Delete Student"></i></button>
                                        </form>
                                        <a href="{{ route('user.edit', ['id' => $student->id]) }}"
                                            class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pl-6"><i
                                                class="fa-solid fa-pen-to-square" data-bs-toggle="tooltip"
                                                title="Edit Student"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table> --}}
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </x-app-layout>
</body>

</html>
