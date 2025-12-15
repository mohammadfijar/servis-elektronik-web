<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Electronic Services</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="" rel="icon">
  <link href="{{asset('lp/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('lp/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('lp/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('lp/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('lp/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('lp/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{asset('lp/assets/css/main.css')}}" rel="stylesheet">

  <!-- =======================================================
  
  ======================================================== -->

  



</head>

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css"
/>

<link
  rel="stylesheet"
  type="text/css"
  href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
/>

<link
  rel="stylesheet"
  type="text/css"
  href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"
/>

<!-- sebelum </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script
  type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
<script>
  document.addEventListener( 'DOMContentLoaded', function () {
  new Splide( '#product-splide', {
  perPage : 4,      // jumlah slide per view
  gap     : '1rem',
  breakpoints: {
    992:  { perPage: 3 },
    576:  { perPage: 2 },
    0:    { perPage: 1 },
  },
} ).mount();
  } );
</script>
<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">somone @gg</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>++++</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="lp/assets/img/logo.png" alt=""> -->
          <h1 class="sitename">Terima Servis</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#team"> Product</a></li>
            </li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{ route('login.show') }}">login</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Electronic to <span>Service</span></h1>
            <p>Layanan servis terpercaya untuk perangkat elektronik Anda.</p>
            <div class="d-flex">
              <a href="#about" class="btn-get-started">Get Started</a>
              
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    <!-- About Section -->
    <section id="about" class="about section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About</h2>
        <p><span>Layanan Profesional</span> <span class="description-title">Electronic</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-3">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="https://images.unsplash.com/photo-1761857570544-83c168b5455b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1MHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="about-content ps-0 ps-lg-3">
              <h3>Electronic Authorized Service.</h3>
              <p class="fst-italic">
                pusat layanan resmi Kami menyediakan layanan servis dan perawatan untuk berbagai produk Epson, mulai dari printer, proyektor, hingga perangkat scanner, dengan standar kualitas dan keaslian suku cadang yang dijamin langsung oleh Epson Indonesia dengan tim teknisi bersertifikat dan berpengalaman, kami berkomitmen memberikan pelayanan terbaik dan solusi cepat untuk kebutuhan servis perangkat Epson Anda. Didukung oleh fasilitas yang lengkap dan sistem kerja profesional, VICTOR - Buaran menjadi pilihan terpercaya bagi pelanggan individu, bisnis, maupun institusi pendidikan
              </p>
              <ul>
                <li>
                  
                  <div>
                    <h4>Layanan Unggulan</h4>
                    <p>Perbaikan & pemeliharaan printer,Layanan servis scanner dan proyektor,Penggantian suku cadang asli Epson,Konsultasi teknis dan estimasi biaya servis</p>
                  </div>
                </li>
                
            </div>

          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          

      </div>

    </section><!-- /Clients Section -->

    <!-- Services Section -->
  <section id="services" class="services section featured-services">


    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Services</h2>
      <p><span>Check Our</span> <span class="description-title">Services</span></p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item position-relative">
            <div class="icon">
              <img src="{{asset('lp/assets/img/team/epsonprinter.png')}}" alt="Tinta Original EPSON 003 Logo">
            </div>
            <a href="#" class="stretched-link">
              <h3>Electronic EH-LS12000B</h3>
            </a>
            <p>Tinta original warna lengkap (CMYK) untuk hasil cetak tahan lama dan tajam.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="service-item position-relative">
            <div class="icon">
              <img src="{{asset('lp/assets/img/team/download4.jpeg')}}" alt="EPSON L3110 EcoTank Printer Logo">
            </div>
            <a href="#" class="stretched-link">
              <h3>EPSON L3110 EcoTank Printer</h3>
            </a>
            <p>Printer hemat tinta dengan hasil cetak berkualitas tinggi. Cocok untuk rumah atau kantor kecil.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="service-item position-relative">
            <div class="icon">
              <img src="https://images.unsplash.com/photo-1761857570544-83c168b5455b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1MHx8fGVufDB8fHx8fA%3D%3D" alt="Epson WorkForce DS-770II Logo">
            </div>
            <a href="#" class="stretched-link">
              <h3>Epson WorkForce DS-770II</h3>
            </a>
            <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="service-item position-relative">
            <div class="icon">
              <img src="https://images.unsplash.com/photo-1761857570544-83c168b5455b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1MHx8fGVufDB8fHx8fA%3D%3D" alt="Epson WorkForce DS-C330 Logo">
            </div>
            <a href="#" class="stretched-link">
              <h3>Epson WorkForce DS-C330</h3>
            </a>
            <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="service-item position-relative">
            <div class="icon">
              <img src="{{asset('lp/assets/img/team/download 99.jpg')}}" alt="Epson WorkForce ES-580W Logo">
            </div>
            <a href="#" class="stretched-link">
              <h3>Epson WorkForce ES-580W</h3>
            </a>
            <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="service-item position-relative">
            <div class="icon">
              <img src="{{asset('lp/assets/img/team/download 11.jpg')}}" alt="Epson WorkForce ES-C380W Logo">
            </div>
            <a href="#" class="stretched-link">
              <h3>Epson WorkForce ES-C380W</h3>
            </a>
            <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
          </div>
        </div><!-- End Service Item -->

      </div>

    </div>
    </section>


    <!-- Team Section -->
<section id="team" class="team section light-background">
  <div class="container section-title" data-aos="fade-up">
    <h2>Product</h2>
    <p><span></span> <span class="description-title">Product</span></p>
  </div>

  <div class="container">
    <!-- Slick Slider -->
    <div class="team-slider" data-aos="fade-up">
      <!-- Slide 1 -->
      <div class="team-member d-flex align-items-stretch">
        <div class="member-img">
          <img
            src="https://images.unsplash.com/photo-1765448638227-ac943c5698e5?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw5fHx8ZW58MHx8fHx8"
            class="img-fluid"
            alt=""
          />
        </div>
        <div class="member-info">
          <h4>EPSON L3110 EcoTank Printer</h4>
          <span>Printer hemat</span>
        </div>
      </div>
      <!-- Slide 2 -->
      <div class="team-member d-flex align-items-stretch">
        <div class="member-img">
          <img
            src="https://images.tokopedia.net/img/cache/700/product-1/2018/10/3/231447/231447_fc2b4258-2439-4c20-92c7-35e98b2524d7_1080_1080.jpg"
            class="img-fluid"
            alt=""
          />
        </div>
        <div class="member-info">
          <h4>Tinta Original EPSON 003</h4>
          <span>
            Tinta original warna lengkap (CMYK) untuk hasil cetak tahan lama
            dan tajam
          </span>
        </div>
      </div>
      <!-- Slide 3 -->
      <div class="team-member d-flex align-items-stretch">
        <div class="member-img">
          <img
            src="https://mediaserver.goepson.com/ImConvServlet/imconv/b90786d670b246159f8e5ffbb797ad94ee30c6f0/1200Wx1200H?use=banner&hybrisId=B2C&assetDescr=V39II-%282%29"
            class="img-fluid"
            alt=""
          />
        </div>
        <div class="member-info">
          <h4>EPSON Perfection V39 Scanner</h4>
          <span>
            Scanner flatbed berkualitas tinggi, ideal untuk dokumen dan foto
            resolusi tinggi
          </span>
        </div>
      </div>
      <!-- Slide 4 -->
      <div class="team-member d-flex align-items-stretch">
        <div class="member-img">
          <img
            src="https://images.unsplash.com/photo-1762887863007-26facb90ef24?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxOXx8fGVufDB8fHx8fA%3D%3D"
            class="img-fluid"
            alt=""
          />
        </div>
        <div class="member-info">
          <h4>Epson WorkForce DS-30000</h4>
          <span>
            Printer hemat tinta dengan hasil cetak berkualitas tinggi. Cocok
            untuk rumah atau kantor kecil
          </span>
        </div>
      </div>
      <!-- Tambahkan slide lain sesuai butuh -->
    </div>
  </div>
</section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p><span>Need Help?</span> <span class="description-title">Contact Us</span></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>JLjl</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p>+++</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>lespaul@gmail.com</p>
                </div>
              </div><!-- End Info Item -->
             
             <div class="map-link">
              <a
                href=""
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-primary"
              >
                Buka Peta di Google Maps
              </a>
            </div>
            </div>
          </div>

          <div class="col-lg-7">
            <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Your Name</label>
                  <input type="text" name="name" id="name-field" class="form-control" required="">
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" required="">
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Message</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
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
    </div>

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Epson</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jasa reparasi Electronic</p>
            <p>Les Paulss</p>
            <p class="mt-3"><strong>Phone:</strong> <span>++++</span></p>
            <p><strong>Email:</strong> <span>gibson@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">fijarsepta123@gmail.com</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
       
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="{{asset('lp/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('lp/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

            <script>
            $(document).ready(function () {
              $(".team-slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true,
                arrows: true,
                autoplay: false,
                speed: 300,
                responsive: [
                  {
                    breakpoint: 576,
                    settings: {
                      slidesToShow: 2
                    }
                  },
                  {
                    breakpoint: 992,
                    settings: {
                      slidesToShow: 3
                    }
                  },
                  {
                    breakpoint: 1200,
                    settings: {
                      slidesToShow: 4
                    }
                  }
                ]
              });
            });
          </script>
  <!-- Main JS File -->
  <script src="{{asset('lp/assets/js/main.js')}}"></script>


</body>

</html>