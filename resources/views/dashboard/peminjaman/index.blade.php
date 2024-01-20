<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Peminjaman') }}
        </h2>
    </x-slot>
  
    <div class="space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <form action="/dashboard/peminjaman/inputkodepinjam" method="post" class="flex flex-col">
                @csrf
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 mb-3">
                    <div class="w-full md:w-1/2">
                        <x-form.label class="mb-3" for="peminjaman" :value="__('Peminjaman')" />
                        <x-form.input placeholder="Kode..." id="peminjaman" name="kode" type="text" class="block w-full" required />
                        <x-form.error :messages="$errors->get('kode')" />
                    </div>
                    <x-button type="submit" variant="primary" class="self-end flex-shrink-0">
                        <span>Submit</span>
                    </x-button>
                </div>
            </form>
        
            <form action="/dashboard/peminjaman/inputkodepengembalian" method="post" class="flex flex-col">
                @csrf
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 mb-3">
                    <div class="w-full md:w-1/2">
                        <x-form.label class="mb-3" for="pengembalian" :value="__('Pengembalian')" />
                        <x-form.input placeholder="Kode..." id="pengembalian" name="kode" type="text" class="block w-full" required />
                        <x-form.error :messages="$errors->get('kode')" />
                    </div>
                    <x-button type="submit" variant="primary" class="self-end flex-shrink-0">
                        <span>Submit</span>
                    </x-button>
                </div>
            </form>
            <div class="report flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 mb-3 justify-end">
                <x-button class="self-end flex-shrink-0" variant="success" x-data="" x-on:click.prevent="$dispatch('open-modal', 'generate-laporan')">
                {{ __('Generate laporan') }}
                </x-button>
                <x-modal name="generate-laporan" :show="$errors->generateLaporan->isNotEmpty()" focusable>
                    <form method="post" action="/dashboard/generate_laporan" class="p-6">
                        @csrf
                        <h2 class="text-lg font-medium">
                            {{ __('Generate laporan peminjaman buku') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Generate laporan peminjaman buku berdasarkan rentang waktu yang ditentukan.') }}
                        </p>

                        <div class="mt-6 space-y-6">
                            <x-form.label for="dari" value="Dari" class="sr-only"/>
                            <x-form.input
                                id="dari"
                                name="dari"
                                type="date"
                                class="block w-3/4"
                                placeholder="Dari"
                            />
                            <x-form.error :messages="$errors->generateLaporan->get('dari')" />
                        </div>

                        <div class="mt-6 space-y-6">
                            <x-form.label for="sampai" value="Sampai" class="sr-only"/>
                            <x-form.input
                                id="sampai"
                                name="sampai"
                                type="date"
                                class="block w-3/4"
                                placeholder="Sampai"
                            />
                            <x-form.error :messages="$errors->generateLaporan->get('sampai')" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-button
                                type="button"
                                variant="secondary"
                                x-on:click="$dispatch('close')"
                            >
                                {{ __('Cancel') }}
                            </x-button>

                            <x-button
                                variant="success"
                                class="ml-3"
                            >
                                {{ __('Generate laporan') }}
                            </x-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
        
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-full overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Sampul</th>
                    <th>Kode peminjaman</th>
                    <th>Tgl peminjaman</th>
                    <th>Tgl kembali</th>
                    <th>Dikembalikan</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($peminjamans as $peminjaman)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>
                        <img width="50" src="{{ asset('storage/' . $peminjaman->buku->sampul) }}" alt="">
                    </td>
                    <td>{{ $peminjaman->kode }}</td>
                    <td>{{ $peminjaman->tgl_peminjaman }}</td>
                    <td>{{ $peminjaman->tgl_kembali }}</td>
                    <td>{{ $peminjaman->dikembalikan == null ? '-' : $peminjaman->dikembalikan}}</td>
                    <td>
                        @if ($peminjaman->status == 'diproses')
                            <span class="badge badge-warning text-white">{{ $peminjaman->status }}</span>
                        @elseif($peminjaman->status == 'dipinjam')
                            <span class="badge badge-info text-white">{{ $peminjaman->status }}</span>
                        @else
                            <span class="badge badge-success text-white">{{ $peminjaman->status }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex">
                            <x-button href="/dashboard/peminjaman/{{ Crypt::encryptString($peminjaman->id) }}" variant="primary">
                                <i class="fa-solid fa-eye"></i>
                            </x-button>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="mt-5 justify-center">
                {{ $peminjamans->links() }}
              </div> 
        </div>    
    </div>
</x-app-layout>
  