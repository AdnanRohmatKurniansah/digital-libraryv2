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
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dendas as $denda)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $denda->peminjaman->kode }}</td>
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
  