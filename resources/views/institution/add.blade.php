<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Institution') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary rounded-circle p-2" href="{{ route('teacher') }}" role="button"><i
                            class="fa-solid fa-arrow-left"></i></a>
                    <form action="{{ route('user.store.institute', ['id' => $user->id]) }}" method="post">
                        @csrf
                        <div class="m-6">
                            <label class="h5 m-6">Choose an institute where {{ $user->name }} offers instruction :-
                            </label>
                            <select class="form-control ml-6 mr-6" name="institute">
                                @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id }}">{{ $institution->institute_name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-outline-secondary m-6"
                                onclick="return confirm('Are you sure you want to add?')">Add Selected
                                Institute</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
