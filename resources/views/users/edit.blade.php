@include('layouts.navigation')
<x-guest-layout>
    <a class="btn btn-primary mb-3 rounded-circle p-2" href="{{ route('user.index', ['role' => $user->role]) }}"
        role="button"><i class="fa-solid fa-arrow-left"></i></a>
    <form method="POST" action="{{ route('user.update', [$user->id]) }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                value="{{ $user->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                value="{{ $user->email }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- class --}}
        <div class="mt-4">
            <x-input-label for="class" :value="__('Class')" />

            <x-text-input id="class" class="block mt-1 w-full" type="text" name="class"
                value="{{ $user->class }}" required />

            <x-input-error :messages="$errors->get('class')" class="mt-2" />

        </div>

        {{-- Users role --}}
        <div class="mt-4">
            <x-input-label for="users_role" :value="__('Role')" />

            <select name="role" class="form-control" required>
                <option value="Teacher" {{ $user->role === 'Teacher' ? 'selected' : '' }}> Teacher</option>
                <option value="Student" {{ $user->role === 'Student' ? 'selected' : '' }}>Student</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
