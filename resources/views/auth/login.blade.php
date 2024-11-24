<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="flex flex-col justify-center items-center h-full">
        <div class="text-center">
            <div class="text-5xl font-bold">Hall Of Community</div>
            <div class="text-3xl mt-2">Login Pengguna</div>
        </div>
        <form method="POST" action="{{ route('login') }}" class="max-w-md w-full mt-5">
            @csrf

            <div class="mb-2">Silakan login dengan akun Anda!</div>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-1 w-full text-black placeholder:text-neutral-400"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="Masukkan email Anda" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <x-text-input id="password" class="block mt-1 w-full text-black placeholder:text-neutral-400"
                    type="password" name="password" required autocomplete="current-password"
                    placeholder="Masukkan password Anda" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-neutral-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        name="remember">
                    <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col gap-2 items-center justify-center mt-6">
                <x-primary-button
                    class="bg-orange-400 hover:bg-orange-300 transition-colors duration-300 !rounded-full font-bold px-6 py-2">
                    {{ __('Log in') }}
                </x-primary-button>

                <a class="underline text-sm hover:text-neutral-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('register') }}">
                    {{ __('Belum memiliki akun? Daftar disini') }}
                </a>

                @if (Route::has('password.request'))
                    <a class="underline text-sm hover:text-neutral-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>
        </form>
    </section>
</x-guest-layout>
