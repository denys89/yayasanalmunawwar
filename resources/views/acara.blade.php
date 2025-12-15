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

                @forelse($events as $item)
                <!-- News Block One (Event Card) -->
                <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="news-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="news-block_one-image">
                            <a href="{{ route('acara.detail', $item) }}">
                                <img src="{{ $item->banner_image ? asset('storage/' . $item->banner_image) : asset('images/resource/event-1.jpg') }}" alt="{{ $item->name ?? 'Acara' }}" />
                            </a>
                            <!-- Event Date Badge -->
                            <div class="event-date-badge">
                                <span>{{ $item->datetime ? $item->datetime->format('d') : date('d') }}</span>
                                {{ $item->datetime ? $item->datetime->format('M') : date('M') }}
                            </div>
                        </div>
                        <div class="news-block_one-content">
                            <ul class="news-block_one-meta">
                                <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ $item->datetime ? $item->datetime->format('H:i') : '09:00' }} WIB</li>
                                <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span>{{ $item->location ?? 'Yayasan Al-Munawwar' }}</li>
                            </ul>
                            <h5 class="news-block_one-heading">
                                <a href="{{ route('acara.detail', $item) }}">{{ $item->name ?? 'Judul Acara' }}</a>
                            </h5>
                            <div class="news-block_one-text">{{ Str::limit(strip_tags($item->description ?? 'Deskripsi acara akan ditampilkan di sini...'), 100) }}</div>
                            <div class="news-block_one-info d-flex justify-content-between align-items-center flex-wrap">
                                <div class="news-block_one-author">
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    {{ $item->datetime ? $item->datetime->format('d M Y') : date('d M Y') }}
                                </div>
                                <a class="news-block_one-more theme-btn" href="{{ route('acara.detail', $item) }}">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Belum ada acara yang tersedia saat ini.</div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if(isset($events) && $events->hasPages())
            <div class="styled-pagination text-center">
                {{ $events->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </section>
    <!-- End Events One -->


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