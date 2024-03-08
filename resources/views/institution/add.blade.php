<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Institution') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('user.store.institute', ['id' => $id]) }}" method="post">
                @csrf
                <div>
                    <label>Select Institutions:</label>
                    <select class="form-control" name="institute">
                        @foreach ($institutions as $institution)
                            <option value="{{ $institution->id }}">{{ $institution->institute_name }}</option>
                            {{-- <input class="form-check-input" type="checkbox" name="subjects[]"
                                value="{{ $institution->id }}" id="subject_{{ $institution->id }}">
                            <label class="form-check-label" for="subject_{{ $institution->id }}">
                                {{ $institution->institute_name }}
                            </label> --}}
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-secondary"
                        onclick="return confirm('Are you sure you want to add?')">Add Selected Subjects</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
