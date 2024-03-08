<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Institution') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <form action="{{ route('subject.store') }}" method="post">
                @csrf
                <div class="d-flex">
                    <x-text-input id="subject_name" class="block mt-1 w-50 " type="text" name="subject_name"
                        :value="old('subject_name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <button type="submit" class="btn btn-outline-secondary"
                        onclick="return confirm('Are you sure you want to add?')">Add a New Subject</button>
                </div>
            </form> --}}
            {{-- <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Subject Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td scope="row">{{ $subject->subject_name }}</td>
                            <td><a href="{{ route('subject.view.teacher', ['id' => $subject->id]) }}">View Teachers</a>
                            </td>
                            <td><a href="{{ route('subject.view.student', ['id' => $subject->id]) }}">View Students</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>

</x-app-layout>
