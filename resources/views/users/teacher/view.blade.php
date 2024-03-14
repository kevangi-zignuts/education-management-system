<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container bg-white p-6">
                {{-- @if (isset($subject))
                        <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('subject.index') }}"
                            role="button"><i class="fa-solid fa-arrow-left"></i></a>
                    @else
                        <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('institution.index') }}"
                            role="button"><i class="fa-solid fa-arrow-left"></i></a>
                    @endif
                    <div class="card shadow-lg p-3 m-3 mt-0 bg-white border-0 rounded">
                        <div class="card-body">
                            @if (isset($subject))
                                <h3 class="card-title h3">Provide a list of teachers who have taught the
                                    {{ $subject }} Subject
                                </h3>
                            @else<h3 class="card-title h3">Following teachers are taught in the
                                    {{ $institute->institute_name }} Institute
                                </h3>
                            @endif
                            <ul class="m-6">
                                @foreach ($teachers as $teacher)
                                    <li class="h5" style="list-style-type: disc">{{ $teacher->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2"
                    href="{{ route('user.index', ['role' => $user->role]) }}" role="button"><i
                        class="fa-solid fa-arrow-left"></i></a>
                <div class="card shadow-lg p-3 m-3 bg-white border-0 rounded">
                    <div class="card-body">
                        <h3 class="h2 m-6">Here is the Details of {{ $user->name }} :- </h3>
                        <ol class="m-6 pl-6 h5" style="list-style-type: decimal">
                            <li class="p-2">Name :- {{ $user->name }}</li>
                            <li class="p-2">Email :- {{ $user->email }}</li>
                            <li class="p-2">Role :- {{ $user->role }}</li>
                            <li class="p-2">
                                Class :- {{ $user->class }}
                            </li>
                            <li class="p-2">Institute :-
                                @if ($user->institute_id !== null)
                                    {{ $user->institute->institute_name }}
                                @endif
                            </li>
                            <li>Subjects :- </li>
                            <div class="row m-2">
                                @foreach ($user->subject as $subject)
                                    <div class="col-4 p-2">
                                        <p>{{ $subject->subject_name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
