<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container bg-white p-6">
                <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('institution.index') }}"
                    role="button"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="card shadow-lg p-3 m-3 mt-0 bg-white border-0 rounded">
                    <div class="card-body">
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
    </div>

</x-app-layout>
