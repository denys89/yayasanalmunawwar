@extends('layouts.app')

@section('title', 'Panti Al Munawwar - Yayasan Al-Munawwar')
@section('description', 'Panti Al Munawwar adalah lembaga sosial yang memberikan pelayanan dan pendampingan kepada anak-anak yatim piatu dan dhuafa.')
@section('keywords', 'Panti Al Munawwar, panti asuhan, yatim piatu, dhuafa, sosial, Yayasan Al-Munawwar')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

@section('content')


<div class="green-theme">

<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('images/background/page-title.jpg') }});">
    <div class="auto-container">
        <h2>Panti Al Munawwar</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>Panti Al Munawwar</li>
        </ul>
    </div>
</section>

<!-- Panti Al Munawwar Section -->
<section class="welcome-two" style="padding: 120px 0; background-image: url({{ asset('assets/images/background/pattern-1.png') }}); background-repeat: no-repeat; background-position: left center;">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Welcome Two Image Column -->
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_image">
                        <img src="{{ asset('images/resource/welcome-1.jpg') }}" alt="Panti Al Munawwar" />
                    </div>
                </div>
            </div>
            
            <!-- Welcome Two Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title">PANTI AL MUNAWWAR</div>
                        <h2 class="sec-title_heading">Rumah Kasih Sayang <br> untuk Anak Yatim</h2>
                        <div class="sec-title_text">Panti Al Munawwar adalah lembaga sosial yang memberikan pelayanan dan pendampingan kepada anak-anak yatim piatu dan dhuafa dengan kasih sayang, pendidikan, dan pembinaan karakter yang Islami.</div>
                    </div>
                    
                </div>
            </div>
            
        </div>

    </div>
</section>

<!-- Services Section -->
<section class="service-one" style="background-image: url({{ asset('assets/images/background/service-bg.png') }}); padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">LAYANAN KAMI</div>
            <h2 class="sec-title_heading">Pelayanan Terpadu <br> untuk Anak Asuh</h2>
            <div class="sec-title_text">Berbagai layanan komprehensif yang kami berikan untuk memastikan kesejahteraan, pendidikan, dan perkembangan optimal anak-anak asuh.</div>
        </div>
        <div class="row clearfix">

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-home" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Tempat Tinggal<br /> Nyaman</a></h5>
                    <div class="service-block_one-text">Menyediakan tempat tinggal yang nyaman, aman, dan layak dengan fasilitas lengkap untuk kehidupan sehari-hari anak asuh.</div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-book" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Pendidikan<br/>Formal</a></h5>
                    <div class="service-block_one-text">Memfasilitasi pendidikan formal dari SD hingga SMA serta pendidikan agama dan tahfidz Al-Quran untuk masa depan cerah.</div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-stethoscope" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Layanan<br/>Kesehatan</a></h5>
                    <div class="service-block_one-text">Pelayanan kesehatan rutin dan pengobatan komprehensif untuk menjaga kesehatan fisik dan mental anak asuh.</div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-utensils" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Gizi & Makanan</a></h5>
                    <div class="service-block_one-text">Menyediakan makanan bergizi seimbang dan halal untuk mendukung tumbuh kembang optimal anak asuh.</div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-tools" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Pelatihan<br /> Keterampilan</a></h5>
                    <div class="service-block_one-text">Pelatihan keterampilan hidup dan vokasional untuk mempersiapkan kemandirian dan masa depan anak asuh.</div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-comments" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Bimbingan<br />Konseling</a></h5>
                    <div class="service-block_one-text">Bimbingan konseling profesional untuk perkembangan psikologis, emosional, dan spiritual anak asuh.</div>
                    
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Donation Section -->
<section class="featured-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">CARA BERDONASI</div>
            <h2 class="sec-title_heading">Bergabunglah Membantu <br> Anak Yatim Piatu</h2>
            <div class="sec-title_text">Berbagai cara mudah untuk berdonasi dan membantu anak-anak yatim piatu dan dhuafa melalui Panti Al Munawwar.</div>
        </div>
        <div class="row clearfix">

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-university" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Transfer Bank</h5>
                    <div class="featured-block_one-text">
                        Bank Mandiri<br>
                        No. Rek: 123-456-789<br>
                        a.n. Yayasan Al-Munawwar
                    </div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-wallet" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">E-Wallet Digital</h5>
                    <div class="featured-block_one-text">
                        GoPay: 0812-3456-7890<br>
                        OVO: 0812-3456-7890<br>
                        DANA: 0812-3456-7890
                    </div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-hand-holding-heart" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Donasi Langsung</h5>
                    <div class="featured-block_one-text">
                        Kunjungi langsung kantor<br>
                        Yayasan Al-Munawwar<br>
                        Setiap hari kerja 08:00-16:00
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">HUBUNGI KAMI</div>
            <h2 class="sec-title_heading">Informasi Kontak <br> Panti Al Munawwar</h2>
            <div class="sec-title_text">Untuk informasi lebih lanjut tentang program, donasi, atau kunjungan ke Panti Al Munawwar, silakan hubungi kami melalui kontak di bawah ini.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-phone" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Telepon</h4>
                    <div class="contact-info-block_text">
                        <a href="tel:+62123456791">(021) 8765-433</a><br>
                        <a href="tel:+628123456791">0812-3456-791</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-envelope" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Email</h4>
                    <div class="contact-info-block_text">
                        <a href="mailto:panti@almunawwar.sch.id">panti@almunawwar.sch.id</a><br>
                        <a href="mailto:info@almunawwar.sch.id">info@almunawwar.sch.id</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-map-marker-alt" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Alamat</h4>
                    <div class="contact-info-block_text">
                        Jl. Sosial No. 127<br>
                        Bogor Raya, Jawa Barat 40123<br>
                        Indonesia 12345
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Contact Form Box -->
        <div class="contact-form_box">
            <div class="auto-container">
                <h4>Hubungi Kami untuk Konsultasi dan Pendaftaran</h4>

                <!-- Contact Form -->
                <div class="contact-form">
                    <form method="post" action="sendemail.php" id="contact-form">
                        
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Nama Lengkap" required="">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Alamat Email" required="">
                        </div>
                        
                        <div class="form-group">
                            <textarea class="" name="message" placeholder="Ketik pesanmu di sini"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <!-- Button Box -->
                            <div class="button-box">
                                <button type="submit" class="theme-btn btn-style-four">
                                    <span class="btn-wrap">
                                        <span class="text-one">Kirim Pesan</span>
                                        <span class="text-two">Kirim Pesan</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <!-- End Comment Form -->

            </div>
        </div>
        <!-- End Contact Form Box -->
    </div>
</section>
</div>
@endsection