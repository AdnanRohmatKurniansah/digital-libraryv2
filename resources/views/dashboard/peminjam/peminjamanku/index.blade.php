<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Peminjamanku') }}
        </h2>
    </x-slot>
  
    <div class="space-y-6">
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
                    {{-- <td>
                      <div class="flex">
                          <x-button href="/dashboard/peminjaman/{{ Crypt::encryptString($peminjaman->id) }}" variant="primary">
                              <i class="fa-solid fa-eye"></i>
                          </x-button>
                          <x-button class="ml-3" x-data="" x-on:click.prevent="$dispatch('open-modal', 'ulas{{ $peminjaman->id }}')" variant="success">
                            <i class="fa-solid fa-star"></i>
                          </x-button>
                          <x-modal name="ulas{{ $peminjaman->id }}" :show="$errors->isNotEmpty()" focusable>
                            <form method="post" action="/dashboard/ulasan" class="p-6">
                                @csrf
                                <h2 class="text-lg font-medium">
                                    {{ __('Beri ulasan ke buku') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Masukkan ulasan anda tentang buku ini') }}
                                </p>
                                <div class="mt-6 space-y-6">
                                  <input type="hidden" name="id_buku" value="{{ $peminjaman->buku->id }}">
                                  <div class="rating">
                                      <input type="radio" id="star5" name="rating" value="5" />
                                      <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                      <input type="radio" id="star4" name="rating" value="4" />
                                      <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                      <input type="radio" id="star3" name="rating" value="3" />
                                      <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                      <input type="radio" id="star2" name="rating" value="2" />
                                      <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                      <input type="radio" id="star1" name="rating" value="1" checked />
                                      <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                  </div>
                                  <div class="form">
                                      <textarea placeholder="Ulasan..." id="ulasan" name="ulasan" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 leading-6 transition-colors duration-200 ease-in-out">{{ old('ulasan') }}</textarea>
                                      <x-form.error :messages="$errors->get('ulasan')" />
                                  </div>
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
                                        {{ __('Submit') }}
                                    </x-button>
                                </div>
                            </form>
                          </x-modal>
                      </div>
                    </td> --}}  
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
  