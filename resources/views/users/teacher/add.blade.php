<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Institution') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('institution.store.teacher', ['id' => $id]) }}" method="post">
                @csrf
                <div>
                    <label>Select Teacher:</label>
                    {{-- {{ dd($teachers) }} --}}
                    @foreach ($teachers as $teacher)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="teacher_ids[]"
                                value="{{ $teacher->id }}" id="subject_{{ $teacher->id }}"
                                {{ $selectedTeachers->contains('id', $teacher->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="subject_{{ $teacher->id }}">
                                {{ $teacher->name }}
                            </label>
                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-outline-secondary"
                        onclick="return confirm('Are you sure you want to add?')">Add Selected Teachers</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
