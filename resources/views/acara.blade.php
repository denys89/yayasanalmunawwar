@extends('layouts.app')

@section('title', 'Acara - Yayasan Al-Munawwar')

@section('content')
<div class="page-wrapper">
    
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{ asset('images/background/page-title.jpg') }})">
        <div class="auto-container">
            <h2>Acara</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Acara</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Events One -->
    <section class="events-one">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="sec-title_title">Acara Mendatang</div>
                <h2 class="sec-title_heading">Kegiatan dan Acara <br> Yayasan Al-Munawwar</h2>
            </div>
            
            <div class="row clearfix">

                @forelse($events ?? [] as $item)
                <!-- News Block One (Event Card) -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', $item->slug ?? '#') }}">
                                <img src="{{ $item->featured_image ? asset('storage/' . $item->featured_image) : asset('images/resource/event-1.jpg') }}" alt="{{ $item->title ?? 'Acara' }}" />
                            </a>
                            <!-- Event Date Badge -->
                            <div class="event-date-badge">
                                <span>{{ $item->event_date ? $item->event_date->format('d') : date('d') }}</span>
                                {{ $item->event_date ? $item->event_date->format('M') : date('M') }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ $item->event_time ?? '09:00 WIB' }}</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>{{ $item->location ?? 'Yayasan Al-Munawwar' }}</li>
                            </ul>
                            <h5 class="news-block_one-heading">
                                <a href="{{ route('acara.detail', $item->slug ?? '#') }}">{{ $item->title ?? 'Judul Acara' }}</a>
                            </h5>
                            <div class="news-block_one-text">{{ Str::limit($item->description ?? 'Deskripsi acara akan ditampilkan di sini...', 100) }}</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ $item->event_date ? $item->event_date->format('d M Y') : date('d M Y') }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', $item->slug ?? '#') }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Sample Event Block One -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', 'pelatihan-guru-alquran') }}"><img src="{{ asset('images/resource/event-1.jpg') }}" alt="Acara" /></a>
                            <div class="event-date-badge">
                                <span>{{ date('d') }}</span>
                                {{ date('M') }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>09:00 WIB</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>Masjid Al-Munawwar</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('acara.detail', 'pelatihan-guru-alquran') }}">Kajian Rutin Tafsir Al-Quran</a></h5>
                            <div class="news-block_one-text">Kajian rutin setiap minggu membahas tafsir Al-Quran dengan pendekatan yang mudah dipahami untuk semua kalangan.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ date('d M Y') }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', 'pelatihan-guru-alquran') }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Event Block Two -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', 'seminar-pendidikan-islam') }}"><img src="{{ asset('images/resource/event-2.jpg') }}" alt="Acara" /></a>
                            <div class="event-date-badge">
                                <span>{{ date('d', strtotime('+7 days')) }}</span>
                                {{ date('M', strtotime('+7 days')) }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>14:00 WIB</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>Aula Yayasan</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('acara.detail', 'seminar-pendidikan-islam') }}">Seminar Pendidikan Islam Modern</a></h5>
                            <div class="news-block_one-text">Seminar khusus untuk orang tua tentang cara mendidik anak sesuai dengan ajaran Islam yang benar dan aplikatif.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ date('d M Y', strtotime('+7 days')) }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', 'seminar-pendidikan-islam') }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Event Block Three -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', 'buka-puasa-bersama') }}"><img src="{{ asset('images/resource/event-3.jpg') }}" alt="Acara" /></a>
                            <div class="event-date-badge">
                                <span>{{ date('d', strtotime('+14 days')) }}</span>
                                {{ date('M', strtotime('+14 days')) }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>08:00 WIB</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>Lapangan Yayasan</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('acara.detail', 'buka-puasa-bersama') }}">Bakti Sosial Ramadan</a></h5>
                            <div class="news-block_one-text">Kegiatan bakti sosial dalam rangka menyambut bulan suci Ramadan dengan membagikan sembako kepada masyarakat kurang mampu.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ date('d M Y', strtotime('+14 days')) }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', 'buka-puasa-bersama') }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Event Block Four -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', 'lomba-tahfidz-anak') }}"><img src="{{ asset('images/resource/event-4.jpg') }}" alt="Acara" /></a>
                            <div class="event-date-badge">
                                <span>{{ date('d', strtotime('+21 days')) }}</span>
                                {{ date('M', strtotime('+21 days')) }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>19:30 WIB</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>Masjid Al-Munawwar</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('acara.detail', 'lomba-tahfidz-anak') }}">Kultum Malam Jumat</a></h5>
                            <div class="news-block_one-text">Kultum (Kuliah Tujuh Menit) rutin setiap malam Jumat dengan tema-tema kehidupan sehari-hari dalam perspektif Islam.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ date('d M Y', strtotime('+21 days')) }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', 'lomba-tahfidz-anak') }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Event Block Five -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', 'workshop-parenting') }}"><img src="{{ asset('images/resource/event-5.jpg') }}" alt="Acara" /></a>
                            <div class="event-date-badge">
                                <span>{{ date('d', strtotime('+28 days')) }}</span>
                                {{ date('M', strtotime('+28 days')) }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>10:00 WIB</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>Ruang Kelas</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('acara.detail', 'workshop-parenting') }}">Pelatihan Tahfidz untuk Remaja</a></h5>
                            <div class="news-block_one-text">Program pelatihan menghafal Al-Quran khusus untuk remaja dengan metode yang efektif dan menyenangkan.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ date('d M Y', strtotime('+28 days')) }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', 'workshop-parenting') }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sample Event Block Six -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', 'kajian-rutin-ustadz') }}"><img src="{{ asset('images/resource/event-6.jpg') }}" alt="Acara" /></a>
                            <div class="event-date-badge">
                                <span>{{ date('d', strtotime('+35 days')) }}</span>
                                {{ date('M', strtotime('+35 days')) }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>13:00 WIB</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>Aula Yayasan</li>
                            </ul>
                            <h5 class="news-block_one-heading"><a href="{{ route('acara.detail', 'kajian-rutin-ustadz') }}">Workshop Kaligrafi Arab</a></h5>
                            <div class="news-block_one-text">Workshop seni kaligrafi Arab untuk semua kalangan yang ingin mempelajari keindahan tulisan Arab dengan teknik yang benar.</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ date('d M Y', strtotime('+35 days')) }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', 'kajian-rutin-ustadz') }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if(isset($events) && $events->hasPages())
            <div class="styled-pagination text-center">
                {{ $events->links() }}
            </div>
            @endif
        </div>
    </section>
    <!-- End Events One -->

    <!-- CTA One -->
    <section class="cta-two">
        <div class="auto-container">
            <div class="inner-container d-flex justify-content-between align-items-center flex-wrap">
                <div class="cta-two_bg" style="background-image:url({{ asset('images/background/cta-one_bg.png') }})"></div>
                <div class="cta-two_icon flaticon-nabawi-mosque"></div>
                <h3 class="cta-two_heading">Ikuti Kegiatan dan Acara <br> Yayasan Al-Munawwar</h3>
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

<style>
.event-date-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #28a745;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    text-align: center;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    z-index: 2;
}

.event-date-badge span {
    display: block;
    font-size: 18px;
    line-height: 1;
    margin-bottom: 2px;
}

.event-date-badge {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Ensure the image container has relative positioning for the badge */
.news-block_one-image {
    position: relative;
}
</style>

@endsection