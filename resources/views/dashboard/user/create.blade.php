<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah user baru') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-4xl">
                <form action="/dashboard/user" method="post">
                    @csrf
                    <div class="space-y-2 mb-3">
                        <x-form.label for="nama_lengkap" :value="__('Nama lengkap')" />
                        <x-form.input id="nama_lengkap" name="nama_lengkap" type="text" class="block w-full"
                            :value="old('nama_lengkap')" required />
                        <x-form.error :messages="$errors->get('nama_lengkap')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="username" :value="__('Username')" />
                        <x-form.input id="username" name="username" type="text" class="block w-full"
                            :value="old('username')" required />
                        <x-form.error :messages="$errors->get('username')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="email" :value="__('Email')" />
                        <x-form.input id="email" name="email" type="email" class="block w-full"
                            :value="old('email')" required />
                        <x-form.error :messages="$errors->get('email')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="alamat" :value="__('Alamat')" />
                        <x-form.input id="alamat" name="alamat" type="text" class="block w-full"
                            :value="old('alamat')" required />
                        <x-form.error :messages="$errors->get('alamat')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="role" :value="__('Role')" />
                        <select name="role" required value="{{ old('role') }}" class="block w-full border-gray-400 mt-1 text-sm dark:text-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="petugas">Petugas</option>
                            <option value="administrator">Administrator</option>
                        </select>
                        <x-form.error :messages="$errors->get('role')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="password" :value="__('Password')" />
                        <x-form.input id="password" name="password" type="password" class="block w-full"
                            :value="old('password')" required />
                        <x-form.error :messages="$errors->get('password')" />
                    </div>
                    <x-button type="submit" variant="primary">
                        <span>Submit</span>
                    </x-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
