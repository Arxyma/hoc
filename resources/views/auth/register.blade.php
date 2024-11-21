<x-guest-layout>
    <section class="flex flex-col justify-center items-center h-full">
        <div class="text-center">
            <div class="text-5xl font-bold">Hall Of Community</div>
            <div class="text-3xl mt-2">Daftar Akun</div>
        </div>
        <form method="POST" action="{{ route('register') }}" class="max-w-md w-full mt-5">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama')" class="text-white" />
                <x-text-input id="name" class="block mt-1 w-full text-black placeholder:text-neutral-400"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Masukkan nama Anda" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-1 w-full text-black placeholder:text-neutral-400"
                    type="email" name="email" :value="old('email')" required autocomplete="username"
                    placeholder="Masukkan email Anda" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-white" />

                <x-text-input id="password" class="block mt-1 w-full text-black placeholder:text-neutral-400"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="Masukkan password Anda" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-white" />

                <x-text-input id="password_confirmation"
                    class="block mt-1 w-full text-black placeholder:text-neutral-400" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Masukkan konfirmasi password Anda" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-2 items-center justify-center mt-6">
                <x-primary-button
                    class="bg-orange-400 hover:bg-orange-300 transition-colors duration-300 !rounded-full font-bold px-6 py-2">
                    {{ __('Register') }}
                </x-primary-button>
                <a class="underline text-sm hover:text-neutral-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah mendaftar?') }}
                </a>
            </div>
        </form>
    </section>
</x-guest-layout>
