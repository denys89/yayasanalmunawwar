@extends('layouts.app')

@section('title', 'Masjid Al Munawwar - Yayasan Al-Munawwar')
@section('description', 'Masjid Al Munawwar adalah pusat kegiatan ibadah dan dakwah yang melayani masyarakat dengan berbagai program keagamaan dan sosial.')
@section('keywords', 'Masjid Al Munawwar, ibadah, dakwah, kajian Islam, sholat, Yayasan Al-Munawwar')

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('images/background/page-title.jpg') }});">
    <div class="auto-container">
        <h2>Masjid Al Munawwar</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>Masjid Al Munawwar</li>
        </ul>
    </div>
</section>



<div class="green-theme">

<!-- Masjid Al Munawwar Section -->
<section class="welcome-two" style="padding: 120px 0; position: relative;">
    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/icons/pattern-1.png') }});"></div>
    <div class="pattern-layer-two" style="background-image: url({{ asset('assets/images/icons/pattern-2.png') }});"></div>
    
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- Image Column -->
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
            
            <!-- Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title">MASJID AL MUNAWWAR</div>
                        <h2 class="sec-title_heading">Pusat Ibadah & Dakwah <br> Umat Islam</h2>
                        <div class="sec-title_text">Masjid Al Munawwar adalah pusat kegiatan ibadah dan dakwah yang melayani masyarakat dengan berbagai program keagamaan, sosial, dan pendidikan untuk memperkuat ukhuwah Islamiyah dan membangun generasi yang beriman dan bertakwa.</div>
                    </div>
                    
                    <!-- Welcome Two Blocks -->
                    <div class="welcome-two_blocks">
                        
                        <!-- Welcome Block Two -->
                        <div class="welcome-block_two">
                            <div class="welcome-block_two-inner">
                                <div class="welcome-block_two-icon"><i class="fas fa-mosque" style="font-size: 24px; color: #28a745;"></i></div>
                                <h5 class="welcome-block_two-heading">Pusat Ibadah</h5>
                                <div class="welcome-block_two-text">Menyediakan tempat ibadah yang nyaman dan khusyuk untuk sholat lima waktu, sholat Jumat, dan berbagai kegiatan keagamaan lainnya.</div>
                            </div>
                        </div><br />
                        
                        <!-- Welcome Block Two -->
                        <div class="welcome-block_two">
                            <div class="welcome-block_two-inner">
                                <div class="welcome-block_two-icon"><i class="fas fa-quran" style="font-size: 24px; color: #28a745;"></i></div>
                                <h5 class="welcome-block_two-heading">Pusat Dakwah</h5>
                                <div class="welcome-block_two-text">Menyelenggarakan kajian Islam, ceramah agama, dan program dakwah untuk masyarakat sekitar dalam rangka menyebarkan nilai-nilai Islam.</div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
        
        <!-- Komitmen Section -->
        <div class="row clearfix" style="margin-top: 80px;">
            
            <!-- Content Column -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <div class="sec-title">
                        <div class="sec-title_title">KOMITMEN KAMI</div>
                        <h3 class="sec-title_heading">Membangun Generasi <br> Rabbani</h3>
                        <div class="sec-title_text">Kami berkomitmen untuk menjadi pusat spiritual yang memberikan pencerahan rohani, pendidikan agama yang berkualitas, dan pelayanan sosial yang bermanfaat bagi umat Islam dan masyarakat sekitar.</div>
                    </div>
                </div>
            </div>
            
            <!-- Image Column -->
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_image">
                        <img src="{{ asset('images/resource/welcome-2.jpg') }}" alt="Interior Masjid Al Munawwar" />
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
            <div class="sec-title_title">KEGIATAN & LAYANAN</div>
            <h2 class="sec-title_heading">Program Ibadah & Dakwah <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text">Berbagai kegiatan dan layanan yang tersedia di Masjid Al Munawwar untuk memenuhi kebutuhan spiritual dan sosial umat Islam.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-praying-hands" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Sholat Berjamaah</h5>
                    <div class="service-block_one-text">Sholat lima waktu berjamaah dengan imam yang berpengalaman dan suara yang merdu dalam suasana yang khusyuk.</div>
                    <ul class="service-block_one-list">
                        <li>Sholat 5 waktu berjamaah</li>
                        <li>Sholat Jumat dengan khutbah</li>
                        <li>Sholat Tarawih & Witir</li>
                        <li>Sholat Ied & hari besar Islam</li>
                    </ul>
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-quran" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Kajian Al-Quran</h5>
                    <div class="service-block_one-text">Kajian tafsir Al-Quran dan hadits yang diselenggarakan rutin untuk memperdalam pemahaman agama.</div>
                    <ul class="service-block_one-list">
                        <li>Tafsir Al-Quran mingguan</li>
                        <li>Kajian hadits Nabi SAW</li>
                        <li>Diskusi fiqh kontemporer</li>
                        <li>Halaqah tahfidz Al-Quran</li>
                    </ul>
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-moon" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Program Ramadhan</h5>
                    <div class="service-block_one-text">Kegiatan khusus bulan Ramadhan untuk meningkatkan ketakwaan dan kebersamaan umat.</div>
                    <ul class="service-block_one-list">
                        <li>Sholat Tarawih & Tahajud</li>
                        <li>Tadarus Al-Quran bersama</li>
                        <li>Buka puasa bersama</li>
                        <li>Kajian khusus Ramadhan</li>
                    </ul>
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-graduation-cap" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">TPA/TPQ</h5>
                    <div class="service-block_one-text">Taman Pendidikan Al-Quran untuk anak-anak belajar membaca Al-Quran dengan metode yang menyenangkan.</div>
                    <ul class="service-block_one-list">
                        <li>Belajar baca tulis Al-Quran</li>
                        <li>Hafalan surat-surat pendek</li>
                        <li>Pendidikan akhlak Islami</li>
                        <li>Kegiatan kreatif Islami</li>
                    </ul>
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-ring" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Akad Nikah</h5>
                    <div class="service-block_one-text">Pelayanan akad nikah dengan prosedur yang sesuai syariat Islam dalam suasana yang sakral.</div>
                    <ul class="service-block_one-list">
                        <li>Konsultasi pra nikah</li>
                        <li>Akad nikah sesuai syariat</li>
                        <li>Bimbingan keluarga sakinah</li>
                        <li>Sertifikat nikah resmi</li>
                    </ul>
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-hand-holding-heart" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Zakat & Infaq</h5>
                    <div class="service-block_one-text">Pengelolaan zakat, infaq, dan sedekah untuk disalurkan kepada yang berhak dengan transparan.</div>
                    <ul class="service-block_one-list">
                        <li>Penerimaan zakat fitrah & mal</li>
                        <li>Distribusi kepada mustahiq</li>
                        <li>Program bantuan sosial</li>
                        <li>Laporan keuangan transparan</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Schedule Section -->
<section class="institute-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">JADWAL KEGIATAN</div>
            <h2 class="sec-title_heading">Waktu Ibadah & Kegiatan <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text">Jadwal kegiatan rutin di Masjid Al Munawwar untuk memudahkan jamaah dalam mengikuti berbagai program ibadah dan dakwah.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Institute Block One -->
            <div class="institute-block_one col-lg-6 col-md-12 col-sm-12">
                <div class="institute-block_one-inner">
                    <div class="institute-block_one-icon"><i class="fas fa-praying-hands" style="font-size: 24px; color: #28a745;"></i></div>
                    <h4 class="institute-block_one-heading">Jadwal Sholat Harian</h4>
                    <div class="institute-block_one-text">
                        <strong>Subuh:</strong> 04:30 WIB<br>
                        <strong>Dzuhur:</strong> 12:00 WIB<br>
                        <strong>Ashar:</strong> 15:30 WIB<br>
                        <strong>Maghrib:</strong> 18:00 WIB<br>
                        <strong>Isya:</strong> 19:30 WIB
                    </div>
                </div>
            </div>
            
            <!-- Institute Block One -->
            <div class="institute-block_one col-lg-6 col-md-12 col-sm-12">
                <div class="institute-block_one-inner">
                    <div class="institute-block_one-icon"><i class="fas fa-calendar-alt" style="font-size: 24px; color: #28a745;"></i></div>
                    <h4 class="institute-block_one-heading">Kegiatan Mingguan</h4>
                    <div class="institute-block_one-text">
                        <strong>Senin:</strong> Kajian Tafsir (19:30)<br>
                        <strong>Rabu:</strong> TPA/TPQ (16:00)<br>
                        <strong>Jumat:</strong> Sholat Jumat (12:00)<br>
                        <strong>Sabtu:</strong> Kajian Hadits (19:30)<br>
                        <strong>Minggu:</strong> Pengajian Umum (08:00)
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Facilities Section -->
<section class="about-one" style="padding: 120px 0;">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- Content Column -->
            <div class="about-one_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="about-one_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title">FASILITAS MASJID</div>
                        <h2 class="sec-title_heading">Fasilitas Lengkap <br> untuk Kenyamanan Jamaah</h2>
                        <div class="sec-title_text">Masjid Al Munawwar dilengkapi dengan fasilitas yang lengkap dan nyaman untuk mendukung kegiatan ibadah, dakwah, dan sosial kemasyarakatan.</div>
                    </div>
                    
                    <!-- About List -->
                    <ul class="about-one_list">
                        <li><i class="fa fa-check"></i>Ruang sholat utama berkapasitas 500 jamaah</li>
                        <li><i class="fa fa-check"></i>Ruang sholat wanita yang terpisah</li>
                        <li><i class="fa fa-check"></i>Tempat wudhu pria dan wanita</li>
                        <li><i class="fa fa-check"></i>Perpustakaan Islam dengan koleksi lengkap</li>
                        <li><i class="fa fa-check"></i>Ruang kajian dan seminar</li>
                        <li><i class="fa fa-check"></i>Aula serbaguna untuk acara besar</li>
                        <li><i class="fa fa-check"></i>Tempat parkir yang luas</li>
                        <li><i class="fa fa-check"></i>Sound system dan AC</li>
                    </ul>
                    
                </div>
            </div>
            
            <!-- Image Column -->
            <div class="about-one_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="about-one_image-outer">
                    <div class="about-one_image">
                        <img src="{{ asset('images/resource/welcome-2.jpg') }}" alt="Fasilitas Masjid Al Munawwar" />
                    </div>
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
            <div class="sec-title_title">INFAQ & SEDEKAH</div>
            <h2 class="sec-title_heading">Mari Berpartisipasi <br> Membangun Masjid</h2>
            <div class="sec-title_text">Berpartisipasi dalam pembangunan, operasional, dan program dakwah Masjid Al Munawwar untuk kemajuan umat Islam.</div>
        </div>
        <div class="row clearfix">

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-mosque" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Pembangunan Masjid</h5>
                    <div class="featured-block_one-text">
                        Berpartisipasi dalam pembangunan dan renovasi fasilitas masjid untuk kenyamanan jamaah dalam beribadah.
                    </div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-bolt" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Operasional Masjid</h5>
                    <div class="featured-block_one-text">
                        Membantu biaya operasional harian seperti listrik, air, kebersihan, dan pemeliharaan fasilitas masjid.
                    </div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-book-open" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Program Dakwah</h5>
                    <div class="featured-block_one-text">
                        Mendukung program dakwah, kajian, dan kegiatan pendidikan Islam untuk kemajuan umat.
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Donation Info -->
        <div class="donation-info" style="text-align: center; margin-top: 60px; padding: 40px; background: #f8f9fa; border-radius: 10px;">
            <h4 style="color: #2c5aa0; margin-bottom: 20px;">Rekening Infaq Masjid</h4>
            <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
                <div>
                    <strong>Bank Mandiri:</strong><br>
                    987-654-321<br>
                    a.n. Masjid Al Munawwar
                </div>
                <div>
                    <strong>Bank BRI:</strong><br>
                    123-987-456<br>
                    a.n. Takmir Masjid Al Munawwar
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
            <h2 class="sec-title_heading">Informasi Kontak <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text">Untuk informasi lebih lanjut tentang kegiatan, jadwal sholat, atau program dakwah di Masjid Al Munawwar, silakan hubungi kami.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-phone" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Telepon</h4>
                    <div class="contact-info-block_text">
                        <a href="tel:+62123456792">(021) 8765-434</a><br>
                        <a href="tel:+628123456792">0812-3456-792</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-envelope" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Email</h4>
                    <div class="contact-info-block_text">
                        <a href="mailto:masjid@almunawwar.sch.id">masjid@almunawwar.sch.id</a><br>
                        <a href="mailto:takmir@almunawwar.sch.id">takmir@almunawwar.sch.id</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-map-marker-alt" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Alamat</h4>
                    <div class="contact-info-block_text">
                        Jl. Masjid Raya No. 129<br>
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