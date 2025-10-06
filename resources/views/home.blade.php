@extends('layouts.app')

@section('title', 'Beranda - Yayasan Al-Munawwar')
@section('description', 'Selamat datang di Yayasan Al-Munawwar, lembaga pendidikan Islam terpercaya yang mengintegrasikan pendidikan modern dengan nilai-nilai Islami untuk membentuk generasi yang berakhlak mulia dan berprestasi.')
@section('keywords', 'yayasan al-munawwar, beranda, pendidikan islam, sekolah islam, pesantren modern, pendidikan berkualitas')

@section('content')
<!-- Slider One -->
<section class="slider-one">
	<div class="main-slider swiper-container">
		<div class="swiper-wrapper">

			<!-- Slide -->
			<div class="swiper-slide">
				<div class="slider-one_image-layer" style="background-image:url(assets/images/main-slider/1.jpg)"></div>
				<div class="auto-container">
					<!-- Content Column -->
					<div class="slider-one_content">
						<div class="slider-one_content-inner">
							<h1 class="slider-one_heading">Yayasan Al-Munawwar</h1>
							<div class="slider-one_text">Pendaftaran gelombang kedua di buka pada 15 Maret 2024 sampai 30 Maret 2024</div>
							<div class="slider-one_button">
								<a href="course-detail.html" class="theme-btn btn-style-two">
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

			<!-- Slide -->
			<div class="swiper-slide">
				<div class="slider-one_image-layer" style="background-image:url(assets/images/main-slider/2.jpg)"></div>
				<div class="auto-container">
					
					
					
				</div>
			</div>

			<!-- Slide -->
			<div class="swiper-slide">
				<div class="slider-one_image-layer" style="background-image:url(assets/images/main-slider/3.jpg)"></div>
				<div class="auto-container">
					
					
					
				</div>
			</div>

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
					<a href="{{ route('hubungi-kami') }}" class="theme-btn btn-style-one">
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


	<!-- News One -->
	<section class="news-one">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_title">Ikuti informasi terbaru mengenai kegiatan, lomba, pengumuman pendaftaran, dan agenda sekolah Al-Munawwar.</div>
				<h2 class="sec-title_heading">Berita & Kegiatan Terkini</h2>
			</div>
			<div class="row clearfix">

				<!-- News Block One -->
				<div class="news-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="news-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1500ms">
						<div class="news-block_one-image">
							<a href="news-detail.html"><img src="assets/images/resource/news-funcamp.png" alt="" /></a>
						</div>
						<div class="news-block_one-content">
							<ul class="news-block_one-meta">
								<li><span class="icon fa-solid fa-clock fa-fw"></span>October 18 2025</li>
							</ul>
							<h5 class="news-block_one-heading"><a href="news-detail.html">FunCamp Kb-Tk Al-Munawwar 2025</a></h5>
							<div class="news-block_one-text">There are many variations of passages of lorem Ipsum available islam courses</div>
							<div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
								<a class="news-block_one-more theme-btn" href="news-detail.html">read more</a>
							</div>
						</div>
					</div>
				</div>

				<!-- News Block One -->
				<div class="news-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="news-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1500ms">
						<div class="news-block_one-image">
							<a href="news-detail.html"><img src="assets/images/resource/news-hari-ayah.png" alt="" /></a>
						</div>
						<div class="news-block_one-content">
							<ul class="news-block_one-meta">
								<li><span class="icon fa-solid fa-clock fa-fw"></span>October 18 2025</li>
							</ul>
							<h5 class="news-block_one-heading"><a href="news-detail.html">Hari Ayah</a></h5>
							<div class="news-block_one-text">There are many variations of passages of lorem Ipsum available islam courses</div>
							<div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
								
								<a class="news-block_one-more theme-btn" href="news-detail.html">read more</a>
							</div>
						</div>
					</div>
				</div>

				<!-- News Block One -->
				<div class="news-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="news-block_one-inner wow fadeInRight" data-wow-delay="150ms" data-wow-duration="1500ms">
						<div class="news-block_one-image">
							<a href="news-detail.html"><img src="assets/images/resource/news-outing.png" alt="" /></a>
						</div>
						<div class="news-block_one-content">
							<ul class="news-block_one-meta">
								<li><span class="icon fa-solid fa-clock fa-fw"></span>October 18 2025</li>
							</ul>
							<h5 class="news-block_one-heading"><a href="news-detail.html">Pengalaman Outing KB-TK ke Kidzania</a></h5>
							<div class="news-block_one-text">There are many variations of passages of lorem Ipsum available islam courses</div>
							<div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
								<a class="news-block_one-more theme-btn" href="news-detail.html">read more</a>
							</div>
						</div>
					</div>
				</div>

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