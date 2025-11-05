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
							@php
								$tkUrl = $brosure_url[1] ?? null;
								$tkHref = null;
								if (!empty($tkUrl)) {
									if (str_starts_with($tkUrl, 'http')) {
										$tkHref = $tkUrl;
									} else {
										try {
											$tkHref = \Illuminate\Support\Facades\Storage::disk('public')->url($tkUrl);
										} catch (\Throwable $e) {
											$tkHref = null;
										}
									}
								}
							@endphp
							@if($tkHref)
								<a href="{{ $tkHref }}" target="_blank" rel="noopener noreferrer" download class="theme-btn btn-style-four w-100">
									<span class="btn-wrap">
										<span class="text-one">Unduh Brosur TK</span>
										<span class="text-two">Unduh Brosur TK</span>
									</span>
								</a>
							@else
								<span class="theme-btn btn-style-four w-100 disabled" aria-disabled="true" title="Brosur belum tersedia">
									<span class="btn-wrap">
										<span class="text-one">Unduh Brosur TK</span>
										<span class="text-two">Unduh Brosur TK</span>
									</span>
								</span>
							@endif
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
							@php
								$sdUrl = $brosure_url[2] ?? null;
								$sdHref = null;
								if (!empty($sdUrl)) {
									if (str_starts_with($sdUrl, 'http')) {
										$sdHref = $sdUrl;
									} else {
										try {
											$sdHref = \Illuminate\Support\Facades\Storage::disk('public')->url($sdUrl);
										} catch (\Throwable $e) {
											$sdHref = null;
										}
									}
								}
							@endphp
							@if($sdHref)
								<a href="{{ $sdHref }}" target="_blank" rel="noopener noreferrer" download class="theme-btn btn-style-one w-100">
									<span class="btn-wrap">
										<span class="text-one">Unduh Brosur SD</span>
										<span class="text-two">Unduh Brosur SD</span>
									</span>
								</a>
							@else
								<span class="theme-btn btn-style-one w-100 disabled" aria-disabled="true" title="Brosur belum tersedia">
									<span class="btn-wrap">
										<span class="text-one">Unduh Brosur SD</span>
										<span class="text-two">Unduh Brosur SD</span>
									</span>
								</span>
							@endif
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
                            <h2 class="sec-title_heading">{{ $homepage?->title ?? 'Sekolah Islam Terpadu Yayasan Al-Munawwar' }}</h2>
                            <div class="sec-title_text">{!! $homepage?->description ?? 'Kami berkomitmen menghadirkan pendidikan Islam berkualitas mulai dari usia dini hingga tingkat menengah. Dengan pengajaran yang menggabungkan nilai-nilai Al-Qur’an, akhlak mulia, dan wawasan global, kami siap mendampingi tumbuh kembang anak-anak Anda.' !!}</div>
						</div>
					</div>
				</div>

				<!-- Image Column -->
				<div class="welcome-one_image-column col-lg-6 col-md-12 col-sm-12">
					<div class="welcome-one_image-outer">
						
						<div class="welcome-one_image">
							@php $photoUrl = !empty($homepage?->photo) ? asset('storage/' . $homepage->photo) : asset('assets/images/resource/welcome-1.jpg'); @endphp
							<img src="{{ $photoUrl }}" alt="{{ $homepage->photo_title ?? 'Homepage Photo' }}" />
						</div>
						<div class="welcome-one_years d-flex align-items-center flex-wrap">
							{{ $homepage->photo_title ?? 'Pendidikan Berkarakter, Prestasi Unggul' }}
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End Welcome One -->

	<!-- Video One -->
	<section class="video-one">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_title">Video Profil</div>
				<h2 class="sec-title_heading">Sekilas Tentang Yayasan</h2>
			</div>

			{{--
				Menampilkan video YouTube yang telah disanitasi dan disimpan pada kolom `homepage.youtube_embed`.
				Embed HTML dibuat di sisi server (CMS HomepageController) untuk keamanan dan konsistensi.
			--}}
			@if(!empty($homepage?->youtube_embed))
				<div class="video-one_player" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:12px;">
					<style>
						.video-one_player iframe{position:absolute;top:0;left:0;width:100%;height:100%;border:0;}
					</style>
					{!! $homepage->youtube_embed !!}
				</div>
			@else
				<div class="text-center text-muted py-3">Video belum tersedia.</div>
			@endif
		</div>
	</section>
	<!-- End Video One -->

	<!-- Featured One -->
	<section class="featured-one mt-0">
		<div class="auto-container mb-5 mt-5">
			<div class="inner-container" style="background-image:url(assets/images/icons/featured.png)">
				<div class="row justify-content-center">

					@forelse(($foundationValues ?? []) as $value)
						<div class="feature-block_one col-lg-3 col-md-4 col-sm-6">
							<div class="feature-block_one-inner">
								<div class="feature-block_one-icon {{ $value->icon }}"></div>
								<h4 class="feature-block_one-heading">{{ $value->title }}</h4>
							</div>
						</div>
					@empty
						<div class="col-12">
							<div class="text-center text-muted py-3">Belum ada nilai yayasan ditambahkan.</div>
						</div>
					@endforelse
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
                <h2 class="sec-title_heading">{{ $homepage?->program_title ?? 'Program Pendidikan Kami' }}</h2>
            </div>

            <!--
                NOTE: Utilities for image, typography, card, and button styling
                have been moved to global stylesheet `public/style/custom.css`.
                Classes used below:
                - util-thumb, util-heading, util-text, util-card, btn-solid-green
            -->
            <div class="row clearfix">

				@forelse(($programs ?? []) as $program)
				<!-- Course Block One -->
                <div class="course-block_one col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="course-block_one-inner wow fadeInLeft util-card" data-wow-delay="{{ 150 * ($loop->index + 1) }}ms" data-wow-duration="1000ms">
                        <div class="course-block_one-image">
                            @php $photo = $program->photo_url; $isExternal = $photo && Str::startsWith($photo, 'http'); @endphp
                            <!-- Standardized thumbnail image -->
                            <a href="{{ route('programs.show', $program->slug) }}" data-slug="{{ $program->slug }}">
                                <img class="util-thumb" src="{{ $photo ? ($isExternal ? $photo : asset('storage/' . $photo)) : asset('assets/images/resource/course-dummy1.png') }}" alt="{{ $program->title ?? $program->name }}" />
                            </a>
                        </div>
                        <div class="course-block_one-content">
                            <!-- Unified heading and body text styles -->
                            <h4 class="course-block_one-heading util-heading">
                                <a href="{{ route('programs.show', $program->slug) }}" data-slug="{{ $program->slug }}">{{ $program->title ?? $program->name }}</a>
                            </h4>
                            <div class="course-block_one-text util-text">{{ Str::limit(strip_tags($program->description), 160) }}</div>
                            <div class="course-block_one-buttons d-flex justify-content-between flex-wrap">
                                <!-- Consistent button styling -->
								<a href="{{ route('programs.show', $program->slug) }}" class="theme-btn btn-style-two">
								<span class="btn-wrap">
									<span class="text-one">Lihat Detail</span>
									<span class="text-two">Lihat Detail</span>
								</span>
							</a>
                            </div>
                        </div>
                    </div>
                </div>
				@empty
				<div class="col-12">
					<div class="text-center text-muted py-3">Belum ada program ditambahkan.</div>
				</div>
				@endforelse

			</div>
		</div>
	</section>
	<!-- End Courses One -->

	<!-- School Programs Tabs Section -->
	<section class="school-programs-tabs">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="sec-title_title">Program unggulan sekolah kami</div>
                <h2 class="sec-title_heading">{{ $homepage?->explore_title ?? 'Program Sekolah' }}</h2>
            </div>
			
			<!-- Tabs Container -->
			<div class="tabs-container">
				<!-- Tab Navigation -->
				<div class="tabs-nav">
					<div class="tab-btns tab-buttons clearfix">
						@php
							$categories = [
								'facilities' => 'facilities-tab',
								'extracurriculars' => 'extracurricular-tab',
								'islamic_life' => 'islamic-life-tab',
								'school_life' => 'school-life-tab'
							];
							$first = true;
						@endphp
						
						@foreach($categories as $key => $tabId)
							@if(isset($explores[$key]) && $explores[$key]->count() > 0)
								@php 
									$explore = $explores[$key]->first();
									$activeClass = $first ? 'active-btn' : '';
									$first = false;
								@endphp
								<div class="tab-btn {{ $activeClass }}" data-tab="#{{ $tabId }}">{{ $explore->title }}</div>
							@endif
						@endforeach
					</div>
				</div>
				
				<!-- Tabs Content -->
				<div class="tabs-content">
					@php
						$categories = [
							'facilities' => 'facilities-tab',
							'extracurriculars' => 'extracurricular-tab',
							'islamic_life' => 'islamic-life-tab',
							'school_life' => 'school-life-tab'
						];
						$first = true;
					@endphp
					
					@foreach($categories as $key => $tabId)
						@if(isset($explores[$key]) && $explores[$key]->count() > 0)
							@php 
								$explore = $explores[$key]->first();
								$activeClass = $first ? 'active-tab' : '';
								$first = false;
								$fallbackImage = 'assets/images/resource/' . $tabId . '.jpg';
							@endphp
							
							<!-- {{ ucfirst(str_replace('_', ' ', $key)) }} Tab -->
							<div class="tab {{ $activeClass }}" id="{{ $tabId }}">
								<div class="tab-inner">
									<div class="row clearfix">
										<div class="image-column col-lg-6 col-md-12 col-sm-12">
											<div class="image">
												@if($explore->image_url)
													<img src="{{ asset('storage/' . $explore->image_url) }}" alt="{{ $explore->title }}" />
												@else
													<img src="{{ asset($fallbackImage) }}" alt="{{ $explore->title }}" />
												@endif
											</div>
										</div>
										<div class="content-column col-lg-6 col-md-12 col-sm-12">
											<div class="inner-column">
												<h3>{{ $explore->title }}</h3>
												<p>{!! \App\Helpers\TinyMCEHelper::sanitizeContent($explore->summary ?? '') !!} </p>
												<a href="{{ route('explore.show', $explore->slug) }}" class="theme-btn btn-style-two">
													<span class="btn-wrap">
														<span class="text-one">Lihat Detail</span>
														<span class="text-two">Lihat Detail</span>
													</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End School Programs Tabs Section -->

	<!-- News One -->
	<section class="news-one">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="sec-title_title">Ikuti informasi terbaru mengenai kegiatan, lomba, pengumuman pendaftaran, dan agenda sekolah Al-Munawwar.</div>
                <h2 class="sec-title_heading">{{ $homepage?->news_title ?? 'Berita & Kegiatan Terkini' }}</h2>
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
				<h3 class="cta-two_heading">Raih Masa Depan Gemilang Bersama<br />Yayasan Al-Munawwar</h3><br />
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

<!-- Tab Styles -->
<style>
.school-programs-tabs {
    position: relative;
    padding: 60px 0;
    background-color: #f7f7f7;
}

.tabs-container {
    position: relative;
    margin-top: 40px;
}

.tabs-nav {
    position: relative;
    text-align: center;
    margin-bottom: 30px;
}

.tab-btns {
    display: inline-flex;
    background-color: #ffffff;
    border-radius: 50px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.tab-btn {
    position: relative;
    font-size: 16px;
    font-weight: 600;
    color: #333;
    padding: 15px 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 50px;
}

.tab-btn.active-btn {
    background-color: #50bc84;
    color: #ffffff;
}

.tabs-content {
    position: relative;
}

.tab {
    position: relative;
    display: none;
    opacity: 0;
    transition: all 0.3s ease;
}

.tab.active-tab {
    display: block;
    opacity: 1;
}

.tab-inner {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    padding: 30px;
}

.tab .image {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.tab .image img {
    width: 100%;
    height: auto;
    transition: all 0.5s ease;
}

.tab .inner-column {
    padding: 20px 0 0 20px;
}

.tab h3 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
}

.tab p {
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 20px;
    color: #666;
}

.tab .list {
    margin-bottom: 25px;
}

.tab .list li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
    font-size: 16px;
    color: #333;
}

.tab .list li:before {
    content: "\f00c";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    left: 0;
    top: 0;
    color: #50bc84;
}

@media (max-width: 767px) {
    .tab-btns {
        flex-wrap: wrap;
    }
    
    .tab-btn {
        padding: 10px 15px;
        font-size: 14px;
    }
    
    .tab .inner-column {
        padding: 20px 0 0 0;
    }
}
</style>

<!-- Tab Functionality Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all tab buttons and tabs
    const tabBtns = document.querySelectorAll('.school-programs-tabs .tab-btn');
    const tabs = document.querySelectorAll('.school-programs-tabs .tab');
    
    // Add click event to each tab button
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons and tabs
            tabBtns.forEach(b => b.classList.remove('active-btn'));
            tabs.forEach(t => t.classList.remove('active-tab'));
            
            // Add active class to clicked button
            this.classList.add('active-btn');
            
            // Get target tab and make it active
            const targetTab = document.querySelector(this.getAttribute('data-tab'));
            if (targetTab) {
                targetTab.classList.add('active-tab');
            }
        });
    });
});
</script>
@endsection