@extends('layouts.landing')

@section('content')
<div class="detail-buku">
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-16 mx-auto">
          <div class="mx-auto md:mx-24 flex flex-wrap">
            <img alt="..." class="lg:w-1/3 w-full object-cover object-center rounded" src="{{ asset('storage/' . $buku->sampul) }}" style="max-height: 350px">
            <div class="lg:w-2/3 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <div class="border-b-2 border-gray-100 mb-5">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $buku->judul }}</h1>
                    <div class="grid grid-cols-2 mt-4">
                        <div class="col">
                            <h2 class="text-sm title-font text-gray-500 tracking-widest">Kategori: {{ implode(', ', $buku->kategoris->pluck('nama')->toArray()) }}</h2>
                            <h2 class="text-sm title-font text-gray-500 tracking-widest mt-3">Jumlah: {{ $buku->jumlah == null ? 'Stok buku sedang kosong' : $buku->jumlah}}</h2>
                            <h2 class="text-sm title-font text-gray-500 tracking-widest 
                            mt-3">Rating: {{ $buku->ulasans()->avg('rating') == null ? 'Belum ada yg memberikan penilaian' : number_format($buku->ulasans()->avg('rating'), 2) }}</h2>
                        </div>
                        <div class="col">
                            <h2 class="text-sm title-font text-gray-500 tracking-widest">Tahun terbit: {{ $buku->tahun_terbit }}</h2>
                            <h2 class="text-sm title-font text-gray-500 tracking-widest mt-3">Penulis: {{ $buku->penulis }}</h2>
                            <h2 class="text-sm title-font text-gray-500 tracking-widest mt-3">Penerbit: {{ $buku->penerbit }}</h2>
                        </div>
                    </div>
                    <p class="leading-relaxed word-wrap my-5">{{ $buku->deskripsi }}</p>
                </div>
                <div class="flex">
                    @if (Auth::check())
                        @php
                            $id_user = Auth::user()->id;
                            $existBuku = \App\Models\Koleksi::where('id_user', $id_user)
                                ->where('id_buku', $buku->id)->exists();
                            $dipinjam = \App\Models\Peminjaman::where('id_user', $id_user)
                                ->where('id_buku', $buku->id)
                                ->where('status', '=', 'dipinjam')
                                ->exists();
                        @endphp
                    @endif
                    @if (Auth::check())
                        @if (!$existBuku)
                            <form action="/dashboard/koleksi" method="post">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                                <button class="text-white mr-5 bg-[#9333EA] border-0 py-2 px-6 focus:outline-none hover:bg-[#9344dd] rounded" onclick="return confirm('Tambahkan buku ini ke koleksi anda?')">Tambah koleksi</button>
                            </form>
                        @else
                            <button class="text-white bg-[#9333EA] mr-5 rounded border-0 py-2 px-6 focus:outline-none hover:bg-[#9344dd]" type="button"><i class="fa fa-star text-warning"></i>Koleksi</button>
                        @endif
                        @if (!$dipinjam)
                            <form action="/dashboard/peminjaman" method="post">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                                <button class="py-2 px-6 border border-[#9333EA] text-[#9333EA] bg-white hover:bg-[#9333EA] hover:text-white rounded" onclick="return confirm('Anda ingin meminjam buku ini?')">Pinjam</button>
                            </form>
                        @else
                            <button class="py-2 px-6 border border-black text-black bg-white hover:bg-[#9333EA] hover:text-white rounded">Dipinjam</button>
                        @endif
                    @else
                        <form action="/dashboard/koleksi" method="post">
                            @csrf
                            <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                            <button class="text-white mr-5 bg-[#9333EA] border-0 py-2 px-6 focus:outline-none hover:bg-[#9344dd] rounded" onclick="return confirm('Tambahkan buku ini ke koleksi anda?')">Tambah koleksi</button>
                        </form>
                        <form action="/dashboard/peminjaman" method="post">
                            @csrf
                            <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                            <button class="py-2 px-6 border border-[#9333EA] text-[#9333EA] bg-white hover:bg-[#9333EA] hover:text-white rounded" onclick="return confirm('Anda ingin meminjam buku ini?')">Pinjam</button>
                        </form>
                    @endif
                </div>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-16 mt-20">
            <div class="ulasan">
                <h1 class="text-gray-900 text-2xl title-font font-medium mb-3">Ulasan</h1>
                @if ($ulasans->count())
                    @foreach ($ulasans as $ulasan)
                        <div class="list border border-gray-200 rounded p-5">
                            <h1 class="ulasan">{{ $ulasan->ulasan }}</h1>
                            <div class="rate">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $ulasan->rating)
                                        <i class="fa fa-star text-warning"></i>
                                    @else
                                        <i class="fa fa-star text-muted"></i>
                                    @endif
                                @endfor 
                            </div>
                            <div class="user flex justify-end">
                                {{ $ulasan->user->username }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex justify-center items-center" style="height: 50vh;">
                        <h1 class="text-gray-900 text-lg title-font">Tidak ada ulasan untuk sekarang</h1>
                    </div>
                @endif
            </div>
            
            <div class="berikan-ulasan">
                <h1 class="text-gray-900 text-2xl title-font font-medium mb-3">Berikan ulasan</h1>
                <form action="/dashboard/ulasan" method="post">
                    @csrf
                    <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                        <input type="radio" id="star1" name="rating" value="1" checked />
                        <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                    </div>
                    <div class="form">
                        <textarea placeholder="Ulasan..." id="ulasan" name="ulasan" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 leading-6 transition-colors duration-200 ease-in-out">{{ old('ulasan') }}</textarea>
                        <x-form.error :messages="$errors->get('ulasan')" />
                    </div>
                    <button class="text-white mt-5 bg-[#9333EA] border-0 py-2 px-6 focus:outline-none hover:bg-[#9344dd] rounded">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </section>
</div>
@endsection