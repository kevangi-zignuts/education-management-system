<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Subject') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    @if ($user->role === 'Teacher')
                        <h3 class="card-title h3 mt-6 ml-6">{{ $user->name }} taught the following subjects :- </h3>
                    @else
                        <h3 class="card-title h3 mt-6 ml-6">{{ $user->name }} learned the following subjects :- </h3>
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

</x-app-layout>
