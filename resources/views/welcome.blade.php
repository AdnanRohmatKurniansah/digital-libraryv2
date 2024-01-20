@extends('layouts.landing')

@section('content') 
  <div class="hero">
    <section class="text-gray-600 body-font">
      <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
          <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Selamat Datang di Perpustakaan Digital.</h1>
          <p class="mb-8 text-xl leading-relaxed">Temukan dunia pengetahuan di ujung jari Anda. Perpustakaan digital kami menawarkan akses instan ke berbagai koleksi, membawa pengalaman membaca ke level berikutnya.</p>
          <div class="flex justify-center">
            <a href="/listbuku" class="inline-flex text-white bg-black border-0 py-2 px-6 focus:outline-none rounded text-lg">Jelajahi</a>
          </div>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
          <img class="object-cover object-center rounded" alt="hero" src="https://images.unsplash.com/photo-1549383028-df014fa3a325?w=1000&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjR8fGxpYnJhcnl8ZW58MHx8MHx8fDI%3D">
        </div>
      </div>
    </section>
  </div>
  <div id="feature" class="feature">
    <section class="text-gray-600 body-font">
      <div class="container px-5 py-24 mx-auto">
        <div class="text-center mb-20">
          <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4">Jelajahi Fitur-Fitur Unggulan Perpustakaan Digital Kami</h1>
          <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto text-gray-500s">Buka dunia pengetahuan dengan perpustakaan digital kami yang dilengkapi dengan perpustakaan komponen premium, memudahkan Anda menjelajahi ranah digital dengan lancar.</p>
        </div>
        <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4 md:space-y-0 space-y-6">
          <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
            <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-orange-300 mb-5 flex-shrink-0">
              <svg fill="#FFA500" width="32" height="32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="search"><g data-name="Layer 2"><path d="m20.71 19.29-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 11a6 6 0 1 1 6 6 6 6 0 0 1-6-6z" data-name="search"></path></g></svg>            
            </div>
            <div class="flex-grow">
              <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Temuan Tanpa Usaha</h2>
              <p class="leading-relaxed text-base">Temukan dan jelajahi berbagai sumber daya digital dengan lancar tanpa kesulitan.</p>
            </div>
          </div>
          <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
            <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-orange-300 mb-5 flex-shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" id="book"><path d="M5.042 32h18.91a2 2 0 0 0 2-2V9a1 1 0 0 0-1-1H8c-.05 0-.148.008-.242.014L5.042 8C3.364 8 2 6.718 2 5.042 2 3.364 3.322 2 5 2h23v23c0 .552.4 1 .954 1S30 25.552 30 25V1c0-.552-.494-1-1.046-1H5.042A5.036 5.036 0 0 0 .008 4.968L0 4.958v22A5.043 5.043 0 0 0 5.042 32z"></path></svg>
            </div>
            <div class="flex-grow">
              <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Koleksi Digital yang Beragam</h2>
              <p class="leading-relaxed text-base">Telusuri koleksi digital kami yang beragam, yang telah dirangkai dengan cermat untuk eksplorasi Anda.</p>
            </div>
          </div>
          <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
            <div class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-orange-300 mb-5 flex-shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 32 32" id="globe"><path d="M17 2C8.716 2 2 8.716 2 17s6.716 15 15 15 15-6.716 15-15S25.284 2 17 2zm10.938 8h-2.98c-.58-1.824-1.376-3.422-2.336-4.704A13.083 13.083 0 0 1 27.938 10zM18 10V4.164c1.89.558 3.732 2.654 4.866 5.836H18zm5.448 2c.282 1.224.464 2.564.522 4H18v-4h5.448zM16 4.164V10h-4.866C12.268 6.818 14.11 4.722 16 4.164zM16 12v4h-5.97c.058-1.436.24-2.776.522-4H16zm-7.97 4H4.05c.108-1.406.43-2.754.952-4h3.52a23.96 23.96 0 0 0-.492 4zm0 2a23.96 23.96 0 0 0 .492 4h-3.52a12.895 12.895 0 0 1-.952-4h3.98zm2 0H16v4h-5.448a21.758 21.758 0 0 1-.522-4zM16 24v5.836c-1.89-.558-3.732-2.654-4.866-5.836H16zm2 5.836V24h4.866c-1.134 3.182-2.976 5.278-4.866 5.836zM18 22v-4h5.97a21.758 21.758 0 0 1-.522 4H18zm7.97-4h3.98a12.895 12.895 0 0 1-.952 4h-3.52a23.96 23.96 0 0 0 .492-4zm0-2a23.96 23.96 0 0 0-.492-4h3.52c.522 1.246.844 2.594.952 4h-3.98zM11.378 5.296C10.42 6.578 9.622 8.176 9.042 10h-2.98a13.083 13.083 0 0 1 5.316-4.704zM6.062 24h2.98c.58 1.824 1.376 3.422 2.336 4.704A13.083 13.083 0 0 1 6.062 24zm16.56 4.704c.958-1.282 1.756-2.88 2.336-4.704h2.98a13.083 13.083 0 0 1-5.316 4.704z"></path></svg>
            </div>
            <div class="flex-grow">
              <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Aksesible dari Mana Saja</h2>
              <p class="leading-relaxed text-base">Nikmati kebebasan untuk mengakses perpustakaan digital kami dari mana saja, kapan saja.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="info">
    <section class="text-gray-600 body-font">
      <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Masuk untuk Akses Penuh</h1>
          <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Untuk menggunakan fitur-fitur khusus dan meminjam buku, masuklah ke akun perpustakaan digital Anda.</p>
          <div class="login mt-7">
            <a href="/login" class=" text-white bg-black border-0 py-3 px-6 focus:outline-none rounded">Login</a>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="faq mb-10" >
    <section class="text-gray-600 body-font">
      <div class="container px-5 py-24 mx-auto">
        <div class="text-center mb-10">
          <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">Pertanyaan Umum (FAQ)</h1>
        </div>
        <div class="join join-vertical w-full">
          <div class="collapse collapse-arrow join-item border border-base-300">
            <input type="radio" name="my-accordion-4" checked="checked" /> 
            <div class="collapse-title text-xl font-medium">
              Apa itu perpustakaan digital?
            </div>
            <div class="collapse-content"> 
              <p>Perpustakaan digital adalah platform online yang menyediakan akses instan ke berbagai koleksi buku digital, jurnal, dan sumber daya pendidikan lainnya. Pengguna dapat menjelajahi dan membaca materi secara elektronik.</p>
            </div>
          </div>
          <div class="collapse collapse-arrow join-item border border-base-300">
            <input type="radio" name="my-accordion-4" /> 
            <div class="collapse-title text-xl font-medium">
              Bagaimana cara melakukan peminjaman buku?
            </div>
            <div class="collapse-content"> 
              <p>Masuk ke list buku, Klik detail buku, Pilih pinjam, Tunjukkan kode peminjaman ke petugas. Petugas akan mengambilkan buku yang ingin anda pinjam jika kode anda benar.</p>
            </div>
          </div>
          <div class="collapse collapse-arrow join-item border border-base-300">
            <input type="radio" name="my-accordion-4" /> 
            <div class="collapse-title text-xl font-medium">
              Bagaimana cara saya melakukan pencarian buku?
            </div>
            <div class="collapse-content"> 
              <p>Untuk mencari buku, masuk ke halaman list buku, gunakan kotak pencarian di bagian kanan atas halaman. Anda dapat memasukkan judul buku untuk menemukan buku yang Anda cari.</p>
            </div>
          </div>
          <div class="collapse collapse-arrow join-item border border-base-300">
            <input type="radio" name="my-accordion-4" /> 
            <div class="collapse-title text-xl font-medium">
              Bagaimana saya dapat mengakses perpustakaan digital dari perangkat seluler?
            </div>
            <div class="collapse-content"> 
              <p>Perpustakaan digital kami dapat diakses melalui perangkat seluler. Pastikan Anda terhubung ke internet dan buka situs web perpustakaan dari browser di ponsel atau tablet Anda.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const accordions = document.querySelectorAll(".collapse-arrow");
  
      accordions.forEach((accordion) => {
        const input = accordion.querySelector("input[name='my-accordion-4']");
        const title = accordion.querySelector(".collapse-title");
        const content = accordion.querySelector(".collapse-content");
  
        input.addEventListener("change", function () {
          if (this.checked) {
            accordions.forEach((otherAccordion) => {
              if (otherAccordion !== accordion) {
                otherAccordion.classList.remove("open");
              }
            });
  
            accordion.classList.toggle("open");
          }
        });
  
        title.addEventListener("click", function () {
          input.checked = !input.checked;
          input.dispatchEvent(new Event("change"));
        });
      });
    });
  </script>
@endsection