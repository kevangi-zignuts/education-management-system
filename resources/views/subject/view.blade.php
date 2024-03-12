<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container bg-white p-6">
                @if ($user->role === 'Teacher')
                    <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('user.teacher.index') }}"
                        role="button"><i class="fa-solid fa-arrow-left"></i></a>
                @else
                    <a class="btn btn-primary ml-4 mb-3 rounded-circle p-2" href="{{ route('user.student.index') }}"
                        role="button"><i class="fa-solid fa-arrow-left"></i></a>
                @endif
                <div class="card shadow-lg p-3 m-1 bg-white border-0 rounded">
                    <div class="card-body">
                        @if ($user->role === 'Teacher')
                            <h3 class="card-title h3 mt-6 ml-6">{{ $user->name }} taught the following subjects :-
                            </h3>
                        @else
                            <h3 class="card-title h3 mt-6 ml-6">{{ $user->name }} learned the following subjects :-
                            </h3>
                        @endif
                        <div class="container">
                            <div class="row m-6">
                                @foreach ($subjects as $key => $subject)
                                    <div class="col-md-4 mb-3">
                                        <div class="custom-list-item">
                                            <span class="number h5">{{ $key + 1 }}. </span>
                                            <span class="subject h5">{{ $subject->subject_name }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
