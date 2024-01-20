<div class="navbar border border-b border-gray-200">
    <div class="navbar-start">
      <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
        </label>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-[#FBFDFE] rounded-box w-52">
          <li><a class="{{ Request::is('/') ? 'text-gray-500' : '' }}" href="/">Home</a></li>
          <li><a class="{{ Request::is('/listbuku') ? 'text-gray-500' : '' }}"href="/list_buku">List buku</a></li>
        </ul>
      </div>
      <a href="/" class="btn btn-ghost text-xl">Digital Library</a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1">
        <li><a class="{{ Request::is('/') ? 'text-gray-500' : '' }}" href="/">Home</a></li>
        <li><a class="{{ Request::is('/listbuku') ? 'text-gray-500' : '' }}" href="/listbuku">List buku</a></li>
      </ul>
    </div>
    <div class="navbar-end">
      @if (Auth::check())
      <ul class="menu menu-horizontal pr-10">
        <li>
          <details>
            <summary>
              {{ Auth::user()->username }}
            </summary>
            <ul class="p-2 bg-base-100 rounded-t-none">
              @if (Auth::user()->role == 'peminjam')
                <li><a href="/dashboard/peminjam/peminjamanku">Dashboard</a></li>
              @else
                <li><a href="/dashboard">Dashboard</a></li>
              @endif
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="border-0 py-1 px-3 focus:outline-none rounded">Logout</button>
                </form>
              </li>
            </ul>
          </details>
        </li>
      </ul>
      @else
        <a href="/login" class="inline-flex text-white bg-black border-0 py-2 px-6 focus:outline-none rounded text-lg">Login</a>
      @endif
    </div>
</div>