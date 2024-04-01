<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl leading-tight">
          {{ __('Data buku') }}
      </h2>
  </x-slot>

  <div class="space-y-6">
      <x-button href="/dashboard/buku/create" variant="primary">
        <span>Tambah buku baru</span>
      </x-button>
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
          <div class="max-w-full overflow-x-auto">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Judul</th>
                  <th>Sampul</th>
                  <th>Kategori</th>
                  <th>Penulis</th>
                  <th>Penerbit</th>
                  <th>Jumlah</th>
                  <th>Tahun terbit</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bukus as $buku)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $buku->judul }}</td>
                  <td>
                    <img width="50" src="{{ $buku->sampul }}" alt="">
                  </td>
                  <td>{{ implode(', ', $buku->kategoris->pluck('nama')->toArray()) }}</td>
                  <td>{{ $buku->penulis }}</td>
                  <td>{{ $buku->penerbit }}</td>
                  <td>{{ $buku->jumlah }}</td>
                  <td>{{ $buku->tahun_terbit }}</td>
                  <td>
                    <div class="flex gap-4">
                      <x-button href="/dashboard/buku/{{ Crypt::encryptString($buku->id) }}/edit" variant="success">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </x-button>
                      <form action="/dashboard/buku/{{ $buku->id }}" method="post">
                        @csrf
                        @method('delete')
                        <x-button variant="danger" onclick="return confirm('Hapus buku ini?')">
                          <i class="fa-solid fa-trash"></i>
                        </x-button>
                      </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="mt-5 justify-center">
            {{ $bukus->links() }}
          </div> 
      </div>    
  </div>
</x-app-layout>
