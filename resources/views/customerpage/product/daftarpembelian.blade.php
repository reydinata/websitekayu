<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Woodland example</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('customerview2/assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('customerview2/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('customerview2/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('customerview2/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('customerview2/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('customerview2/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('customerview2/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('customerview2/assets/css/main.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Dewi
  * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="portfolio-details-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Woodland</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Product</a></li>
          <li><a href="#rating">Rating</a></li>
          <li><a href="#team">Team</a></li>
          {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> --}}
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>


    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
      <div class="container position-relative">
        <h1>Buying List</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Buying List</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
<div>
     <div class="container mt-5">
    <div class="card mb-4">
        <div class="card-body">
        <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Wood</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                       @if(count($penjualans) > 0)
       @foreach($penjualans as $p)
         <tr >
             <td>{{$p->kode_penjualan}}</td>
             <td>{{$p->nama_kayu}}</td>
             <td>{{$p->jumlah_beli}}</td>
             <td>{{$p->harga_kayu}}</td>
             <td>{{$p->total}}</td>
             <td>{{$p->status}}</td>
             <td>{{$p->created_at}}</td>
             <td>{{$p->updated_at}}</td>
          <td>
        @if($p->status === 'selesai' && !$p->sudah_dirating)
            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                data-bs-target="#ratingModal"
                onclick="openRatingModal({{ $p->id }}, '{{ $p->nama_kayu }}')">
                Beri Rating
            </button>
            @elseif($p->status === 'proses' && !$p->pembayarans_id && !$p->bukti_pembayaran)
  <button class="btn btn-primary btn-sm"  onclick="openBayarModal({{ $p->id }}, '{{ $p->kode_penjualan }}', '{{ $p->total }}')" data-bs-toggle="modal" data-bs-target="#bayarModal">Bayar</button>
        @elseif($p->sudah_dirating)
            <span class="text-muted">Sudah dinilai</span>
        @else
            <span class="text-muted">-</span>
        @endif
    </td>

         </tr>
       @endforeach
     @else
       <tr>
         <td colspan="8" style="text-align: center">No data found.</td>
       </tr>
     @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
     </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="{{asset('adminview3/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('adminview3/assets/js/plugin/datatables/datatables.min.js')}}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{asset('adminview3/assets/js/kaiadmin.min.js')}}"></script>

<script>
 $("#basic-datatables").DataTable({});
</script>
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('rating.store') }}">
      @csrf
      <input type="hidden" name="penjualan_id" id="penjualan_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Beri Rating</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p id="namaKayuInfo"></p>
          <div class="form-group">
            <label for="rating">Rating (1–5)</label>
            <select name="rating" class="form-control" required>
              <option value="">Pilih rating</option>
              @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}">{{ $i }} ★</option>
              @endfor
            </select>
          </div>
          <div class="form-group mt-3">
            <label for="ulasan">Ulasan</label>
            <textarea name="ulasan" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Kirim Rating</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- Modal Bayar -->
<div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="bayarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('penjualan.bayar.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <input type="hidden" name="penjualan_id" id="bayar_penjualan_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bayarModalLabel">Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">

          <!-- Kode Penjualan dan Total -->
          <div class="mb-2">
            <label for="">Kode Penjualan:</label>
            <input type="text" id="kode_penjualan_display" class="form-control" readonly>
          </div>

          <div class="mb-3">
            <label for="">Total:</label>
            <input type="text" id="total_display" class="form-control" readonly>
          </div>

          <!-- Dropdown Metode Pembayaran -->
          <div class="mb-3">
            <label for="pembayarans_id" class="form-label">Metode Pembayaran</label>
            <select name="pembayarans_id" id="pembayaran_select" class="form-control" required onchange="showPaymentInfo(this)">
              <option value="">-- Pilih Metode --</option>
              @foreach($metodePembayaran as $m)
                <option value="{{ $m->id }}"
                  data-bank="{{ $m->nama_bank }}"
                  data-rekening="{{ $m->nomor_rekening }}">
                  {{ $m->metode_pembayaran }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Info Bank -->
          <div id="payment-info" style="display: none;">
            <div class="mb-1"><strong>Bank:</strong> <span id="bank_info"></span></div>
            <div class="mb-3"><strong>No. Rekening:</strong> <span id="rekening_info"></span></div>
          </div>

          <!-- Upload Bukti Pembayaran -->
          <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control" accept="image/*" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Bayar Sekarang</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
  function openRatingModal(penjualanId, namaKayu) {
    document.getElementById('penjualan_id').value = penjualanId;
    document.getElementById('namaKayuInfo').innerText = "Kayu: " + namaKayu;
  }

</script>
<script>
function openBayarModal(penjualanId, kodePenjualan, total) {
  document.getElementById('bayar_penjualan_id').value = penjualanId;
  document.getElementById('kode_penjualan_display').value = kodePenjualan;
  document.getElementById('total_display').value = total;
  document.getElementById('payment-info').style.display = 'none';
}

function showPaymentInfo(select) {
  const selectedOption = select.options[select.selectedIndex];
  const bank = selectedOption.getAttribute('data-bank');
  const rekening = selectedOption.getAttribute('data-rekening');

  document.getElementById('bank_info').innerText = bank;
  document.getElementById('rekening_info').innerText = rekening;

  document.getElementById('payment-info').style.display = 'block';
}
</script>



      </div>

    </section><!-- /Portfolio Details Section -->

  </main>
 <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Woodland</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Woodland</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('customerview2/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('customerview2/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ asset('customerview2/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('customerview2/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('customerview2/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{ asset('customerview2/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('customerview2/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{ asset('customerview2/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Main JS File -->
  <script src="{{ asset('customerview2/assets/js/main.js')}}"></script>
  <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-wide">
        <div class="modal-content">
            <div class="modal-body" id="modalContent">

            </div>
        </div>
    </div>
</div>
{{-- <script>
    function getInputForm(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("customerpage.product.getInputForm") }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function(data) {
                $('#modalContent').html(data.msg);
            },
            error: function(xhr) {
                alert("Gagal mengambil data. Silakan coba lagi.");
                console.error(xhr.responseText);
            }
        });
    }
</script> --}}

</body>

</html>
