<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('user.create') }}" class="btn btn-outline-secondary">Add a New User</a>
            @if (session('success'))
                <div id="error-alert" class="alert alert-success m-4">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
