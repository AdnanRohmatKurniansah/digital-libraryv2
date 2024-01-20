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
  