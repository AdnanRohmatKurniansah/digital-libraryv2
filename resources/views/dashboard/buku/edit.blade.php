<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Edit buku') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-4xl">
                <form action="/dashboard/buku/{{ $buku->id }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="space-y-2 mb-3">
                        <x-form.label for="judul" :value="__('Judul')" />
                        <x-form.input id="judul" name="judul" type="text" class="block w-full"
                            :value="old('judul', $buku->judul)" required />
                        <x-form.error :messages="$errors->get('judul')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="deskripsi" :value="__('Deskripsi')" />
                        <textarea class="textarea w-full textarea-bordered" name="deskripsi" required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        <x-form.error :messages="$errors->get('deskripsi')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="id_kategories" :value="__('Kategori')" />
                        @php
                            $selectedId_Kategori = $buku->kategoris->pluck('id')->toArray();
                        @endphp
                        @foreach ($kategoris as $kategori)
                        <div class="flex items-center">
                            <input id="kategori_{{ $kategori->id }}" class="form-checkbox h-5 w-5 text-indigo-600 @error('id_kategories') is-invalid @enderror" type="checkbox" name="id_kategories[]" value="{{ $kategori->id }}" @checked(in_array($kategori->id, $selectedId_Kategori))>
                            <label for="kategori_{{ $kategori->id }}" class="ml-2 text-sm text-gray-600">{{ $kategori->nama }}</label>
                        </div>
                        @error('id_kategories')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                        @endforeach
                        <x-form.error :messages="$errors->get('id_kategories')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="penulis" :value="__('Penulis')" />
                        <x-form.input id="penulis" name="penulis" type="text" class="block w-full"
                            :value="old('penulis', $buku->penulis)" required />
                        <x-form.error :messages="$errors->get('penulis')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="penerbit" :value="__('Penerbit')" />
                        <x-form.input id="penerbit" name="penerbit" type="text" class="block w-full"
                            :value="old('penerbit', $buku->penerbit)" required />
                        <x-form.error :messages="$errors->get('penerbit')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="tahun_terbit" :value="__('Tahun terbit')" />
                        <x-form.input id="tahun_terbit" name="tahun_terbit" type="number" class="block w-full"
                            :value="old('tahun_terbit', $buku->tahun_terbit)" required />
                        <x-form.error :messages="$errors->get('tahun_terbit')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="jumlah" :value="__('Jumlah')" />
                        <x-form.input id="jumlah" name="jumlah" type="number" class="block w-full"
                            :value="old('jumlah', $buku->jumlah)" required />
                        <x-form.error :messages="$errors->get('jumlah')" />
                    </div>
                    <div class="space-y-2 mb-3">
                        <x-form.label for="sampul" :value="__('Sampul')" />
                        @if ($buku->sampul)
                            <img src="{{ $buku->sampul }}" class="sampul-preview mb-3" style="max-width: 200px">
                        @else
                            <img class="sampul-preview mb-3" style="max-width: 200px">
                        @endif
                        <div class="relative">
                            <input value="{{ old('sampul') }}" id="sampul" name="sampul" type="file" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" onchange="previewSampul()" />
                        </div>
                        <x-form.error :messages="$errors->get('sampul')" />
                    </div>
                    <x-button type="submit" variant="primary">
                        <span>Submit</span>
                    </x-button>
                </form>
            </div>
        </div>
    </div>

<script>
    function previewSampul() {
      const sampul = document.querySelector('#sampul');
      const sampulPreview = document.querySelector('.sampul-preview');
      sampulPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(sampul.files[0]);
      oFReader.onload = function(oFREvent) {
        sampulPreview.src = oFREvent.target.result;
      }
    }
</script>

</x-app-layout>
