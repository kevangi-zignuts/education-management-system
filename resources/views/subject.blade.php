<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subjects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('subject.store') }}" method="post">
                @csrf
                <div class="d-flex">
                    {{-- <x-input-label for="name" :value="__('Add a new Subject ')" /> --}}
                    <x-text-input id="subject_name" class="block mt-1 w-50 " type="text" name="subject_name"
                        :value="old('subject_name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <button type="submit" class="btn btn-outline-secondary"
                        onclick="return confirm('Are you sure you want to add?')">Add a New Subject</button>
                </div>
            </form>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Subject Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <th scope="row">{{ $subject->subject_name }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
