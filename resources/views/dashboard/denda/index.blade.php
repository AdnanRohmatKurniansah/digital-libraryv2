<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Denda') }}
        </h2>
    </x-slot>
  
    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-full overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Kode peminjaman</th>
                    <th>Nama peminjam</th>
                    <th>Dikembalikan</th>
                    <th>Nominal</th>
                    <th>Dibayar</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dendas as $denda)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $denda->peminjaman->kode }}</td>
                    <td>{{ $denda->peminjaman->user->nama_lengkap }}</td>
                    <td>{{ $denda->peminjaman->dikembalikan}}</td>
                    <td>Rp. {{ number_format($denda->nominal, 0, ',', '.') }}</td>
                    <td>Rp. {{ $denda->dibayar != null ? number_format($denda->dibayar, 0, ',', '.') : '0'}}</td>
                    <td>
                        @if ($denda->status == 'blm-lunas')
                            <span class="badge badge-warning text-white">{{ $denda->status }}</span>
                        @else
                            <span class="badge badge-success text-white">{{ $denda->status }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-4">
                            @if ($denda->status == 'lunas')
                                <x-button disabled class="self-end flex-shrink-0" variant="success">
                                    {{ __('Sudah dibayar') }}
                                </x-button>
                            @else
                                <x-button class="self-end flex-shrink-0" variant="primary" x-data="" x-on:click.prevent="$dispatch('open-modal', 'bayar-denda')">
                                    {{ __('Bayar') }}
                                </x-button>
                            @endif
                            <x-modal name="bayar-denda" :show="$errors->isNotEmpty()" focusable>
                                <form method="post" action="/dashboard/denda/{{ $denda->id }}" class="p-6">
                                    @csrf
                                    @method('put')
                                    <h2 class="text-lg font-medium">
                                        {{ __('Membayar denda peminjaman') }}
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Isikan nominal untuk membayar denda peminjaman buku.') }}
                                    </p>
            
                                    <div class="mt-6 space-y-6">
                                        <x-form.label for="dibayar" value="Dibayar" class="sr-only"/>
                                        <x-form.input
                                            id="dibayar"
                                            name="dibayar"
                                            min="1"
                                            type="number"
                                            value="{{ old('dibayar', $denda->dibayar) }}"
                                            class="block w-3/4"
                                            placeholder="Dibayar"
                                        />
                                        <x-form.error :messages="$errors->get('dibayar')" />
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
                                            {{ __('Bayar') }}
                                        </x-button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="mt-5 justify-center">
                {{ $dendas->links() }}
              </div> 
        </div>    
    </div>
</x-app-layout>
  