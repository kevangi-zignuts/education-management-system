<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-12">
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
            </div>
        </div>
    </div>

</x-app-layout>
