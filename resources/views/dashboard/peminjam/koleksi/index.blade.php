<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Koleksi anda') }}
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
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Jumlah</th>
                    <th>Tahun terbit</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($koleksis as $koleksi)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $koleksi->buku->judul }}</td>
                    <td>
                      <img width="50" src="{{ $koleksi->buku->sampul }}" alt="">
                    </td>
                    <td>{{ implode(', ', $koleksi->buku->kategoris->pluck('nama')->toArray()) }}</td>
                    <td>{{ $koleksi->buku->penulis }}</td>
                    <td>{{ $koleksi->buku->penerbit }}</td>
                    <td>{{ $koleksi->buku->jumlah }}</td>
                    <td>{{ $koleksi->buku->tahun_terbit }}</td>
                    <td>
                      <div class="flex gap-4">
                        <form action="/dashboard/koleksi/{{ $koleksi->id }}" method="post">
                          @csrf
                          @method('delete')
                          <x-button variant="danger" onclick="return confirm('Hapus buku ini dari koleksi anda?')">
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
              {{ $koleksis->links() }}
            </div> 
        </div>    
    </div>
  </x-app-layout>
  