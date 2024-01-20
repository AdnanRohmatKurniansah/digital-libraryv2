<x-guest-layout>
    <x-auth-card>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="left">
                    <div class="space-y-2 mb-3">
                        <x-form.label
                            for="nama_lengkap"
                            :value="__('Nama Lengkap')"/>
                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
    
                            <x-form.input
                                withicon
                                id="nama_lengkap"
                                class="block w-full"
                                type="text"
                                name="nama_lengkap"
                                :value="old('nama_lengkap')"
                                required
                                autofocus
                                placeholder="{{ __('Nama lengkap') }}"
                            />
                        </x-form.input-with-icon-wrapper>
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label
                            for="username"
                            :value="__('Username')"/>
                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
    
                            <x-form.input
                                withicon
                                id="username"
                                class="block w-full"
                                type="text"
                                name="username"
                                :value="old('username')"
                                required
                                autofocus
                                placeholder="{{ __('Username') }}"
                            />
                        </x-form.input-with-icon-wrapper>
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label
                            for="email"
                            :value="__('Email')"
                        />
    
                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
    
                            <x-form.input
                                withicon
                                id="email"
                                class="block w-full"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                placeholder="{{ __('Email') }}"
                            />
                        </x-form.input-with-icon-wrapper>
                    </div>
                </div>
                <div class="right">
                    <div class="space-y-2 mb-3">
                        <x-form.label
                            for="alamat"
                            :value="__('Alamat')"/>
                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
    
                            <x-form.input
                                withicon
                                id="alamat"
                                class="block w-full"
                                type="text"
                                name="alamat"
                                :value="old('alamat')"
                                required
                                autofocus
                                placeholder="{{ __('Alamat') }}"
                            />
                        </x-form.input-with-icon-wrapper>
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label
                            for="password"
                            :value="__('Password')"
                        />
                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
    
                            <x-form.input
                                withicon
                                id="password"
                                class="block w-full"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="{{ __('Password') }}"
                            />
                        </x-form.input-with-icon-wrapper>
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label
                            for="password_confirmation"
                            :value="__('Confirm Password')"
                        />
                        <x-form.input-with-icon-wrapper>
                            <x-slot name="icon">
                                <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                            </x-slot>
    
                            <x-form.input
                                withicon
                                id="password_confirmation"
                                class="block w-full"
                                type="password"
                                name="password_confirmation"
                                required
                                placeholder="{{ __('Confirm Password') }}"
                            />
                        </x-form.input-with-icon-wrapper>
                    </div>
                </div>

            </div>
            <div class="flex justify-center mt-4">
                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Register') }}</span>
                    </x-button>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
