@extends('layouts.app')

@section('title', 'Beranda - Yayasan Al-Munawwar')
@section('description', 'Selamat datang di Yayasan Al-Munawwar, lembaga pendidikan Islam terpercaya yang mengintegrasikan pendidikan modern dengan nilai-nilai Islami untuk membentuk generasi yang berakhlak mulia dan berprestasi.')
@section('keywords', 'yayasan al-munawwar, beranda, pendidikan islam, sekolah islam, pesantren modern, pendidikan berkualitas')

@section('content')
<!-- Slider One -->
<section class="slider-one">
    <div class="main-slider swiper-container">
        <div class="swiper-wrapper">
            @forelse(($banners ?? []) as $banner)
            <!-- Dynamic Slide -->
            <div class="swiper-slide">
                <div class="slider-one_image-layer" style="background-image:url({{ asset('storage/' . $banner->image) }})"></div>
                <div class="auto-container">
                    <!-- Content Column -->
                    <div class="slider-one_content">
                        <div class="slider-one_content-inner">
                            <h1 class="slider-one_heading">{{ $banner->title }}</h1>
                            @if(!empty($banner->subtitle))
                            <div class="slider-one_text">{{ $banner->subtitle }}</div>
                            @endif
                            @if(!empty($banner->button_label))
                            <div class="slider-one_button">
                                <a href="{{ $banner->cta ?? route('hubungi-kami') }}" class="theme-btn btn-style-two">
                                    <span class="btn-wrap">
                                        <span class="text-one">{{ $banner->button_label }}</span>
                                        <span class="text-two">{{ $banner->button_label }}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Fallback Static Slides -->
            <div class="swiper-slide">
                <div class="slider-one_image-layer" style="background-image:url(assets/images/main-slider/1.jpg)"></div>
                <div class="auto-container">
                    <div class="slider-one_content">
                        <div class="slider-one_content-inner">
                            <h1 class="slider-one_heading">Yayasan Al-Munawwar</h1>
                            <div class="slider-one_text">Pendaftaran gelombang kedua di buka pada 15 Maret 2024 sampai 30 Maret 2024</div>
                            <div class="slider-one_button">
                                <a href="{{ route('hubungi-kami') }}" class="theme-btn btn-style-two">
                                    <span class="btn-wrap">
                                        <span class="text-one">Daftar Sekarang</span>
                                        <span class="text-two">Daftar Sekarang</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slider-one_image-layer" style="background-image:url(assets/images/main-slider/2.jpg)"></div>
                <div class="auto-container"></div>
            </div>
            <div class="swiper-slide">
                <div class="slider-one_image-layer" style="background-image:url(assets/images/main-slider/3.jpg)"></div>
                <div class="auto-container"></div>
            </div>
            @endforelse
        </div>
        <div class="slider-one-arrow">
            <!-- If we need navigation buttons -->
            <div class="main-slider-prev fas fa-arrow-left fa-fw"></div>
            <div class="main-slider-next fas fa-arrow-right fa-fw"></div>
        </div>
    </div>
</section>
<!-- End Main Slider Section -->

<!-- CTA One -->
	<section class="cta-one">
		<div class="auto-container mt-4">
			<div class="inner-container d-flex justify-content-between align-items-center flex-wrap">
				<div class="cta-one_bg" style="background-image:url(assets/images/background/cta-one_bg.png)"></div>
				<h3 class="cta-one_heading">Dapatkan informasi lengkap mengenai<br />Sekolah Islam Al-Munawwar.</h3>
				<!-- Button Box -->
				<div class="cta-one_button">
					<a href="#brochure-popup" class="theme-btn btn-style-one xs-modal-popup">
						<span class="btn-wrap">
							<span class="text-one">Unduh Brosur</span>
							<span class="text-two">Unduh Brosur</span>
						</span>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End CTA One -->

	<!-- Brochure Selection Popup -->
	<div id="brochure-popup" class="mfp-hide" style="max-width: 720px; margin: 0 auto;">
		<div class="popup-inner" style="background: #ffffff; border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); overflow: hidden;">
			<!-- Header -->
			<div class="popup-header" style="background: linear-gradient(135deg, #50bc84 0%, #F59E0B 100%); padding: 24px; color: #fff;">
				<h3 class="mb-1" style="font-weight: 800; letter-spacing: 0.2px;">Pilih Brosur yang Ingin Diunduh</h3>
				<p class="mb-0" style="opacity: 0.9;">Silakan pilih unit: TK Islam Al-Munawwar atau SD Islam Al-Munawwar</p>
			</div>

			<!-- Options -->
			<div class="popup-content" style="padding: 24px;">
				<div class="row clearfix">
					<!-- TK Option -->
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="option-card" style="background: linear-gradient(135deg, #FEF3C7 0%, #FFF 100%); border: 1px solid #FDE68A; border-radius: 12px; padding: 20px; height: 100%;">
							<div class="d-flex align-items-center mb-3">
								
								<div class="ms-3">
									<h5 class="mb-0" style="font-weight:700;">TK Islam Al-Munawwar</h5>
									<small class="text-muted">Brosur penerimaan siswa baru</small>
								</div>
							</div>
							<a href="{{ asset('storage/programs/brochures/tk-al-munawwar.pdf') }}" target="_blank" download class="theme-btn btn-style-four w-100">
								<span class="btn-wrap">
									<span class="text-one">Unduh Brosur TK</span>
									<span class="text-two">Unduh Brosur TK</span>
								</span>
							</a>
						</div>
					</div>

					<!-- SD Option -->
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="option-card" style="background: linear-gradient(135deg, #DBEAFE 0%, #FFF 100%); border: 1px solid #93C5FD; border-radius: 12px; padding: 20px; height: 100%;">
							<div class="d-flex align-items-center mb-3">
								
								<div class="ms-3">
									<h5 class="mb-0" style="font-weight:700;">SD Islam Al-Munawwar</h5>
									<small class="text-muted">Brosur penerimaan siswa baru</small>
								</div>
							</div>
							<a href="{{ asset('storage/programs/brochures/sd-al-munawwar.pdf') }}" target="_blank" download class="theme-btn btn-style-one w-100">
								<span class="btn-wrap">
									<span class="text-one">Unduh Brosur SD</span>
									<span class="text-two">Unduh Brosur SD</span>
								</span>
							</a>
						</div>
					</div>
				</div>

				<!-- Footer Note -->
				<div class="mt-3 text-center text-muted" style="font-size: 13px;">
					<i class="fa-solid fa-shield-halved fa-fw me-1"></i> File dalam format PDF. Jika tautan tidak tersedia, silakan hubungi kami.
				</div>
			</div>
		</div>
	</div>
	<!-- End Brochure Selection Popup -->

	<!-- Welcome One -->
	<section class="welcome-one">
		<div class="welcome-one_pattern" style="background-image:url({{ asset('assets/images/background/pattern-1.png') }})"></div>
		<div class="welcome-one_pattern-two" style="background-image:url({{ asset('assets/images/background/pattern-2.png') }})"></div>
		<div class="auto-container">
			<div class="row clearfix">

				<!-- Content Column -->
				<div class="welcome-one_content-column col-lg-6 col-md-12 col-sm-12">
					<div class="welcome-one_content-outer">
						<!-- Sec Title -->
						<div class="sec-title">
							<div class="sec-title_title d-flex align-items-center">Yayasan Al-Munawwar <span><img src="{{ asset('assets/images/icons/bismillah-2.png') }}" alt="" /></span></div>
							<h2 class="sec-title_heading">Sekolah Islam Terpadu Yayasan Al-Munawwar</h2>
							<div class="sec-title_text">Kami berkomitmen menghadirkan pendidikan Islam berkualitas mulai dari usia dini hingga tingkat menengah. Dengan pengajaran yang menggabungkan nilai-nilai Al-Qur’an, akhlak mulia, dan wawasan global, kami siap mendampingi tumbuh kembang anak-anak Anda.</div>
						</div>
					</div>
				</div>

				<!-- Image Column -->
				<div class="welcome-one_image-column col-lg-6 col-md-12 col-sm-12">
					<div class="welcome-one_image-outer">
						
						<div class="welcome-one_image">
							<img src="{{ asset('assets/images/resource/welcome-1.jpg') }}" alt="" />
						</div>
						<div class="welcome-one_years d-flex align-items-center flex-wrap">
							Pendidikan Berkarakter, Prestasi Unggul
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End Welcome One -->

	<!-- Featured One -->
	<section class="featured-one">
		<div class="auto-container mb-5 mt-5">
			<div class="inner-container" style="background-image:url(assets/images/icons/featured.png)">
				<div class="row clearfix">

					<!-- Feature Block One -->
					<div class="feature-block_one col-lg-4 col-md-6 col-sm-12">
						<div class="feature-block_one-inner">
							<div class="feature-block_one-icon flaticon-allah"></div>
							
							Kurikulum terpadu berbasis Al-Qur'an dan ilmu pengetahuan modern
						</div>
					</div>

					<!-- Feature Block One -->
					<div class="feature-block_one col-lg-4 col-md-6 col-sm-12">
						<div class="feature-block_one-inner">
							<div class="feature-block_one-icon flaticon-education"></div>
							Tenaga pendidik profesional dan berpengalama
						</div>
					</div>

					<!-- Feature Block One -->
					<div class="feature-block_one col-lg-4 col-md-6 col-sm-12">
						<div class="feature-block_one-inner">
							<div class="feature-block_one-icon flaticon-islamic"></div>
							Pembelajaran berkarakter Islami dan kreatif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Featured One -->

	<!-- Courses One -->
	<section class="courses-one" style="background-image:url(assets/images/background/courses-one_bg.png)">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_title">Program Yayasan (KB, SD, Panti, Masjid)</div>
				<h2 class="sec-title_heading">Program Pendidikan Kami</h2>
			</div>
			<div class="row clearfix">

				<!-- Course Block One -->
				<div class="course-block_one col-xl-3 col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInLeft"  data-wow-delay="150ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<a href="course-detail.html"><img src="assets/images/resource/course-dummy1.png" alt="" /></a>
						</div>
						<div class="course-block_one-content">
							
							<h4 class="course-block_one-heading"><a href="course-detail.html">KB & TK</a></h4>
							
							<div class="course-block_one-text">Menanamkan nilai-nilai Islam dan pembiasaan positif sejak dini melalui kegiatan belajar yang menyenangkan, kreatif, dan sesuai tahap perkembangan anak.</div>
							<div class="course-block_one-buttons d-flex justify-content-between flex-wrap">
								<a class="theme-btn course-block_one-study" href="#">Lihat Detail</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Course Block One -->
				<div class="course-block_one col-xl-3 col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInLeft"  data-wow-delay="300ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<a href="course-detail.html"><img src="assets/images/resource/course-dummy2.png" alt="" /></a>
						</div>
						<div class="course-block_one-content">
						
							<h4 class="course-block_one-heading"><a href="course-detail.html">Sekolah Dasar (SD) Islam Al-Munawwar</a></h4>
							
							<div class="course-block_one-text">Membentuk generasi Qur’ani yang cerdas, disiplin, dan berprestasi dengan kurikulum terpadu yang menggabungkan ilmu agama dan pengetahuan umum.</div>
							<div class="course-block_one-buttons d-flex justify-content-between flex-wrap">
								<a class="theme-btn course-block_one-study" href="#">Lihat Detail</a>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Course Block One -->
				<div class="course-block_one col-xl-3 col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInLeft"  data-wow-delay="450ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<a href="course-detail.html"><img src="assets/images/resource/course-dummy4.png" alt="" /></a>
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading"><a href="course-detail.html">Panti Asuhan Islam Al-Munawwar</a></h4>
							<div class="course-block_one-text">Membentuk generasi Qur’ani yang cerdas, disiplin, dan berprestasi dengan kurikulum terpadu yang menggabungkan ilmu agama dan pengetahuan umum.</div>
							<div class="course-block_one-buttons d-flex justify-content-between flex-wrap">
								<a class="theme-btn course-block_one-study" href="#">Lihat Detail</a>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Course Block One -->
				<div class="course-block_one col-xl-3 col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInLeft"  data-wow-delay="600ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<a href="course-detail.html"><img src="assets/images/resource/course-dummy3.png" alt="" /></a>
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading"><a href="course-detail.html">Masjid Islam Al-Munawwar</a></h4>
							<div class="course-block_one-text">Membentuk generasi Qur’ani yang cerdas, disiplin, dan berprestasi dengan kurikulum terpadu yang menggabungkan ilmu agama dan pengetahuan umum.</div>
							<div class="course-block_one-buttons d-flex justify-content-between flex-wrap">
								<a class="theme-btn course-block_one-study" href="#">Lihat Detail</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End Courses One -->

	<!-- Facilities One -->
	<section class="facilities-one">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_title">Fasilitas unggulan yang mendukung proses belajar mengajar.</div>
				<h2 class="sec-title_heading">Fasilitas</h2>
			</div>
			<div class="row clearfix">
				<!-- Kelas Ber-AC -->
				<div class="course-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<img src="{{ asset('assets/images/resource/service-1.jpg') }}" alt="Kelas Ber-AC" />
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading">Kelas Ber-AC</h4>
							<div class="course-block_one-text">Ruang kelas sejuk dan nyaman untuk mendukung fokus belajar siswa.</div>
						</div>
					</div>
				</div>

				<!-- Perpustakaan -->
				<div class="course-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<img src="{{ asset('assets/images/resource/service-2.jpg') }}" alt="Perpustakaan" />
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading">Perpustakaan</h4>
							<div class="course-block_one-text">Koleksi buku edukatif dan Islami untuk memperkaya wawasan siswa.</div>
						</div>
					</div>
				</div>

				<!-- Lab Komputer -->
				<div class="course-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<img src="{{ asset('assets/images/resource/service-3.jpg') }}" alt="Lab Komputer" />
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading">Lab Komputer</h4>
							<div class="course-block_one-text">Fasilitas komputer untuk pembelajaran teknologi dan literasi digital.</div>
						</div>
					</div>
				</div>

				<!-- Lapangan Indoor -->
				<div class="course-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<img src="{{ asset('assets/images/resource/service-4.jpg') }}" alt="Lapangan Indoor" />
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading">Lapangan Indoor</h4>
							<div class="course-block_one-text">Area olahraga indoor untuk kegiatan fisik yang aman dan nyaman.</div>
						</div>
					</div>
				</div>

				<!-- Kantin -->
				<div class="course-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<img src="{{ asset('assets/images/resource/service-5.jpg') }}" alt="Kantin" />
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading">Kantin</h4>
							<div class="course-block_one-text">Kantin sehat dan bersih dengan pilihan makanan bergizi untuk siswa.</div>
						</div>
					</div>
				</div>

				<!-- Aula -->
				<div class="course-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="course-block_one-inner wow fadeInRight" data-wow-delay="750ms" data-wow-duration="1000ms">
						<div class="course-block_one-image">
							<img src="{{ asset('assets/images/resource/service-6.jpg') }}" alt="Aula" />
						</div>
						<div class="course-block_one-content">
							<h4 class="course-block_one-heading">Aula</h4>
							<div class="course-block_one-text">Ruang serbaguna untuk acara sekolah, seminar, dan kegiatan islami.</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End Facilities One -->

	<!-- News One -->
	<section class="news-one">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_title">Ikuti informasi terbaru mengenai kegiatan, lomba, pengumuman pendaftaran, dan agenda sekolah Al-Munawwar.</div>
				<h2 class="sec-title_heading">Berita & Kegiatan Terkini</h2>
			</div>
			<div class="row clearfix">

				@forelse(($latestNews ?? []) as $item)
				<!-- News Block One -->
				<div class="news-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="news-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1500ms">
						<div class="news-block_one-image">
							<a href="{{ route('news.show', $item->slug) }}">
								<img src="{{ isset($item->image_url) ? (Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url)) : asset('assets/images/resource/news-placeholder.png') }}" alt="{{ $item->title }}" />
							</a>
						</div>
						<div class="news-block_one-content">
							<ul class="news-block_one-meta">
								<li><span class="icon fa-solid fa-clock fa-fw"></span>{{ ($item->published_at ?? $item->created_at)->format('F d Y') }}</li>
							</ul>
							<h5 class="news-block_one-heading"><a href="{{ route('berita.detail', $item->slug) }}">{{ $item->title }}</a></h5>
							<div class="news-block_one-text">{{ Str::limit(strip_tags($item->summary), 120) }}</div>
							<div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
								<div class="news-block_one-author">
                                    <!-- <div class="news-block_one-author_image">
                                        <img src="{{ $item->author_avatar ?? asset('images/resource/author-1.png') }}" alt="{{ $item->author_name ?? 'Admin' }}" />
                                    </div> -->
                                    {{ optional($item->createdBy)->name ?? 'Admin' }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', $item->slug ?? '#') }}">Baca Selengkapnya</a>
							</div>
						</div>
					</div>
				</div>
				@empty
				<!-- Fallback static items when no news available -->
				<div class="news-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="news-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1500ms">
						<div class="news-block_one-content">
							<h5 class="news-block_one-heading">Belum ada berita</h5>
							<div class="news-block_one-text">Konten berita akan tampil di sini setelah dipublikasikan.</div>
						</div>
					</div>
				</div>
				@endforelse

			</div>
		</div>
	</section>
	<!-- End News One -->


	<!-- CTA One -->
	<section class="cta-two">
		<div class="auto-container">
			<div class="inner-container d-flex justify-content-between align-items-center flex-wrap">
				<div class="cta-two_bg" style="background-image:url(assets/images/background/cta-one_bg.png)"></div>
				<h3 class="cta-two_heading">Raih Masa Depan Gemilang Bersama<br />Yayasan Islami Al-Munawwar</h3><br />
				<!-- Button Box -->
				<div class="cta-two_button">
					<a href="{{ route('hubungi-kami') }}" class="theme-btn btn-style-three">
						<span class="btn-wrap">
							<span class="text-one">Daftar Sekarang</span>
							<span class="text-two">Daftar Sekarang</span>
						</span>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End CTA One -->

@endsection