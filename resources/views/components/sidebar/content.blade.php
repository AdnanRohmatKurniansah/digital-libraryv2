<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>
    @if (Auth::user()->role != 'peminjam')
    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    

    <x-sidebar.dropdown
        title="Data buku"
        :active="Str::startsWith(request()->route()->uri(), 'dashboard/buku')"
    >
        <x-slot name="icon">
            <x-heroicon-o-book-open class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Buku"
            href="/dashboard/buku"
            :active="Request::is('d ashboard/buku')"
        />
        <x-sidebar.sublink
            title="Kategori buku"
            href="/dashboard/buku/kategori"
            :active="Request::is('dashboard/buku/kategori*')"
        />
    </x-sidebar.dropdown>
    <x-sidebar.link
        title="Peminjaman"
        href="/dashboard/peminjaman"
        :isActive="Request::is('dashboard/peminjaman*')"
    >
        <x-slot name="icon">
            <x-icons.peminjaman class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Denda"
        href="/dashboard/denda"
        :isActive="Request::is('dashboard/denda*')"
    >
        <x-slot name="icon">
            <x-icons.money class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @if (Auth::user()->role == 'administrator')
        <x-sidebar.link
            title="Data user"
            href="/dashboard/user"
            :isActive="Request::is('dashboard/user*')"
        >
            <x-slot name="icon">
                <x-heroicon-s-user class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif
    @endif

    @if (Auth::user()->role == 'peminjam')
    <x-sidebar.link
        title="Peminjamanku"
        href="/dashboard/peminjam/peminjamanku"
        :isActive="Request::is('dashboard/peminjam/peminjamanku*')"
    >
        <x-slot name="icon">
            <x-icons.peminjaman class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Koleksi"
        href="/dashboard/koleksi"
        :isActive="Request::is('dashboard/koleksi*')"
    >
        <x-slot name="icon">
            <x-icons.koleksi class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    <x-sidebar.link
        title="Denda"
        href="/dashboard/dendaku"
        :isActive="Request::is('dashboard/dendaku*')"
    >
        <x-slot name="icon">
            <x-icons.money class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @endif

</x-perfect-scrollbar>
