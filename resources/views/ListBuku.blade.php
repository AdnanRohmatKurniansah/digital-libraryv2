@extends('layouts.landing')

@section('content')
    <div class="list-buku">
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-16 mx-auto">
              <div class="grid grid-cols-1 md:grid-cols-2 mb-10">
                <div class="heading">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">Daftar buku</h1>
                    <p class="leading-relaxed mt-5">Jelajahi koleksi beberapa buku yang tersedia di perpustakaan kami.</p>
                </div>
                <div class="search flex md:justify-end items-start pt-5 md:pt-0">
                    <form action="/listbuku" class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." id="search" name="search" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <button class="text-white ml-4 mr-5 bg-[#9333EA] border-0 py-2 px-6 focus:outline-none hover:bg-gray-800 rounded">Submit</button>
                    </form>
                </div>
              </div>
              <div class="flex flex-wrap -m-4">
                @if ($bukus->isEmpty())
                <div class="flex justify-center items-center mx-auto h-72">
                  <h1 class="text-gray-900 text-2xl font-medium title-font">Buku tidak ada</h1>
                </div>
                @else
                  @foreach ($bukus as $buku)
                    <div class="p-4 md:w-1/4">
                      <a href="/detailbuku/{{ Crypt::encryptString($buku->id) }}">
                        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                          <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('storage/' . $buku->sampul) }}" alt="blog">
                          <div class="p-6">
                            <div class="flex justify-between">
                              <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ implode(', ', $buku->kategoris->pluck('nama')->toArray()) }}</h2>
                              <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ $buku->tahun_terbit }}</h2>
                            </div>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $buku->judul }}</h1>
                            <p class="leading-relaxed mb-3 word-wrap">{{ substr($buku->deskripsi, 0, 50) }}...</p>
                          </div>
                        </div>
                      </a>
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="my-5 justify-center">
                {{ $bukus->links() }}
              </div> 
            </div>
        </section>
    </div>
    
@endsection