@extends('layouts.app')

@section('title', 'Sejarah - Yayasan Al-Munawwar')
@section('description', 'Pelajari sejarah panjang Yayasan Al-Munawwar dalam melayani pendidikan Islam dan pemberdayaan masyarakat sejak didirikan.')
@section('keywords', 'sejarah yayasan al-munawwar, sejarah pendidikan islam, latar belakang yayasan, perjalanan yayasan')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('images/background/page-title.jpg') }})">
    <div class="auto-container">
        <h2>Sejarah</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>Sejarah</li>
        </ul>
    </div>
</section>
<!-- End Page Title -->

<!-- Welcome Two -->
<section class="welcome-two">
    <div class="welcome-two_pattern" style="background-image:url(assets/images/background/welcome-two_pattern.png)"></div>
    <div class="welcome-two_pattern-two" style="background-image:url(assets/images/background/welcome-two_pattern-two.png)"></div>
    <div class="auto-container">
        <div class="row clearfix">

            <!-- Image Column -->
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_dots" style="background-image:url(assets/images/background/pattern-2.png)"></div>
                    <div class="welcome-two_dots-two" style="background-image:url(assets/images/background/pattern-2.png)"></div>
                    
                    <div class="welcome-two_image">
                        <img src="assets/images/resource/welcome-1.jpg" alt="" />
                    </div>
                    <div class="welcome-two_years d-flex align-items-center flex-wrap">
                        <span class="fa-solid fa-calendar fa-fw"></span>
                        Sejak 1995 Melayani Pendidikan Islam
                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title d-flex align-items-center">Sejarah Yayasan <span><img src="assets/images/icons/bismillah-2.png" alt="" /></span></div>
                        <h2 class="sec-title_heading">Perjalanan Panjang Al-Munawwar</h2>
                        <div class="sec-title_text">Yayasan Al-Munawwar didirikan pada tahun 1995 dengan visi mulia untuk menyediakan pendidikan Islam yang berkualitas dan terjangkau bagi seluruh lapisan masyarakat. Nama "Al-Munawwar" yang berarti "yang bercahaya" dipilih dengan harapan menjadi cahaya penerang dalam dunia pendidikan Islam.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Welcome Two -->

<!-- Institute One -->
<section class="institute-one style-two mb-5">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">Perjalanan Sejarah</div>
            <h2 class="sec-title_heading">Tonggak Penting <br> Yayasan Al-Munawwar</h2>
        </div>
        <div class="row clearfix">

            <!-- Institute Block One -->
            <div class="institute-block_one col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="institute-block_one-bismillah" style="background-image:url(assets/images/icons/bismillah-5.png)"></div>
                    <div class="institute-block_one-icon flaticon-mosque"></div>
                    <h4 class="institute-block_one-heading">1995 - Pendirian <br> Yayasan</h4>
                    <div class="institute-block_one-text">Yayasan Al-Munawwar resmi didirikan dengan fokus awal pada pendidikan anak usia dini dan pengajian masyarakat.</div>
                </div>
            </div>

            <!-- Institute Block One -->
            <div class="institute-block_one color-two col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="institute-block_one-bismillah" style="background-image:url(assets/images/icons/bismillah-5.png)"></div>
                    <div class="institute-block_one-icon flaticon-education"></div>
                    <h4 class="institute-block_one-heading">2000-2005 <br> Pendidikan Formal</h4>
                    <div class="institute-block_one-text">Membuka TK Al-Munawwar (2000) dan SD Al-Munawwar (2005) dengan kurikulum terintegrasi.</div>
                </div>
            </div>

            <!-- Institute Block One -->
            <div class="institute-block_one color-three col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="institute-block_one-bismillah" style="background-image:url(assets/images/icons/bismillah-5.png)"></div>
                    <div class="institute-block_one-icon flaticon-pray-1"></div>
                    <h4 class="institute-block_one-heading">2010 - Masjid <br> Al-Munawwar</h4>
                    <div class="institute-block_one-text">Membangun masjid sebagai pusat kegiatan ibadah dan dakwah masyarakat sekitar.</div>
                </div>
            </div>

            <!-- Institute Block One -->
            <div class="institute-block_one color-four col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="institute-block_one-bismillah" style="background-image:url(assets/images/icons/bismillah-5.png)"></div>
                    <div class="institute-block_one-icon flaticon-quran-1"></div>
                    <h4 class="institute-block_one-heading">2015 - Program <br> Tahfidz</h4>
                    <div class="institute-block_one-text">Meluncurkan program tahfidz Al-Quran untuk mencetak generasi penghafal Al-Quran.</div>
                </div>
            </div>

            <!-- Institute Block One -->
            <div class="institute-block_one color-two col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="institute-block_one-bismillah" style="background-image:url(assets/images/icons/bismillah-5.png)"></div>
                    <div class="institute-block_one-icon flaticon-give"></div>
                    <h4 class="institute-block_one-heading">2020 - Panti <br> Asuhan</h4>
                    <div class="institute-block_one-text">Membuka panti asuhan untuk memberikan perlindungan dan pendidikan bagi anak-anak yatim piatu.</div>
                </div>
            </div>

            <!-- Institute Block One -->
            <div class="institute-block_one color-three col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="institute-block_one-bismillah" style="background-image:url(assets/images/icons/bismillah-5.png)"></div>
                    <div class="institute-block_one-icon flaticon-time-management"></div>
                    <h4 class="institute-block_one-heading">2024 - Era <br> Digital</h4>
                    <div class="institute-block_one-text">Mengembangkan platform digital dan sistem informasi untuk meningkatkan kualitas layanan pendidikan.</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- End Students One -->
@endsection