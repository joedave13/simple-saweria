<x-guest-layout>
    <div class="mb-3">
        You will send donation to <span class="font-bold">{{ $user->username }}</span>
    </div>

    <form action="" method="POST">
        @csrf

        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="message" :value="__('Message')" />
            <textarea name="message" id="message" rows="4"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Donate') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
