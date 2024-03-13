<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container bg-white p-6">
                {{-- <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="container bg-white p-6">
                        <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('subject.index') }}"
                            role="button"><i class="fa-solid fa-arrow-left"></i></a>
                        <div class="card shadow-lg p-3 m-3 mt-0 bg-white border-0 rounded">
                            <div class="card-body">
                                <h3 class="card-title h3">Provide a list of students who have learned the
                                    {{ $subject }}
                                    Subject
                                </h3>
                                <ul class="m-6">
                                    @foreach ($students as $student)
                                        <li class="h5" style="list-style-type: disc">{{ $student->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
                <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('user.student.index') }}"
                    role="button"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="card shadow-lg p-3 m-3 bg-white border-0 rounded">
                    <div class="card-body">
                        <h3 class="h2 m-6">Here is the Details of {{ $user->name }} :- </h3>
                        <ol class="m-6 pl-6 h5" style="list-style-type: decimal">
                            <li class="p-2">Name :- {{ $user->name }}</li>
                            <li class="p-2">Email :- {{ $user->email }}</li>
                            <li class="p-2">Role :- {{ $user->role }}</li>
                            <li class="p-2">
                                Studied in class {{ $user->class }}
                            </li>
                            {{-- @if ($user->institute_id !== null) --}}
                            <li class="p-2">{{ $user->name }} Studied a following subjects :-
                                <div class="row m-2">
                                    @foreach ($user->subject as $subject)
                                        <div class="col-4 p-2">
                                            <p>{{ $subject->subject_name }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ol>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
