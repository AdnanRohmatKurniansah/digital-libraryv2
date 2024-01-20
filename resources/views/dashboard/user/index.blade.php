<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Data user') }}
        </h2>
    </x-slot>
  
    <div class="space-y-6">
        <x-button href="/dashboard/user/create" variant="primary">
          <span>Tambah user baru</span>
        </x-button>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-full overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Role</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama_lengkap }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>{{ $user->role }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="mt-5 justify-center">
              {{ $users->links() }}
            </div> 
        </div>    
    </div>
  </x-app-layout>
  