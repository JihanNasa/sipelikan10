@extends('stisla.layouts.landing')

@section('title', 'SiPelikan - Sistem Pelaporan dan Pembinaan Mutu Pengolahan Ikan')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Selamat Datang di SiPELIKAN</h1>
            <p data-aos="fade-up" data-aos-delay="100">Sistem Pelaporan dan Pembinaan Mutu Pengolahan Ikan</p>
            <p data-aos="fade-up" data-aos-delay="100">
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="{{ asset('landingpage/img/logo_sipelikan.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container" data-aos="fade-up">
        <div class="row gx-0">
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h4 style="color: #278EF5;">SiPELIKAN</h4>
              <p>
                Peningkatan sektor kelautan dan perikanan, khususnya sub-sektor pengolahan dan pemasaran produk,
                berperan penting dalam pertumbuhan ekonomi daerah.
                Pemerintah melalui Peraturan Menteri Kelautan dan Perikanan No. 10 Tahun 2021 mewajibkan Unit Pengolah
                Ikan (UPI)
                untuk memenuhi standar usaha dan melaporkan kegiatan usahanya secara berkala
                guna menjamin mutu dan keamanan produk serta akuntabilitas usaha.
              </p>
              <p>
                Namun, pelaksanaan kewajiban pelaporan ini masih menghadapi tantangan,
                terutama bagi UPI skala kecil-menengah yang kesulitan dalam akses informasi,
                pemahaman regulasi, dan keterbatasan sumber daya.
              </p>
              <p>
                Untuk mengatasi hal tersebut, Dinas Kelautan dan Perikanan Provinsi Jawa Barat mengembangkan aplikasi
                SiPelikan
                (Sistem Pelaporan dan Pembinaan Mutu Pengolahan Ikan) yang memfasilitasi pelaporan digital, pembinaan, serta
                akses informasi standar industri.
                Aplikasi ini diharapkan meningkatkan efektivitas pengawasan, akurasi data, dan daya saing produk
                perikanan Jawa Barat,
                serta mendorong tata kelola usaha yang transparan, akuntabel, dan sesuai standar global.
              </p>
              {{-- <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div> --}}
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('landingpage/img/img_about.jpg') }}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section id="values" class="values section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Regulasi</h2>
        <p>Landasan Hukum<br></p>
      </div>
      <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
          <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <img src="{{ asset('landingpage/img/undang-undang.jpg') }}" class="img-fluid" alt="">
              <h3>PP 5 Tahun 2021</h3>
              <p>Tentang Penyelenggaraan Perizinan Berusaha Berbasis Risiko</p>
              <a href="https://jdih.kkp.go.id/Homedev/DetailPeraturan/46" target="_blank" rel="noopener noreferrer">Lihat Peraturan</a>
            </div>
          </div>
          <div class="col" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <img src="{{ asset('landingpage/img/undang-undang2.png') }}" class="img-fluid" alt="">
              <h3>PP 21 Tahun 2021</h3>
              <p>Tentang Penyelenggaraan Penataan Ruang</p>
              <a href="https://jdih.kkp.go.id/Homedev/DetailPeraturan/47" target="_blank" rel="noopener noreferrer">Lihat Peraturan</a>
            </div>
          </div>
          <div class="col" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <img src="{{ asset('landingpage/img/values-3.png') }}" class="img-fluid" alt="">
              <h3>PerKa BKPM No. 4 Tahun 2021</h3>
              <p>Tentang Pedoman dan Tatacara Pelayanan Perizinan Berusaha Berbasis Risiko dan Fasilitas Penanaman Modal</p>
              <a href="https://jdih.maritim.go.id/cfind/source/files/peraturan-bkpm/perka-bkpm-nomor-4-tahun-2021.pdf" target="_blank" rel="noopener noreferrer">Lihat Peraturan</a>
            </div>
          </div>
          <div class="col" data-aos="fade-up" data-aos-delay="400">
            <div class="card">
              <img src="{{ asset('landingpage/img/values-3.png') }}" class="img-fluid" alt="">
              <h3>PerMen KP No. 10 Tahun 2021</h3>
              <p>Tentang Standar Kegiatan Dan Produk Pada Penyelenggaraan Perizinan Berusaha Berbasis Risiko Sektor Kelautan Dan Perikanan</p>
              <a href="https://jdih.kkp.go.id/Homedev/DetailPeraturan/936" target="_blank" rel="noopener noreferrer">Lihat Peraturan</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="peraturan" class="services section">
      <div class="container section-title" data-aos="fade-up">
        <p>Peraturan Terkait</p>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-activity icon"></i>
              <h3>Berdasarkan PerMen KP No. 10 Tahun 2021</h3>
              <p>Standar Kegiatan Usaha dan Produk Penyelenggaraan Perizinan Berbasis Risiko di sektor Kelautan dan Perikanan</p>
              <a href="https://peraturan.bpk.go.id/Details/189816/permen-kkp-no-10-tahun-2021" target="_blank" rel="noopener noreferrer"> <span>Lihat Peraturan</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <i class="bi bi-broadcast icon"></i>
              <h3>Kewajiban Unit Pengolah Ikan</h3>
              <ol class="obligation-list">
                <li>melaporkan kegiatan usahanya kepada instansi yang berwenang, seperti Dinas Kelautan dan Perikanan setempat atau kementerian terkait.</li>
                <li>Memenuhi persyaratan perizinan di bidang pengolahan dan pemasaran</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">
      <div class="container section-title" data-aos="fade-up" data-aos-delay="100">
        <div class="content px-xl-3">
          <p class="text-center">Aktivitas Kegiatan</p>
        </div>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
              <h3>
                <span>Aktivitas kegiatan</span><strong></strong>
              </h3>
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-container">
              <div class="faq-item">
                <h3>
                  <span class="num">1.</span>
                  <span>Permen KP No.17 Tahun 2019</span>
                </h3>
                <div class="faq-content">
                  <p>
                    Persyaratan dan Tata Cara Penerbitan Sertifikat Kelayakan Pengolahan (SKP)
                    bagi Unit Pengolahan Ikan (UPI) di Indonesia. SKP ini menjadi syarat untuk memastikan mutu dan
                    keamanan produk perikanan serta memenuhi standar nasional dan internasional.
                    <a href="https://jdih.kkp.go.id/Homedev/DetailPeraturan/802" target="_blank" rel="noopener noreferrer">Lihat Peraturan</a>
                  </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3>
                  <span class="num">2.</span>
                  <span>PP Nomor 28 Tahun 2025</span>
                </h3>
                <div class="faq-content">
                  <p>
                    PP ini mengatur mengenai Penyelenggaraan Perizinan Berusaha Berbasis Risiko (PBBR). Ruang lingkup penyelenggaraan PBBR meliputi: persyaratan dasar; Perizinan Berusaha (PB); Perizinan
                    Berusaha untuk Menunjang Kegiatan Usaha (PB UMKU); norma, standar, prosedur, dan kriteria; layanan sistem OSS; pengawasan; evaluasi dan reformasi kebijakan; pendanaan; penyelesaian
                    permasalahan dan hambatan; dan sanksi. PBBR adalah perizinan berusaha yang menggunakan pendekatan berbasis risiko yang diperoleh dari hasil analisis risiko setiap kegiatan usaha,
                    sedangkan PB adalah legalitas yang diberikan kepada Pelaku Usaha untuk memulai dan menjalankan usaha dan/atau kegiatannya. Untuk melakukan kegiatan usaha, Pelaku Usaha wajib memiliki
                    PB.
                  </p>
                  <a href="https://peraturan.bpk.go.id/Details/319773/pp-no-28-tahun-2025" target="_blank" rel="noopener noreferrer">Lihat Peraturan</a>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3>
                  <span class="num">3.</span>
                  <span>Kunjungi YouTube Kami</span>
                </h3>
                <div class="faq-content">
                  <p>
                    Untuk informasi lebih lanjut mengenai regulasi dan standar pengolahan ikan, silakan kunjungi
                    channel YouTube Dinas Kelautan dan Perikanan Provinsi Jawa Barat.
                  </p>
                  <a href="https://www.youtube.com/@dkpjabar7133" target="_blank" rel="noopener noreferrer">YouTube DKP Jabar</a>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3>
                  <span class="num">4.</span>
                  <span>Modul panduan</span>
                </h3>
                <div class="faq-content">
                  <p>
                    Modul Panduan User berisi petunjuk penggunaan sistem secara lengkap dan mudah dipahami, 
                    untuk membantu pengguna dalam mengoperasikan aplikasi dengan benar.
                  </p>
                  <p>
                    Untuk mengunduh modul panduan, silakan klik tautan dibawah ini.
                  </p>
                  <a href="https://drive.google.com/drive/folders/1dBMxmoN6WG-5_l71STZe1Sb4DRnrK7uk?usp=sharing" target="_blank" rel="noopener noreferrer">Modul Panduan Pengguna</a>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
        </div>
    </section>

    <!-- Video Section -->
    @php 
      $videos = \App\Models\Video::all();
    @endphp

    <section id="video-section" class="py-10 bg-gray-100">
      <div class="container section-title" data-aos="fade-up">
        <h2>Video Kami</h2>
        <p>Lihat beberapa cuplikan video mengenai SiPELIKAN</p>
        <!-- Swiper -->
        <div class="swiper videoSwiper">
          <div class="swiper-wrapper">
            @foreach($videos as $video)
              <div class="swiper-slide">
                <div class="video-card text-center shadow-lg rounded-xl bg-white p-3 transition-all duration-300 hover:shadow-2xl">
                  <div class="video-item relative cursor-pointer group" data-id="{{ $video->youtube_id }}">
                    <!-- Thumbnail -->
                    <img 
                      class="w-full h-48 object-cover rounded-lg shadow transition-transform duration-300 group-hover:scale-105" 
                      src="https://img.youtube.com/vi/{{ $video->youtube_id }}/hqdefault.jpg" 
                      alt="{{ $video->title }}">
                    <!-- Play Button -->
                    <div class="absolute inset-0 flex items-center justify-center">
                      <div class="bg-red-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg text-2xl transition-all duration-300 group-hover:scale-110 group-hover:bg-red-700">
                        <i class="bi bi-play-fill"></i>
                      </div>
                    </div>
                  </div>
                  <div class="video-title mt-3 text-base font-semibold text-gray-800">
                    {{ $video->title }}
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Navigation Buttons -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          <!-- Pagination -->
          <div class="swiper-pagination mt-4"></div>
        </div>
      </div>
    </section>

    <!-- SwiperJS & Script -->
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    .video-section {
      width: 100%;
      padding: 20px 0;
      background: #f7fafc;
    }

    .video-section .section-title {
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 20px;
      color: #278EF5;
    }

    .videoSwiper {
      width: 100%;
      padding: 20px 0;
    }

    .videoSwiper .swiper-wrapper {
      padding-bottom: 30px;
    }

    .videoSwiper .swiper-slide {
      display: flex;
      justify-content: center;
      align-items: center;
      height: auto !important;
      padding: 15px 0;
    }

    .video-card {
      width: 100%;
      max-width: 340px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.07);
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: box-shadow 0.3s;
      min-height: 270px;
    }
    .video-card:hover {
      box-shadow: 0 6px 24px rgba(39,142,245,0.15);
    }

    .video-item {
      width: 100%;
      height: 200px;
      position: relative;
      overflow: hidden;
      border-radius: 12px;
      background: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
    }

    .video-item img,
    .video-item iframe {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 12px;
      transition: transform 0.3s;
    }

    .video-item:hover img {
      transform: scale(1.05);
    }

    .video-item .play-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: rgba(220,38,38,0.9);
      color: #fff;
      border-radius: 50%;
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      box-shadow: 0 2px 8px rgba(39,142,245,0.08);
      transition: background 0.3s, transform 0.3s;
      z-index: 2;
    }
    .video-item:hover .play-btn {
      background: #b91c1c;
      transform: translate(-50%, -50%) scale(1.1);
    }

    .video-title {
      margin: 16px 0 8px 0;
      font-size: 1rem;
      color: #278EF5;
      font-weight: 600;
      text-align: center;
      min-height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 10px;
    }

    /* Tampilkan tombol navigasi hanya saat hover */
    .videoSwiper .swiper-button-next,
    .videoSwiper .swiper-button-prev {
      opacity: 0;
      transition: opacity 0.3s ease;
      color: #278EF5;
      background: rgba(255,255,255,0.8);
      border-radius: 50%;
      width: 44px;
      height: 44px;
      box-shadow: 0 2px 8px rgba(39,142,245,0.08);
      top: 45%;
    }
    .videoSwiper:hover .swiper-button-next,
    .videoSwiper:hover .swiper-button-prev {
      opacity: 1;
    }
    .swiper-button-next:after, .swiper-button-prev:after {
      font-size: 1.5rem;
      font-weight: bold;
    }

    /* Pagination di bawah judul */
    .swiper-pagination {
      margin-top: 10px;
      position: relative;
    }
  </style>
  
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".videoSwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      watchSlidesProgress: true,
      watchSlidesVisibility: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        640: { slidesPerView: 1, spaceBetween: 10 },
        768: { slidesPerView: 2, spaceBetween: 20 },
        1024: { slidesPerView: 3, spaceBetween: 30 },
      }
    });

    // Lazy load YouTube player on click
    document.querySelectorAll(".video-item").forEach(item => {
      item.addEventListener("click", function () {
        const youtubeId = this.dataset.id;
        const iframe = document.createElement("iframe");
        iframe.setAttribute("src", "https://www.youtube.com/embed/" + youtubeId + "?autoplay=1");
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allowfullscreen", "1");
        iframe.setAttribute("allow", "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture");
        iframe.style.width = "100%";
        iframe.style.height = "100%";
        iframe.style.borderRadius = "12px";
        this.innerHTML = "";
        this.appendChild(iframe);
      });
    });
  </script>


    <!-- Grafik Section -->
    <section id="statistik" class="grafik section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Statistik</h2>
        <p>Statistik Pengolahan Ikan</p>
      </div>
      <div class="container">
        <div class="mb-3">
          <label for="tahunSelect" class="form-label">Pilih Tahun:</label>
          <select id="tahunSelect" class="form-control" style="width:auto; display:inline-block"></select>
        </div>
        <div class="" data-aos="fade-up" data-aos-delay="200">
          <!-- Chart Section -->
          <div class="card card-success mb-4">
            <div class="card-header">
              <h3 class="card-title">Kapasitas Sarana & Prasarana</h3>
            </div>
            <div class="card-body">
              <canvas id="saranaChart" style="min-height: 500px; height: 500px;"></canvas>
            </div>
          </div>
          <div class="card card-info mb-4">
            <div class="card-header">
              <h3 class="card-title">Tenaga Kerja</h3>
            </div>
            <div class="card-body">
              <canvas id="tenagaChart" style="height:500px;"></canvas>
            </div>
          </div>
          <div class="card card-primary mb-4">
            <div class="card-header">
              <h3 class="card-title">Bahan Baku Top 10</h3>
            </div>
            <div class="card-body">
              <canvas id="bahanChart" style="min-height: 500px; height: 500px;"></canvas>
            </div>
          </div>
          <div class="card card-warning mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">Omzet Top 10 Produk</h3>
              <select id="omzetType" class="form-control form-control-sm" style="width:auto">
                <option value="nilai" selected>Berdasarkan Nilai</option>
                <option value="volume">Berdasarkan Volume</option>
              </select>
            </div>
            <div class="card-body">
              <canvas id="omzetChart" style="min-height: 500px; height: 500px;"></canvas>
            </div>
          </div>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const ChartDataLabels = window.ChartDataLabels;
              let saranaChart, tenagaChart, bahanChart, omzetChart;
              let chartData = {};
              let tahunList = [];
              let tahunAktif = '';

              function formatNumberLabel(v) {
                try {
                  return Number(v).toLocaleString('id-ID');
                } catch (e) {
                  return v;
                }
              }

              function niceStep(raw) {
                if (raw <= 0) return 1;
                const m = Math.pow(10, Math.floor(Math.log10(raw)));
                const n = raw / m;
                if (n <= 1) return 1 * m;
                if (n <= 2) return 2 * m;
                if (n <= 5) return 5 * m;
                return 10 * m;
              }

              function chartOptions(title, xLabel, yLabel, arrays) {
                const flat = (arrays || []).flat().map(v => Number(v) || 0);
                const max = flat.length ? Math.max(...flat) : 0;
                const rawStep = Math.ceil(max / 10) || 1;
                const step = niceStep(rawStep);
                const maxTick = step * 10;
                return {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                    legend: {
                      position: 'bottom'
                    },
                    title: {
                      display: true,
                      text: title
                    },
                    datalabels: {
                      anchor: 'end',
                      align: 'top',
                      color: '#333',
                      font: {
                        weight: 'bold'
                      },
                      formatter: formatNumberLabel
                    }
                  },
                  scales: {
                    x: {
                      title: {
                        display: true,
                        text: xLabel
                      }
                    },
                    y: {
                      beginAtZero: true,
                      title: {
                        display: true,
                        text: yLabel
                      },
                      ticks: {
                        stepSize: step,
                        max: maxTick,
                        callback: v => formatNumberLabel(v)
                      }
                    }
                  }
                };
              }

              function sum(arr) {
                return (arr || []).reduce((a, b) => a + Number(b || 0), 0);
              }

              function generateColors(count, alpha = 0.7) {
                const colors = [];
                for (let i = 0; i < count; i++) {
                  colors.push(`hsla(${(i * 360 / count)}, 70%, 60%, ${alpha})`);
                }
                return colors;
              }

              async function fetchChartData() {
                const res = await fetch('{{ route('landing.chart-data') }}');
                return await res.json();
              }

              function getTahunList(data) {
                // Ambil tahun dari data.sarana dan data.tenaga
                const tahunSet = new Set();
                if (data.sarana) Object.keys(data.sarana).forEach(tahun => tahunSet.add(tahun));
                if (data.tenaga) Object.keys(data.tenaga).forEach(tahun => tahunSet.add(tahun));
                return Array.from(tahunSet).sort((a, b) => b - a);
              }

              function getLatestYearData(byYearMap, tahun) {
                if (!byYearMap || !tahun) return {};
                return byYearMap[tahun] || {};
              }

              function updateTahunDropdown() {
                const tahunSelect = document.getElementById('tahunSelect');
                tahunSelect.innerHTML = '';
                tahunList.forEach(tahun => {
                  tahunSelect.innerHTML += `<option value="${tahun}" ${tahun==tahunAktif?'selected':''}>${tahun}</option>`;
                });
              }

              function updateCharts() {
                // destroy lama
                if (saranaChart) saranaChart.destroy();
                if (tenagaChart) tenagaChart.destroy();
                if (bahanChart) bahanChart.destroy();
                if (omzetChart) omzetChart.destroy();

                const triwulans = ['Triwulan 1', 'Triwulan 2', 'Triwulan 3', 'Triwulan 4'];

                // --- SARANA & PRASARANA ---
                const saranaYear = getLatestYearData(chartData.sarana, tahunAktif);
                const dingin = [1, 2, 3, 4].map(q => saranaYear[q]?.gudang_dingin ?? 0);
                const beku = [1, 2, 3, 4].map(q => saranaYear[q]?.gudang_beku ?? 0);
                const kering = [1, 2, 3, 4].map(q => saranaYear[q]?.gudang_kering ?? 0);

                saranaChart = new Chart(document.getElementById('saranaChart'), {
                  type: 'bar',
                  data: {
                    labels: triwulans,
                    datasets: [{
                        label: 'Gudang Dingin',
                        data: dingin,
                        backgroundColor: 'rgba(54,162,235,0.5)'
                      },
                      {
                        label: 'Gudang Beku',
                        data: beku,
                        backgroundColor: 'rgba(255,99,132,0.5)'
                      },
                      {
                        label: 'Gudang Kering',
                        data: kering,
                        backgroundColor: 'rgba(255,206,86,0.5)'
                      },
                    ]
                  },
                  options: chartOptions('', 'Triwulan', 'Kapasitas', [dingin, beku, kering]),
                  plugins: [ChartDataLabels]
                });

                // --- TENAGA KERJA ---
                const tenagaYear = getLatestYearData(chartData.tenaga, tahunAktif);
                const tenagaWNI = [1, 2, 3, 4].map(q => tenagaYear[q]?.wni ?? 0);
                const tenagaWNA = [1, 2, 3, 4].map(q => tenagaYear[q]?.wna ?? 0);

                tenagaChart = new Chart(document.getElementById('tenagaChart'), {
                  type: 'bar',
                  data: {
                    labels: triwulans,
                    datasets: [{
                        label: 'WNI',
                        data: tenagaWNI,
                        backgroundColor: 'rgba(54,162,235,0.5)'
                      },
                      {
                        label: 'WNA',
                        data: tenagaWNA,
                        backgroundColor: 'rgba(255,206,86,0.5)'
                      }
                    ]
                  },
                  options: chartOptions('', 'Triwulan', 'Jumlah', [tenagaWNI, tenagaWNA]),
                  plugins: [ChartDataLabels]
                });

                // --- BAHAN BAKU TOP 10 ---
                // Asumsi bahan_top10 tidak per tahun, jika per tahun, ambil dari tahunAktif
                let bahanTop10 = chartData.bahan_top10;
                if (typeof bahanTop10 === 'object' && bahanTop10[tahunAktif]) {
                  bahanTop10 = bahanTop10[tahunAktif];
                }
                const bahanLabels = Object.keys(bahanTop10 || {});
                const bahanValues = Object.values(bahanTop10 || {});
                const bahanColors = generateColors(bahanLabels.length);

                bahanChart = new Chart(document.getElementById('bahanChart'), {
                  type: 'bar',
                  data: {
                    labels: bahanLabels,
                    datasets: [{
                      label: 'Volume',
                      data: bahanValues,
                      backgroundColor: bahanColors
                    }]
                  },
                  options: chartOptions('', 'Jenis Ikan', 'Volume', [bahanValues]),
                  plugins: [ChartDataLabels]
                });

                // --- OMZET TOP 10 (toggle) + RINGKASAN TOTAL ---
                function buildOmzetDataset(type) {
                  let src = (type === 'nilai') ? chartData.omzet_nilai : chartData.omzet_volume;
                  if (typeof src === 'object' && src[tahunAktif]) {
                    src = src[tahunAktif];
                  }
                  const labels = Object.keys(src || {});
                  const domestik = labels.map(k => src[k]?.domestik ?? 0);
                  const ln = labels.map(k => src[k]?.luarnegeri ?? 0);
                  return {
                    labels,
                    domestik,
                    ln
                  };
                }

                function getChartConfig(type) {
                  const {
                    labels,
                    domestik,
                    ln
                  } = buildOmzetDataset(type);
                  const domColors = generateColors(labels.length, 0.7);
                  const lnColors = generateColors(labels.length, 0.4);
                  return {
                    type: 'bar',
                    data: {
                      labels,
                      datasets: [{
                          label: (type === 'nilai' ? 'Nilai Domestik' : 'Volume Domestik'),
                          data: domestik,
                          backgroundColor: domColors
                        },
                        {
                          label: (type === 'nilai' ? 'Nilai Luar Negeri' : 'Volume Luar Negeri'),
                          data: ln,
                          backgroundColor: lnColors
                        }
                      ]
                    },
                    options: chartOptions('', 'Produk', (type === 'nilai' ? 'Nilai' : 'Volume'), [domestik, ln]),
                    plugins: [ChartDataLabels]
                  };
                }

                const initialType = (document.getElementById('omzetType')?.value) || 'nilai';
                omzetChart = new Chart(document.getElementById('omzetChart'), getChartConfig(initialType));

                const omzetTypeSelect = document.getElementById('omzetType');
                if (omzetTypeSelect) {
                  omzetTypeSelect.addEventListener('change', (e) => {
                    const t = e.target.value;
                    omzetChart.destroy();
                    omzetChart = new Chart(document.getElementById('omzetChart'), getChartConfig(t));
                  });
                }
              }

              async function initAll() {
                chartData = await fetchChartData();
                tahunList = getTahunList(chartData);
                tahunAktif = tahunList.length ? tahunList[0] : '';
                updateTahunDropdown();
                updateCharts();

                document.getElementById('tahunSelect').addEventListener('change', function() {
                  tahunAktif = this.value;
                  updateCharts();
                });
              }

              initAll();
            });
          </script>
        </div>
      </div>
    </section>



    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Hubungi Kami</p>
      </div>
      <div div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="info-item" data-aos="fade" data-aos-delay="200">
          <i class="bi bi-geo-alt"></i>
          <h3>Alamat</h3>
          <h6>Dinas Kelautan dan Perikanan Provinsi Jawa Barat</h6>
          <p>Jl. Wastukencana No.17, Babakan Ciamis, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40117</p>
          <p>
            <a href="https://maps.app.goo.gl/Xqby85qo78CiX1TW6" target="_blank" rel="noopener noreferrer">
              Lihat Lokasi Kantor
            </a>
          </p>
        </div>
        <div class="info-item" data-aos="fade" data-aos-delay="300">
          <i class="bi bi-telephone"></i>
          <h3>Hubungi Kami</h3>
          <p>Telepon :</p>
          <p>(022) 4203471</p>
          <p>Faksimile:</p>
          <p>(022) 4232541</p>
        </div>
        <div class="info-item" data-aos="fade" data-aos-delay="400">
          <i class="bi bi-envelope"></i>
          <h3>Email</h3>
          <p>
            <a href="mailto:sipelikan.dkpjabar@gmail.com?subject=Pertanyaan%20SiPelikan">
              sipelikan.dkpjabar@gmail.com
            </a>
          </p>
        </div>
        <div class="info-item" data-aos="fade" data-aos-delay="500">
          <i class="bi bi-clock"></i>
          <h3>Jam Operasional</h3>
          <p>Senin - Jumat</p>
          <p>9:00AM - 05:00PM</p>
        </div>
      </div>
      </div>
    </section>

@endsection
