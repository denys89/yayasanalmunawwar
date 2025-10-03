@extends('layouts.app')

@section('title', ($news->title ?? 'Detail Berita') . ' - Yayasan Al-Munawwar')

@section('content')
<div class="page-wrapper">
    
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{ asset('images/background/page-title.jpg') }})">
        <div class="auto-container">
            <h2>{{ $news->title ?? 'Detail Berita' }}</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('berita') }}">Berita</a></li>
                <li>{{ Str::limit($news->title ?? 'Detail Berita', 30) }}</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!-- Content Side -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-detail">
                        <div class="blog-detail_inner">
                            <div class="blog-detail_image">
                                <img src="{{ $news->featured_image ? asset('storage/' . $news->featured_image) : asset('images/resource/news-1.jpg') }}" alt="{{ $news->title ?? 'Detail Berita' }}" />
                            </div>
                            <div class="blog-detail_content">
                                <ul class="blog-detail_meta">
                                    <li><span class="icon fa-solid fa-user fa-fw"></span>{{ $news->author_name ?? 'Admin' }}</li>
                                    <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ $news->created_at ? $news->created_at->format('d M Y') : date('d M Y') }}</li>
                                    @if($news->category ?? null)
                                    <li><span class="icon fa-solid fa-tag fa-fw"></span>{{ $news->category }}</li>
                                    @endif
                                </ul>
                                <h3 class="blog-detail_heading">{{ $news->title ?? 'Program Pendidikan Al-Quran untuk Anak-Anak' }}</h3>
                                <div class="blog-detail_text">
                                    @if($news->content ?? null)
                                        {!! nl2br(e($news->content)) !!}
                                    @else
                                        <p>Yayasan Al-Munawwar dengan bangga mengumumkan peluncuran program pendidikan Al-Quran khusus untuk anak-anak. Program ini dirancang dengan metode pembelajaran yang menyenangkan dan interaktif, sehingga anak-anak dapat belajar Al-Quran dengan mudah dan penuh semangat.</p>
                                        
                                        <p>Program ini mencakup berbagai kegiatan seperti:</p>
                                        <ul>
                                            <li>Pembelajaran membaca Al-Quran dengan metode Iqra</li>
                                            <li>Hafalan surat-surat pendek</li>
                                            <li>Pemahaman makna dan tafsir sederhana</li>
                                            <li>Praktik adab dan akhlak Islami</li>
                                            <li>Kegiatan seni dan kreativitas bernuansa Islami</li>
                                        </ul>
                                        
                                        <p>Dengan tenaga pengajar yang berpengalaman dan bersertifikat, kami berkomitmen untuk memberikan pendidikan Al-Quran yang berkualitas. Program ini terbuka untuk anak-anak usia 5-12 tahun dan akan dilaksanakan setiap hari Sabtu dan Minggu.</p>
                                        
                                        <p>Untuk informasi lebih lanjut dan pendaftaran, silakan hubungi sekretariat Yayasan Al-Munawwar atau kunjungi langsung kantor kami. Mari bersama-sama membangun generasi Qurani yang berakhlak mulia.</p>
                                    @endif
                                </div>
                                
                                <!-- Tags -->
                                @if($news->tags ?? null)
                                <div class="blog-detail_tags">
                                    <span>Tags:</span>
                                    @foreach(explode(',', $news->tags) as $tag)
                                        <a href="#">{{ trim($tag) }}</a>
                                    @endforeach
                                </div>
                                @else
                                <div class="blog-detail_tags">
                                    <span>Tags:</span>
                                    <a href="#">Pendidikan</a>
                                    <a href="#">Al-Quran</a>
                                    <a href="#">Anak-anak</a>
                                    <a href="#">Program</a>
                                </div>
                                @endif
                                
                                <!-- Share -->
                                <div class="blog-detail_share">
                                    <span>Bagikan:</span>
                                    <a href="#" class="fa-brands fa-facebook-f fa-fw"></a>
                                    <a href="#" class="fa-brands fa-twitter fa-fw"></a>
                                    <a href="#" class="fa-brands fa-instagram fa-fw"></a>
                                    <a href="#" class="fa-brands fa-whatsapp fa-fw"></a>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
                
                <!-- Sidebar Side -->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        
                        <!-- Search -->
                        <div class="sidebar-widget search-box">
                            <form method="post" action="#">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Cari berita..." required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title">
                                <h4>Berita Terbaru</h4>
                            </div>
                            
                            @if(isset($latestNews) && $latestNews->count() > 0)
                                @foreach($latestNews as $latest)
                                <article class="post">
                                    <figure class="post-thumb">
                                        <a href="{{ route('berita.detail', $latest->slug) }}">
                                            <img src="{{ $latest->featured_image ? asset('storage/' . $latest->featured_image) : asset('images/resource/post-thumb-1.png') }}" alt="{{ $latest->title }}">
                                        </a>
                                    </figure>
                                    <div class="text">
                                        <a href="{{ route('berita.detail', $latest->slug) }}">{{ Str::limit($latest->title, 50) }}</a>
                                    </div>
                                    <div class="post-info">{{ $latest->created_at->format('d M Y') }}</div>
                                </article>
                                @endforeach
                            @else
                            <article class="post">
                                <figure class="post-thumb">
                                    <a href="#"><img src="{{ asset('images/resource/post-thumb-1.png') }}" alt="Berita"></a>
                                </figure>
                                <div class="text"><a href="#">Kegiatan Bakti Sosial di Bulan Ramadan</a></div>
                                <div class="post-info">{{ date('d M Y') }}</div>
                            </article>
                            
                            <article class="post">
                                <figure class="post-thumb">
                                    <a href="#"><img src="{{ asset('images/resource/post-thumb-2.png') }}" alt="Berita"></a>
                                </figure>
                                <div class="text"><a href="#">Seminar Parenting Islami untuk Orang Tua</a></div>
                                <div class="post-info">{{ date('d M Y', strtotime('-1 day')) }}</div>
                            </article>
                            
                            <article class="post">
                                <figure class="post-thumb">
                                    <a href="#"><img src="{{ asset('images/resource/post-thumb-3.png') }}" alt="Berita"></a>
                                </figure>
                                <div class="text"><a href="#">Pembangunan Masjid Baru di Kompleks Yayasan</a></div>
                                <div class="post-info">{{ date('d M Y', strtotime('-2 days')) }}</div>
                            </article>
                            @endif
                            
                        </div>
                        
                        <!-- Categories -->
                        <div class="sidebar-widget categories">
                            <div class="sidebar-title">
                                <h4>Kategori</h4>
                            </div>
                            <ul class="blog-cat">
                                <li><a href="#">Pendidikan <span>(12)</span></a></li>
                                <li><a href="#">Kegiatan <span>(8)</span></a></li>
                                <li><a href="#">Pengumuman <span>(6)</span></a></li>
                                <li><a href="#">Bakti Sosial <span>(4)</span></a></li>
                                <li><a href="#">Kajian <span>(10)</span></a></li>
                            </ul>
                        </div>
                        
                       
                        
                    </aside>
                </div>
                
            </div>
        </div>
    </div>

</div>
@endsection