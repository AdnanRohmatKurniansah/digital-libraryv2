<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Data kategori') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <x-button href="/dashboard/buku/kategori/create" variant="primary">
          <span>Tambah kategori baru</span>
        </x-button>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-full overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Dibuat</th>
                    <th>Diupdate</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kategoris as $kategori)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>{{ $kategori->created_at->format('d M Y h:i') }}</td>
                    <td>{{ $kategori->updated_at->format('d M Y h:i') }}</td>
                    <td>
                      <div class="flex gap-4">
                        <x-button href="/dashboard/buku/kategori/{{ $kategori->id }}/edit" variant="success">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </x-button>
                        <form action="/dashboard/buku/kategori/{{ $kategori->id }}" method="post">
                          @csrf
                          @method('delete')
                          <x-button variant="danger" onclick="return confirm('Hapus kategori ini?')">
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
              {{ $kategoris->links() }}
            </div> 
        </div>    
    </div>
</x-app-layout>
