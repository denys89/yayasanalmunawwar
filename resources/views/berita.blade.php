@extends('layouts.app')

@section('title', 'Berita - Yayasan Al-Munawwar')

@section('content')
<div class="page-wrapper">
    
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{ asset('images/background/page-title.jpg') }})">
        <div class="auto-container">
            <h2>Berita</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Berita</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Blog One -->
    <section class="blog-one">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="sec-title_title">Berita Terkini</div>
                <h2 class="sec-title_heading">Informasi dan Berita <br> Yayasan Al-Munawwar</h2>
                @if(!empty($query))
                    <p class="mt-2">Hasil pencarian untuk: <strong>{{ e($query) }}</strong></p>
                @endif
            </div>
            
            <div class="row clearfix">

                @forelse($news ?? [] as $item)
                @continue(!$item->isPublished())
                <!-- News Block One -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('berita.detail', $item->slug ?? '#') }}">
                                @php
                                    $imageUrl = $item->image_url ?? null;
                                    $isExternal = $imageUrl && str_starts_with($imageUrl, 'http');
                                @endphp
                                <img
                                    src="{{ $imageUrl ? ($isExternal ? $imageUrl : asset('storage/' . $imageUrl)) : asset('images/resource/news-1.jpg') }}"
                                    alt="{{ $item->title ?? 'Berita' }}"
                                    loading="lazy"
                                    decoding="async"
                                />
                            </a>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <!-- <li><span class="icon fa-brands fa-rocketchat fa-fw"></span>{{ $item->comments_count ?? 0 }} Komentar</li> -->
                                @php
                                    $date = $item->published_at ?? $item->created_at ?? null;
                                @endphp
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ $date ? \Carbon\Carbon::parse($date)->format('d M Y') : date('d M Y') }}</li>
                            </ul>
                            <h5 class="news-block_one-heading">
                                <a href="{{ route('berita.detail', $item->slug ?? '#') }}">{{ $item->title ?? 'Judul Berita' }}</a>
                            </h5>
                            <div class="news-block_one-text">{{ Str::limit($item->summary ?? $item->content ?? 'Ringkasan berita akan ditampilkan di sini...', 100) }}</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', $item->slug ?? '#') }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Sample News Block One -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('berita.detail', 'program-pendidikan-alquran-anak') }}"><img src="{{ asset('images/resource/news-1.jpg') }}" alt="Berita" /></a>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <!-- <li><span class="icon fa-brands fa-rocketchat fa-fw"></span>0 Komentar</li> -->
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ date('d M Y') }}</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('berita.detail', 'program-pendidikan-alquran-anak') }}">Program Pendidikan Al-Quran untuk Anak-Anak</a></h5>
                            <div class="news-block_one-text">Yayasan Al-Munawwar meluncurkan program pendidikan Al-Quran khusus untuk anak-anak dengan metode pembelajaran yang menyenangkan dan interaktif.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <!-- <div class="news-block_one-author_image">
                                        <img src="{{ asset('images/resource/author-1.png') }}" alt="Admin" />
                                    </div> -->
                                    Admin
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', 'program-pendidikan-alquran-anak') }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample News Block Two -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('berita.detail', 'bakti-sosial-ramadan') }}"><img src="{{ asset('images/resource/news-2.jpg') }}" alt="Berita" /></a>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <!-- <li><span class="icon fa-brands fa-rocketchat fa-fw"></span>0 Komentar</li> -->
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ date('d M Y') }}</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('berita.detail', 'bakti-sosial-ramadan') }}">Kegiatan Bakti Sosial di Bulan Ramadan</a></h5>
                            <div class="news-block_one-text">Dalam rangka menyambut bulan suci Ramadan, Yayasan Al-Munawwar mengadakan kegiatan bakti sosial untuk membantu masyarakat kurang mampu.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <!-- <div class="news-block_one-author_image">
                                        <img src="{{ asset('images/resource/author-2.png') }}" alt="Admin" />
                                    </div> -->
                                    Admin
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', 'bakti-sosial-ramadan') }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample News Block Three -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('berita.detail', 'seminar-parenting-islami') }}"><img src="{{ asset('images/resource/news-3.jpg') }}" alt="Berita" /></a>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <!-- <li><span class="icon fa-brands fa-rocketchat fa-fw"></span>0 Komentar</li> -->
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ date('d M Y') }}</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('berita.detail', 'seminar-parenting-islami') }}">Seminar Parenting Islami untuk Orang Tua</a></h5>
                            <div class="news-block_one-text">Yayasan Al-Munawwar mengadakan seminar parenting Islami untuk membantu orang tua dalam mendidik anak-anak sesuai dengan nilai-nilai Islam.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <!-- <div class="news-block_one-author_image">
                                        <img src="{{ asset('images/resource/author-3.png') }}" alt="Admin" />
                                    </div> -->
                                    Admin
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', 'seminar-parenting-islami') }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample News Block Four -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('berita.detail', 'pembangunan-masjid-baru') }}"><img src="{{ asset('images/resource/news-8.jpg') }}" alt="Berita" /></a>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <!-- <li><span class="icon fa-brands fa-rocketchat fa-fw"></span>0 Komentar</li> -->
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ date('d M Y') }}</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('berita.detail', 'pembangunan-masjid-baru') }}">Pembangunan Masjid Baru di Kompleks Yayasan</a></h5>
                            <div class="news-block_one-text">Yayasan Al-Munawwar memulai pembangunan masjid baru yang akan menjadi pusat kegiatan ibadah dan pendidikan Islam bagi masyarakat sekitar.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <!-- <div class="news-block_one-author_image">
                                        <img src="{{ asset('images/resource/author-4.png') }}" alt="Admin" />
                                    </div> -->
                                    Admin
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', 'pembangunan-masjid-baru') }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample News Block Five -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('berita.detail', 'pelatihan-tahfidz-remaja') }}"><img src="{{ asset('images/resource/news-9.jpg') }}" alt="Berita" /></a>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <!-- <li><span class="icon fa-brands fa-rocketchat fa-fw"></span>0 Komentar</li> -->
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ date('d M Y') }}</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('berita.detail', 'pelatihan-tahfidz-remaja') }}">Pelatihan Tahfidz Al-Quran untuk Remaja</a></h5>
                            <div class="news-block_one-text">Program pelatihan tahfidz Al-Quran khusus untuk remaja dengan metode pembelajaran yang efektif dan menyenangkan.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <!-- <div class="news-block_one-author_image">
                                        <img src="{{ asset('images/resource/author-5.png') }}" alt="Admin" />
                                    </div> -->
                                    Admin
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', 'pelatihan-tahfidz-remaja') }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample News Block Six -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('berita.detail', 'kerjasama-universitas-islam') }}"><img src="{{ asset('images/resource/news-10.jpg') }}" alt="Berita" /></a>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <!-- <li><span class="icon fa-brands fa-rocketchat fa-fw"></span>0 Komentar</li> -->
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ date('d M Y') }}</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('berita.detail', 'kerjasama-universitas-islam') }}">Kerjasama dengan Universitas Islam Terkemuka</a></h5>
                            <div class="news-block_one-text">Yayasan Al-Munawwar menjalin kerjasama dengan beberapa universitas Islam terkemuka untuk meningkatkan kualitas pendidikan.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <!-- <div class="news-block_one-author_image">
                                        <img src="{{ asset('images/resource/author-6.png') }}" alt="Admin" />
                                    </div> -->
                                    Admin
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('berita.detail', 'kerjasama-universitas-islam') }}">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if(isset($news) && $news->hasPages())
            <div class="styled-pagination text-center">
                {{ $news->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </section>
    <!-- End Blog One -->

    <!-- CTA One -->
    <section class="cta-two">
        <div class="auto-container">
            <div class="inner-container d-flex justify-content-between align-items-center flex-wrap">
                <div class="cta-two_bg" style="background-image:url({{ asset('images/background/cta-one_bg.png') }})"></div>
                <div class="cta-two_icon flaticon-nabawi-mosque"></div>
                <h3 class="cta-two_heading">Bergabunglah dengan Keluarga Besar <br> Yayasan Al-Munawwar</h3>
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

</div>
@endsection