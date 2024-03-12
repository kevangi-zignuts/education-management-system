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
            <div class="d-flex">
                <a class="btn btn-primary rounded-circle " href="{{ route('institution.index') }}" role="button"><i
                        class="fa-solid fa-arrow-left"></i></a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-4 mt-1">
                    {{ __('Edit Institution') }}
                </h2>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form action="{{ route('institution.update', [$institute->id]) }}" method="post"
                    class="form-inline justify-center">
                    @csrf
                    <div class="form-group col-sm-10">
                        <x-text-input id="institute_name" class="form-control-lg w-75 m-3" type="text"
                            name="institute_name" value="{{ $institute->institute_name }}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <button type="submit" class="btn btn-outline-secondary"
                            onclick="return confirm('Are you sure you want to add?')">Edit Institute</button>
                    </div>
                </form>
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
                @if ($errors->has('institute_name'))
                    <div class="alert alert-danger m-4" id="error-alert">
                        {{ $errors->first('institute_name') }}
                    </div>
                @endif
                <table class="table m-4 text-center h5">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="p-3">Institution Name</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($institutions as $institution)
                            <tr>
                                <td scope="row" class="p-3">{{ $institution->institute_name }}</td>
                                <td class="p-3">
                                    <a href="{{ route('institution.add.teacher', ['id' => $institution->id]) }}"
                                        class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pr-6"><i
                                            class="fa-solid fa-plus" data-bs-toggle="tooltip"
                                            title="Add Teacher"></i></a>
                                    <a href="{{ route('institution.view.teacher', ['id' => $institution->id]) }}"
                                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover pr-6"><i
                                            class="fa-solid fa-eye" data-bs-toggle="tooltip"
                                            title="View Teacher"></i></a>
                                    <form action="{{ route('institution.delete', ['id' => $institution->id]) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-link"
                                            onclick="return confirm('Are you sure You want to delete User')"
                                            style="border: none; background: none;"><i
                                                class="fa-solid fa-trash text-danger" data-bs-toggle="tooltip"
                                                title="Delete Institute"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $institutions->links('pagination::bootstrap-5') }}
            </div>

    </x-app-layout>
</body>

</html>
