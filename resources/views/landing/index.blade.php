@extends('stisla.layouts.landing')

@section('title', 'SiPelikan - Sistem Pelaporan dan Pembinaan Mutu Pengolahan Ikan')

@section('content')
  <!-- Hero Section -->
  <section id="hero" class="hero section">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Selamat Datang di Sipelikan</h1>
          <p data-aos="fade-up" data-aos-delay="100">Sistem Pelaporan dan Pembinaan Mutu Pengolahan Ikan</p>
          <p data-aos="fade-up" data-aos-delay="100">
          <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
            <a href="#{{ route('login') }}" class="btn-get-started">Masuk<i class="bi bi-arrow-right"></i></a>
          </div>
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
            <h3>SiPelikan</h3>
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
            <div class="text-center text-lg-start">
              <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Read More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
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

    <!-- Chart Section -->
    <div class="card card-success mb-4">
      <div class="card-header">
        <h3 class="card-title">Kapasitas Sarana & Prasarana</h3>
      </div>
      <div class="card-body">
        <canvas id="saranaChart" style="min-height: 300px; height: 300px;"></canvas>
      </div>
    </div>
    <div class="card card-info mb-4">
      <div class="card-header">
        <h3 class="card-title">Bahan Baku</h3>
      </div>
      <div class="card-body">
        <canvas id="bahanBakuChart" style="height:300px;"></canvas>
      </div>
    </div>
    <div class="card card-primary mb-4">
      <div class="card-header">
        <h3 class="card-title">Distribusi Penjualan Produk Bahan Baku</h3>
      </div>
      <div class="card-body">
        <canvas id="penjualanProdukChart" style="min-height: 300px; height: 300px;"></canvas>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Sarana Chart
        const ctxSarana = document.getElementById('saranaChart');
        if (ctxSarana) {
          new Chart(ctxSarana.getContext('2d'), {
            type: 'bar',
            data: {
              labels: ['Triwulan 1', 'Triwulan 2', 'Triwulan 3', 'Triwulan 4'],
              datasets: [{
                  label: 'Cold Storage (Teknologi Pendingin) - 2025',
                  backgroundColor: '#28a745',
                  data: [315, 287, 180, 200]
                },
                {
                  label: 'Gudang Beku (Non Pendingin) - 2025',
                  backgroundColor: '#007bff',
                  data: [100, 130, 88, 140]
                },
                {
                  label: 'Pabrik Es (Teknologi Es Balok) - 2025',
                  backgroundColor: '#ffc107',
                  data: [80, 90, 100, 65]
                }
              ]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: 'bottom',
                  labels: {
                    color: '#333'
                  }
                },
                title: {
                  display: true,
                  text: 'Kapasitas Sarana & Prasarana per Triwulan (Dalam Ton)',
                  font: {
                    size: 16
                  }
                }
              },
              scales: {
                x: {
                  title: {
                    display: true,
                    text: 'Triwulan'
                  }
                },
                y: {
                  title: {
                    display: true,
                    text: 'Kapasitas (Ton)'
                  },
                  beginAtZero: true
                }
              }
            }
          });
        }
        // Bahan Baku Chart
        const ctxBahanBaku = document.getElementById('bahanBakuChart');
        if (ctxBahanBaku) {
          new Chart(ctxBahanBaku.getContext('2d'), {
            type: 'bar',
            data: {
              labels: ['Triwulan 1', 'Triwulan 2', 'Triwulan 3', 'Triwulan 4'],
              datasets: [{
                  label: 'Tangkap',
                  backgroundColor: 'rgba(54, 162, 235, 0.7)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1,
                  data: [120, 150, 100, 130]
                },
                {
                  label: 'Budidaya',
                  backgroundColor: 'rgba(255, 206, 86, 0.7)',
                  borderColor: 'rgba(255, 206, 86, 1)',
                  borderWidth: 1,
                  data: [90, 110, 130, 95]
                }
              ]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  beginAtZero: true,
                  title: {
                    display: true,
                    text: 'Volume (Ton)'
                  }
                }
              },
              plugins: {
                title: {
                  display: true,
                  text: 'Volume Bahan Baku Tahun 2025'
                }
              }
            }
          });
        }
        // Penjualan Produk Chart
        const ctxPenjualan = document.getElementById('penjualanProdukChart');
        if (ctxPenjualan) {
          new Chart(ctxPenjualan.getContext('2d'), {
            type: 'pie',
            data: {
              labels: ['Produk Bahan Baku Dingin', 'Produk Bahan Baku Beku', 'Produk Bahan Kering', 'Hasil Samping'],
              datasets: [{
                label: 'Volume Penjualan (Ton)',
                data: [3000, 2000, 1500, 500],
                backgroundColor: [
                  'rgba(255, 99, 132, 0.8)',
                  'rgba(54, 162, 235, 0.8)',
                  'rgba(255, 206, 86, 0.8)',
                  'rgba(75, 192, 192, 0.8)'
                ],
                borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  position: 'right',
                  labels: {
                    color: '#333',
                    font: {
                      size: 14
                    }
                  }
                },
                title: {
                  display: true,
                  text: 'Distribusi Penjualan Produk Bahan Baku Tahun 2025',
                  font: {
                    size: 18,
                    weight: 'bold'
                  },
                  color: '#333'
                },
                tooltip: {
                  callbacks: {
                    label: function(context) {
                      const label = context.label || '';
                      const value = context.parsed || 0;
                      const total = context.dataset.data.reduce((sum, current) => sum + current, 0);
                      const percentage = ((value / total) * 100).toFixed(2);
                      return `${label}: ${new Intl.NumberFormat('id-ID').format(value)} Ton (${percentage}%)`;
                    }
                  }
                }
              }
            }
          });
        }
      });
    </script>
  </section>

  <!-- Grafik Section -->
  <section id="clients" class="clients section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Grafik</h2>
      <p>Grafik Kebutuhan <br></p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div id="grafikKebutuhanIkanApex"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
      var options = {
        chart: {
          type: 'line',
          height: 320,
          toolbar: {
            show: false
          }
        },
        series: [{
          name: 'Kebutuhan Ikan (ton)',
          data: [1200, 1350, 1500, 1700, 1900]
        }],
        xaxis: {
          categories: ['2020', '2021', '2022', '2023', '2024'],
          title: {
            text: 'Tahun',
            style: {
              color: '#168c4a'
            }
          },
          labels: {
            style: {
              colors: ['#168c4a']
            }
          }
        },
        yaxis: {
          title: {
            text: 'Ton',
            style: {
              color: '#168c4a'
            }
          },
          labels: {
            style: {
              colors: ['#168c4a']
            }
          }
        },
        colors: ['#168c4a'],
        stroke: {
          curve: 'smooth',
          width: 4
        },
        markers: {
          size: 6,
          colors: ['#fff'],
          strokeColors: '#168c4a',
          strokeWidth: 3
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "vertical",
            shadeIntensity: 0.5,
            gradientToColors: ['#6ec1e4'],
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 0.8
          }
        },
        title: {
          text: 'Grafik Kebutuhan Ikan 5 Tahun Terakhir',
          align: 'center',
          style: {
            color: '#168c4a',
            fontSize: '20px'
          }
        },
        grid: {
          borderColor: '#d4f8e8'
        }
      };
      var chart = new ApexCharts(document.querySelector("#grafikKebutuhanIkanApex"), options);
      chart.render();
    </script>
  </section>

  <!-- Services Section -->
  <section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Peraturan Terkait</h2>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item item-cyan position-relative">
            <i class="bi bi-activity icon"></i>
            <h3>Berdasarkan PerMen KP No. 10 Tahun 2021</h3>
            <p>Standar Kegiatan Usaha dan Produk Penyelenggaraan Perizinan Berbasis Risiko di sektor Kelautan dan Perikanan</p>
            <a href="https://peraturan.bpk.go.id/Details/189816/permen-kkp-no-10-tahun-2021" target="_blank" rel="noopener noreferrer"> <span>Lihat Peraturan</span><i
                class="bi bi-arrow-right"></i></a>
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
        <p class="text-center">Aktivitas</p>
        <h4 class="text-center color-text-green">Aktivitas Kegiatan.</h4>
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
            <div class="faq-item faq-active">
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
                <span>Dolor sit amet consectetur adipiscing elit pellentesque?</span>
              </h3>
              <div class="faq-content">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus
                  pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
              <i class="faq-toggle bi bi-chevron-right"></i>
            </div>
            <div class="faq-item">
              <h3>
                <span class="num">4.</span>
                <span>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</span>
              </h3>
              <div class="faq-content">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium.
                  Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
              <i class="faq-toggle bi bi-chevron-right"></i>
            </div>
            <div class="faq-item">
              <h3>
                <span class="num">5.</span>
                <span>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</span>
              </h3>
              <div class="faq-content">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing
                  bibendum est. Purus gravida quis blandit turpis cursus in
                </p>
              </div>
              <i class="faq-toggle bi bi-chevron-right"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Aktivitas</h2>
      <p>Kegiatan Pembinaan</p>
    </div>
    <div class="container">
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          @for ($i = 1; $i <= 9; $i++)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <img src="{{ asset('landingpage/img/galeri_' . $i . '.jpg') }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <p>sortir produk</p>
                  <a href="{{ asset('landingpage/img/galeri_' . $i . '.jpg') }}" title="Branding {{ $i }}" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                      class="bi bi-zoom-in"></i></a>
                </div>
              </div>
            </div>
          @endfor
        </div>
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
            <p>+1 5589 55488 55</p>
            <p>+1 6678 254445 41</p>
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
