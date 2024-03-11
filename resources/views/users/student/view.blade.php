<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <ul>
                @foreach ($students as $student)
                    <li>{{ $student->name }}</li>
                @endforeach
            </ul>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title h3">Provide a list of students who have learned the {{ $subject }}
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

</x-app-layout>
