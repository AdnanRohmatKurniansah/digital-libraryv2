<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Tambah kategori Baru') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-full">
                <form action="/dashboard/buku/kategori" method="post">
                    @csrf
                    <div class="space-y-2 mb-3">
                        <x-form.label for="nama" :value="__('Nama kategori')" />
                        <x-form.input id="nama" name="nama" type="text" class="block w-full"
                            :value="old('nama')" required />
                        <x-form.error :messages="$errors->get('nama')" />
                    </div>
                    <x-button type="submit" variant="primary">
                        <span>Submit</span>
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
