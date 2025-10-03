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
                    <!-- Ameen -->
                    <div class="welcome-two_ameen">
                        <img src="{{ asset('assets/images/icons/ameen-1.png') }}" alt="" />
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
                    <!-- Welcome Two Blocks -->
                    <div class="welcome-two_blocks">
                        
                        <!-- Welcome Two Block -->
                        <div class="welcome-two_block">
                            <div class="welcome-two_block-inner">
                                <div class="welcome-two_block-icon"><i class="fas fa-heart" style="font-size: 24px; color: #28a745;"></i></div>
                                <h5 class="welcome-two_block-heading">Kasih Sayang Keluarga</h5>
                                <div class="welcome-two_block-text">Memberikan kasih sayang dan perhatian seperti keluarga kepada setiap anak asuh dengan penuh cinta dan kelembutan.</div>
                            </div>
                        </div>
                    <br />
                        
                        <!-- Welcome Two Block -->
                        <div class="welcome-two_block">
                            <div class="welcome-two_block-inner">
                                <div class="welcome-two_block-icon"><i class="fas fa-graduation-cap" style="font-size: 24px; color: #28a745;"></i></div>
                                <h5 class="welcome-two_block-heading">Pendidikan Berkualitas</h5>
                                <div class="welcome-two_block-text">Menyediakan pendidikan formal dan non-formal yang berkualitas untuk mempersiapkan masa depan cerah anak asuh.</div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
        
        <!-- Komitmen Section -->
        <div class="row clearfix" style="margin-top: 80px;">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <div class="sec-title">
                        <div class="sec-title_title">KOMITMEN KAMI</div>
                        <h3 class="sec-title_heading">Membangun Generasi <br> Berakhlak Mulia</h3>
                        <div class="sec-title_text">Kami berkomitmen untuk memberikan yang terbaik bagi setiap anak asuh, mulai dari kebutuhan dasar hingga pendidikan dan pembinaan karakter yang akan membentuk mereka menjadi generasi yang berakhlak mulia dan bermanfaat bagi masyarakat.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_image">
                        <img src="{{ asset('images/resource/welcome-2.jpg') }}" alt="Komitmen Panti Al Munawwar" />
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
                    <ul class="service-block_one-list">
                        <li>Kamar tidur yang nyaman dan bersih</li>
                        <li>Ruang belajar dan bermain</li>
                        <li>Fasilitas mandi dan cuci yang memadai</li>
                        <li>Keamanan 24 jam</li>
                    </ul>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-book" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Pendidikan<br/>Formal</a></h5>
                    <div class="service-block_one-text">Memfasilitasi pendidikan formal dari SD hingga SMA serta pendidikan agama dan tahfidz Al-Quran untuk masa depan cerah.</div>
                    <ul class="service-block_one-list">
                        <li>Biaya sekolah dan perlengkapan</li>
                        <li>Bimbingan belajar tambahan</li>
                        <li>Pendidikan agama dan tahfidz</li>
                        <li>Program beasiswa lanjutan</li>
                    </ul>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-stethoscope" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Layanan<br/>Kesehatan</a></h5>
                    <div class="service-block_one-text">Pelayanan kesehatan rutin dan pengobatan komprehensif untuk menjaga kesehatan fisik dan mental anak asuh.</div>
                    <ul class="service-block_one-list">
                        <li>Pemeriksaan kesehatan berkala</li>
                        <li>Pengobatan dan perawatan medis</li>
                        <li>Imunisasi dan vaksinasi</li>
                        <li>Konsultasi psikologi</li>
                    </ul>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-utensils" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Gizi & Makanan</a></h5>
                    <div class="service-block_one-text">Menyediakan makanan bergizi seimbang dan halal untuk mendukung tumbuh kembang optimal anak asuh.</div>
                    <ul class="service-block_one-list">
                        <li>Menu makanan bergizi seimbang</li>
                        <li>Makanan halal dan higienis</li>
                        <li>Susu dan vitamin tambahan</li>
                        <li>Diet khusus sesuai kebutuhan</li>
                    </ul>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-tools" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Pelatihan<br /> Keterampilan</a></h5>
                    <div class="service-block_one-text">Pelatihan keterampilan hidup dan vokasional untuk mempersiapkan kemandirian dan masa depan anak asuh.</div>
                    <ul class="service-block_one-list">
                        <li>Keterampilan hidup sehari-hari</li>
                        <li>Pelatihan vokasional</li>
                        <li>Kewirausahaan dan bisnis</li>
                        <li>Soft skills dan leadership</li>
                    </ul>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-comments" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">Bimbingan<br />Konseling</a></h5>
                    <div class="service-block_one-text">Bimbingan konseling profesional untuk perkembangan psikologis, emosional, dan spiritual anak asuh.</div>
                    <ul class="service-block_one-list">
                        <li>Konseling individual dan kelompok</li>
                        <li>Terapi trauma dan healing</li>
                        <li>Pengembangan karakter</li>
                        <li>Bimbingan spiritual</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="about-one" style="padding: 120px 0;">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- Content Column -->
            <div class="about-one_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="about-one_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title">PROGRAM PEMBINAAN</div>
                        <h2 class="sec-title_heading">Mengembangkan Potensi <br> dan Karakter Anak</h2>
                        <div class="sec-title_text">Program-program pembinaan yang dirancang khusus untuk mengembangkan potensi, karakter, dan kemandirian anak asuh dengan pendekatan holistik dan Islami.</div>
                    </div>
                    
                    <!-- About List -->
                    <ul class="about-one_list">
                        <li><i class="fa fa-check"></i>Pembinaan akhlak dan karakter Islami</li>
                        <li><i class="fa fa-check"></i>Tahfidz Al-Quran dan kajian agama</li>
                        <li><i class="fa fa-check"></i>Bimbingan belajar dan les tambahan</li>
                        <li><i class="fa fa-check"></i>Pelatihan keterampilan dan life skill</li>
                        <li><i class="fa fa-check"></i>Kegiatan olahraga dan seni budaya</li>
                        <li><i class="fa fa-check"></i>Program beasiswa pendidikan tinggi</li>
                        <li><i class="fa fa-check"></i>Pendampingan hingga mandiri</li>
                    </ul>
                    
                </div>
            </div>
            
            <!-- Image Column -->
            <div class="about-one_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="about-one_image-outer">
                    <div class="about-one_image">
                        <img src="{{ asset('images/resource/welcome-2.jpg') }}" alt="Program Panti Al Munawwar" />
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>


<!-- Donation Section -->
<section class="featured-one" style="padding: 120px 0; display:none;">
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
    </div>
</section>
</div>
@endsection