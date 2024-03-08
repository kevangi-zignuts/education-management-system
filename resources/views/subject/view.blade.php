<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Subject') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p>{{ $user->role }}: {{ $user->name }}</p>

            <ul>
                @foreach ($subjects as $subject)
                    <li>{{ $subject->subject_name }}</li>
                @endforeach
            </ul>
        </div>
    </div>

</x-app-layout>
