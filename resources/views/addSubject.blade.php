<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Subject') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="" method="post">
                @csrf
                <div class="d-flex">
                    <x-input-label for="name" :value="__('Add a new Subject ')" />
                    <select name="role" class="form-control" required>
                        @foreach ($subjects as $subject)
                            <option value="Teacher">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-secondary"
                        onclick="return confirm('Are you sure you want to add?')">Add a New Subject</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
