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
                {{ __('Teachers') }}
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
                            <th scope="col" class="p-3">Teacher Name</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($teachers->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-danger">No Data Available</td>
                            </tr>
                        @else
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td scope="row" class="p-3">{{ $teacher->name }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('user.add.institute', ['id' => $teacher->id]) }}"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pr-6">Add
                                            a institute</a>
                                        <a href="{{ route('user.subject.add', ['id' => $teacher->id]) }}"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pr-6">Add
                                            a subject</a>
                                        <a href="{{ route('user.subject.view', ['id' => $teacher->id]) }}"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><i
                                                class="fa-solid fa-eye" data-bs-toggle="tooltip"
                                                title="View Subject"></i></a>
                                        <form action="{{ route('user.delete', ['id' => $teacher->id]) }}" method="post"
                                            class="d-inline ml-6">
                                            @csrf
                                            <button type="submit" class="btn-link"
                                                onclick="return confirm('Are you sure You want to delete User')"
                                                style="border: none; background: none;" data-bs-toggle="tooltip"
                                                title="Delete Teacher"><i
                                                    class="fa-solid fa-trash text-danger"></i></button>
                                        </form>
                                        <a href="{{ route('user.edit', ['id' => $teacher->id]) }}"
                                            class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pl-6"><i
                                                class="fa-solid fa-pen-to-square" data-bs-toggle="tooltip"
                                                title="Edit Teacher"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $teachers->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </x-app-layout>

    {{-- <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script> --}}
</body>

</html>
