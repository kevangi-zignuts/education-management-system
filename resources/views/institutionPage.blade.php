<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Institution') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('institution.store') }}" method="post">
                @csrf
                <div class="d-flex">
                    <x-text-input id="institute_name" class="block mt-1 w-50 " type="text" name="institute_name"
                        :value="old('institute_name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <button type="submit" class="btn btn-outline-secondary"
                        onclick="return confirm('Are you sure you want to add?')">Add a New Institute</button>
                </div>
            </form>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Institution Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($institutions as $institution)
                        <tr>
                            <td scope="row">{{ $institution->institute_name }}</td>
                            <td><a href="{{ route('institution.add.teacher', ['id' => $institution->id]) }}">Add
                                    Teachers</a>
                            </td>
                            <td><a href="{{ route('institution.view.teacher', ['id' => $institution->id]) }}">View
                                    Teachers</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</x-app-layout>
