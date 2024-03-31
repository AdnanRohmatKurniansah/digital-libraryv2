<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-2 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <section class="text-gray-600 body-font">
            <div class="container p-5 mx-auto">
              <div class="grid grid-cols-1 md:grid-cols-4 text-center gap-4">
                <div class="p-4 rounded border border-gray-300">
                  @php
                      $user = \App\Models\User::count();
                  @endphp
                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900 dark:text-gray-400">{{ $user }}</h2>
                  <p class="leading-relaxed">Users</p>
                </div>
                <div class="p-4 rounded border border-gray-300">
                  @php
                      $buku = \App\Models\Buku::count();
                  @endphp
                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900 dark:text-gray-400">{{ $buku }}</h2>
                  <p class="leading-relaxed">Buku</p>
                </div>
                <div class="p-4 rounded border border-gray-300">
                  @php
                    $peminjaman = \App\Models\Peminjaman::count();
                  @endphp
                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900 dark:text-gray-400">{{ $peminjaman }}</h2>
                  <p class="leading-relaxed">Peminjaman</p>
                </div>
                <div class="p-4 rounded border border-gray-300">
                    @php
                        $denda = \App\Models\Denda::count();
                    @endphp
                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900 dark:text-gray-400">{{ $denda }}</h2>
                  <p class="leading-relaxed">Denda</p>
                </div>
              </div>
            </div>
        </section>
        <section class="p-5 mt-5 w-full">
          <canvas id="bars"></canvas>
        </section>
    </div>

<script>
  var chartColors = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      info: '#41B1F9',
      blue: '#3245D1',
      purple: 'rgb(153, 102, 255)',
      grey: '#EBEFF6'
  };

  var ctxBar = document.getElementById("bars")
  var peminjamans = JSON.parse('{!! json_encode($peminjamans) !!}');
  console.log(peminjamans)
  var labels = peminjamans.map(peminjaman => peminjaman.date); 
  var counts = peminjamans.map(peminjaman => peminjaman.count);
  var myBar = new Chart(ctxBar, {
  type: 'bar',
  data: {
          labels: labels,
          datasets: [{
              label: 'Jumlah Peminjaman buku',
              data: counts,
              backgroundColor: chartColors.blue,
              barPercentage: 0.2,
              categoryPercentage: 0.3
          }]
      },
  options: {
      responsive: true,
      barRoundness: 1,
      title: {
      display: false,
      text: "Chart.js - Bar Chart with Rounded Tops (drawRoundedTopRectangle Method)"
      },
      legend: {
      display:false
      },
      scales: {
            y: {
                max: 100
            }
        }
  }
  });
</script>

</x-app-layout>
