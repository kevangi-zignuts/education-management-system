<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Institution') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary mb-3 rounded-circle p-2" href="{{ route('institution') }}" role="button"><i
                            class="fa-solid fa-arrow-left"></i></a>
                    <form action="{{ route('institution.store.teacher', ['id' => $id]) }}" method="post">
                        @csrf
                        <label class="h4 p-6">Select Teacher :- </label>
                        <div class="row ml-6">
                            @foreach ($teachers as $teacher)
                                <div class="form-check col-4">
                                    <input class="form-check-input" type="checkbox" name="teacher_ids[]"
                                        value="{{ $teacher->id }}" id="subject_{{ $teacher->id }}"
                                        {{ $selectedTeachers->contains('id', $teacher->id) ? 'checked' : '' }}>
                                    <label class="form-check-label h5" for="subject_{{ $teacher->id }}">
                                        {{ $teacher->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-outline-secondary m-6"
                            onclick="return confirm('Are you sure you want to add?')">Add Selected Teachers</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
