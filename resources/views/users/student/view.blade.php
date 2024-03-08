<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <ul>
                @foreach ($studentNames as $studentName)
                    <li>{{ $studentName }}</li>
                @endforeach
            </ul>
        </div>
    </div>

</x-app-layout>
