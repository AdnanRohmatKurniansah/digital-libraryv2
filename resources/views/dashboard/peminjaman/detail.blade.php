<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Detail peminjaman') }}
        </h2>
    </x-slot>
  
    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-3xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-28">
                    <div class="book">
                        <h2 class="font-semibold text-lg leading-tight">
                            {{ __('Detail buku') }}
                        </h2>
                        <img class="mt-3 mb-5" style="max-height: 300px; min-width: 100%;" src="{{ $peminjaman->buku->sampul }}" alt="" srcset="">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col">
                                <h2 class="tracking-widest text-sm title-font mb-3">Judul: {{ $peminjaman->buku->judul }}</h2>
                                <h2 class="tracking-widest text-sm title-font mb-3">Kategori: {{ implode(', ', $peminjaman->buku->kategoris->pluck('nama')->toArray()) }}</h2>
                                <h2 class="tracking-widest text-sm title-font mb-3">Rating: {{ $peminjaman->buku->ulasans()->avg('rating') == null ? 'Belum ada yg memberikan penilaian' : number_format($peminjaman->buku->ulasans()->avg('rating'), 2) }}</h2>
                                <h2 class="tracking-widest text-sm title-font mb-3">Jumlah: {{ $peminjaman->buku->jumlah }}</h2>
                            </div>
                            <div class="col">
                                <h2 class="tracking-widest text-sm title-font mb-3">Tahun terbit: {{ $peminjaman->buku->tahun_terbit }}</h2>
                                <h2 class="tracking-widest text-sm title-font mb-3">Penulis: {{ $peminjaman->buku->penulis }}</h2>
                                <h2 class="tracking-widest text-sm title-font mb-3">Penerbit: {{ $peminjaman->buku->penerbit }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="peminjaman">
                        <h2 class="font-semibold text-lg leading-tight">
                            {{ __('Peminjaman') }}
                        </h2>
                        <h2 class="tracking-widest text-sm title-font my-3">Kode peminjaman: {{ $peminjaman->kode }}</h2>
                        <h2 class="tracking-widest text-sm title-font my-3">Nama peminjam: {{ $peminjaman->user->nama_lengkap }}</h2>
                        @php
                            $penanggung_jawab = \App\Models\User::find($peminjaman->penanggung_jawab);
                        @endphp
                        <h2 class="tracking-widest text-sm title-font my-3">Penanggung jawab: {{ $penanggung_jawab->nama_lengkap }}</h2>
                        <h2 class="tracking-widest text-sm title-font mb-3">Tanggal peminjaman: {{ $peminjaman->tgl_peminjaman }}</h2>
                        <h2 class="tracking-widest text-sm title-font mb-3">Tanggal kembali: {{ $peminjaman->tgl_kembali }}</h2>
                        <h2 class="tracking-widest text-sm title-font mb-3">Dikembalikan: {{ $peminjaman->dikembalikan == null ? '-' : $peminjaman->dikembalikan }}</h2>
                        <h2 class="tracking-widest text-sm title-font mb-3">Status: 
                        @if ($peminjaman->status == 'diproses')
                            <span class="badge badge-warning text-white">{{ $peminjaman->status }}</span>
                        @elseif($peminjaman->status == 'dipinjam')
                            <span class="badge badge-info text-white">{{ $peminjaman->status }}</span>
                        @else
                            <span class="badge badge-success text-white">{{ $peminjaman->status }}</span>
                        @endif
                        </h2>
                    </div>
                </div>
            </div> 
        </div>    
    </div>
</x-app-layout>
  