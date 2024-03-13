@include('layouts.navigation')
<x-guest-layout>
    <a class="btn btn-primary mb-3 rounded-circle p-2" href="{{ route('dashboard') }}" role="button"><i
            class="fa-solid fa-arrow-left"></i></a>
    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- class --}}
        <div class="mt-4">
            <x-input-label for="class" :value="__('Class')" />

            <x-text-input id="class" class="block mt-1 w-full" type="text" name="class" required />

            <x-input-error :messages="$errors->get('class')" class="mt-2" />
        </div>

        {{-- Users role --}}
        <div class="mt-4">
            <x-input-label for="users_role" :value="__('Role')" />

            <select name="role" class="form-control" required>
                <option value="" disabled selected>Choose...</option>
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
