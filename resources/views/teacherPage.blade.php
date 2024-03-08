<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teachers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Teacher Name</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td scope="row">{{ $teacher->name }}</td>
                            <td><a href="{{ route('subject.add', ['id' => $teacher->id]) }}">Add a subject</a></td>
                            <td><a href="{{ route('subject.view', ['id' => $teacher->id]) }}">View a subject</a></td>
                            <td><a href="{{ route('user.add.institute', ['id' => $teacher->id]) }}">Add a institute</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
