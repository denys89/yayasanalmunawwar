@extends('layouts.app')

@section('title', ($event->name ?? 'Detail Acara') . ' - Yayasan Al-Munawwar')

@section('content')
<div class="page-wrapper">
    
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{ asset('images/background/page-title.jpg') }})">
        <div class="auto-container">
            <h2>{{ $event->name ?? 'Detail Acara' }}</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('acara') }}">Acara</a></li>
                <li>{{ Str::limit($event->name ?? 'Detail Acara', 30) }}</li>
            </ul>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Event Detail -->
    <section class="event-detail">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!-- Content Column -->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        
                        <!-- Event Detail Block -->
                        <div class="event-detail_block">
                            <div class="event-detail_image">
                                <img src="{{ $event->banner_image ? asset('storage/' . $event->banner_image) : asset('images/resource/event-detail.jpg') }}" alt="{{ $event->name ?? 'Detail Acara' }}" />
                                <div class="event-detail_date">
                                    <span>{{ $event->datetime ? $event->datetime->format('d') : date('d') }}</span>
                                    {{ $event->datetime ? $event->datetime->format('M') : date('M') }}
                                </div>
                            </div>
                            
                            <div class="event-detail_content">
                                <h3 class="event-detail_heading">{{ $event->name ?? 'Kajian Rutin Tafsir Al-Quran' }}</h3>
                                
                                <!-- Event Meta -->
                                <ul class="event-detail_meta">
                                    <li><span class="icon fa-solid fa-clock fa-fw"></span><strong>Waktu:</strong> {{ $event->datetime ? $event->datetime->format('H:i') : '09:00' }} WIB</li>
                                    <li><span class="icon fa-solid fa-calendar fa-fw"></span><strong>Tanggal:</strong> {{ $event->datetime ? $event->datetime->format('d F Y') : date('d F Y') }}</li>
                                    <li><span class="icon fa-solid fa-map-marker-alt fa-fw"></span><strong>Lokasi:</strong> {{ $event->location ?? 'Masjid Al-Munawwar' }}</li>
                                    @if($event->organizer)
                                    <li><span class="icon fa-solid fa-user fa-fw"></span><strong>Penyelenggara:</strong> {{ $event->organizer }}</li>
                                    @endif
                                    @if($event->contact)
                                    <li><span class="icon fa-solid fa-phone fa-fw"></span><strong>Kontak:</strong> {{ $event->contact }}</li>
                                    @endif
                                </ul>
                                
                                <!-- Event Description -->
                                <div class="event-detail_text">
                                    {!! \App\Helpers\TinyMCEHelper::sanitizeContent($event->description ?? '') !!}
                                </div>
                                
                                <!-- Registration Button -->
                                <div class="event-detail_button">
                                    
                                    <a href="{{ route('acara') }}" class="theme-btn btn-style-two">
                                        <span class="btn-wrap">
                                            <span class="text-one">Lihat Acara Lain</span>
                                            <span class="text-two">Lihat Acara Lain</span>
                                        </span>
                                    </a>
                                </div>
                                
                                <!-- Share -->
                                <div class="event-detail_share">
                                    <span>Bagikan Acara:</span>
                                    <a href="#" class="fa-brands fa-facebook-f fa-fw"></a>
                                    <a href="#" class="fa-brands fa-twitter fa-fw"></a>
                                    <a href="#" class="fa-brands fa-whatsapp fa-fw"></a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Sidebar Column -->
                <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        
                        <!-- Event Info Widget -->
                        <div class="sidebar-widget event-info">
                            <div class="sidebar-title">
                                <h4>Informasi Acara</h4>
                            </div>
                            <ul class="event-info_list">
                                <li>
                                    <span class="icon fa-solid fa-calendar fa-fw"></span>
                                    <strong>Tanggal:</strong><br>
                                    {{ $event->datetime ? $event->datetime->format('d F Y') : date('d F Y') }}
                                </li>
                                <li>
                                    <span class="icon fa-solid fa-clock fa-fw"></span>
                                    <strong>Waktu:</strong><br>
                                    {{ $event->datetime ? $event->datetime->format('H:i') : '09:00' }} WIB
                                </li>
                                <li>
                                    <span class="icon fa-solid fa-map-marker-alt fa-fw"></span>
                                    <strong>Lokasi:</strong><br>
                                    {{ $event->location ?? 'Masjid Al-Munawwar' }}
                                </li>
                                <li>
                                    <span class="icon fa-solid fa-tag fa-fw"></span>
                                    <strong>Harga:</strong><br>
                                    Gratis
                                </li>
                            </ul>
                            
                        </div>
                        
                        <!-- Upcoming Events -->
                        <div class="sidebar-widget upcoming-events">
                            <div class="sidebar-title">
                                <h4>Acara Mendatang</h4>
                            </div>
                            
                            @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                                @foreach($upcomingEvents as $upcoming)
                                <div class="event-widget">
                                    <div class="event-widget_date">
                                        <span>{{ $upcoming->datetime ? $upcoming->datetime->format('d') : date('d') }}</span>
                                        {{ $upcoming->datetime ? $upcoming->datetime->format('M') : date('M') }}
                                    </div>
                                    <div class="event-widget_content">
                                        <h6><a href="{{ route('acara.detail', $upcoming) }}">{{ Str::limit($upcoming->name, 40) }}</a></h6>
                                        <div class="event-widget_info">
                                            <span class="icon fa-solid fa-clock fa-fw"></span>{{ $upcoming->datetime ? $upcoming->datetime->format('H:i') : '09:00' }} WIB
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="event-widget">
                                <div class="event-widget_date">
                                    <span>{{ date('d', strtotime('+7 days')) }}</span>
                                    {{ date('M', strtotime('+7 days')) }}
                                </div>
                                <div class="event-widget_content">
                                    <h6><a href="#">Seminar Pendidikan Anak dalam Islam</a></h6>
                                    <div class="event-widget_info">
                                        <span class="icon fa-solid fa-clock fa-fw"></span>14:00 WIB
                                    </div>
                                </div>
                            </div>
                            
                            <div class="event-widget">
                                <div class="event-widget_date">
                                    <span>{{ date('d', strtotime('+14 days')) }}</span>
                                    {{ date('M', strtotime('+14 days')) }}
                                </div>
                                <div class="event-widget_content">
                                    <h6><a href="#">Bakti Sosial Ramadan</a></h6>
                                    <div class="event-widget_info">
                                        <span class="icon fa-solid fa-clock fa-fw"></span>08:00 WIB
                                    </div>
                                </div>
                            </div>
                            
                            <div class="event-widget">
                                <div class="event-widget_date">
                                    <span>{{ date('d', strtotime('+21 days')) }}</span>
                                    {{ date('M', strtotime('+21 days')) }}
                                </div>
                                <div class="event-widget_content">
                                    <h6><a href="#">Kultum Malam Jumat</a></h6>
                                    <div class="event-widget_info">
                                        <span class="icon fa-solid fa-clock fa-fw"></span>19:30 WIB
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="sidebar-widget contact-info">
                            <div class="sidebar-title">
                                <h4>Informasi Kontak</h4>
                            </div>
                            <ul class="contact-info_list">
                                <li>
                                    <span class="icon fa-solid fa-phone fa-fw"></span>
                                    <strong>Telepon:</strong><br>
                                    +62 21 1234 5678
                                </li>
                                <li>
                                    <span class="icon fa-solid fa-envelope fa-fw"></span>
                                    <strong>Email:</strong><br>
                                    info@yayasanalmunawwar.org
                                </li>
                                <li>
                                    <span class="icon fa-solid fa-map-marker-alt fa-fw"></span>
                                    <strong>Alamat:</strong><br>
                                    Jl. Raya No. 123, Bogor Raya
                                </li>
                            </ul>
                        </div>
                        
                    </aside>
                </div>
                
            </div>
        </div>
    </section>
    <!-- End Event Detail -->

</div>

<style>
.event-detail {
    padding: 120px 0 90px;
}

.event-detail_block {
    background: #ffffff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 30px;
}

.event-detail_image {
    position: relative;
    overflow: hidden;
}

.event-detail_image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.event-detail_date {
    position: absolute;
    top: 30px;
    left: 30px;
    background: #2e8b57;
    color: #ffffff;
    text-align: center;
    padding: 15px;
    border-radius: 10px;
    min-width: 70px;
}

.event-detail_date span {
    display: block;
    font-size: 24px;
    font-weight: 700;
    line-height: 1;
}

.event-detail_content {
    padding: 40px;
}

.event-detail_heading {
    font-size: 28px;
    font-weight: 700;
    color: #2e8b57;
    margin-bottom: 20px;
}

.event-detail_meta {
    list-style: none;
    margin: 0 0 30px;
    padding: 0;
}

.event-detail_meta li {
    margin-bottom: 15px;
    font-size: 16px;
    color: #666;
}

.event-detail_meta .icon {
    color: #2e8b57;
    margin-right: 10px;
    width: 20px;
}

.event-detail_text {
    margin-bottom: 30px;
    line-height: 1.8;
}

.event-detail_text h4 {
    color: #2e8b57;
    margin: 25px 0 15px;
}

.event-detail_button {
    margin-bottom: 30px;
}

.event-detail_button .theme-btn {
    margin-right: 15px;
    margin-bottom: 10px;
}

.sidebar-widget {
    background: #ffffff;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 30px;
}

.event-info_list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.event-info_list li {
    padding: 20px 0;
    border-bottom: 1px solid #eee;
}

.event-info_list li:last-child {
    border-bottom: none;
}

.event-info_list .icon {
    color: #2e8b57;
    margin-right: 15px;
    font-size: 18px;
}

.event-info_button {
    margin-top: 20px;
}

.event-widget {
    display: flex;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #eee;
}

.event-widget:last-child {
    border-bottom: none;
}

.event-widget_date {
    background: #2e8b57;
    color: #ffffff;
    text-align: center;
    padding: 10px;
    border-radius: 8px;
    min-width: 60px;
    margin-right: 15px;
}

.event-widget_date span {
    display: block;
    font-size: 18px;
    font-weight: 700;
    line-height: 1;
}

.event-widget_content h6 {
    margin-bottom: 5px;
}

.event-widget_content h6 a {
    color: #333;
    text-decoration: none;
}

.event-widget_content h6 a:hover {
    color: #2e8b57;
}

.event-widget_info {
    font-size: 14px;
    color: #666;
}

.event-widget_info .icon {
    margin-right: 5px;
}

.contact-info_list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.contact-info_list li {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.contact-info_list li:last-child {
    border-bottom: none;
}

.contact-info_list .icon {
    color: #2e8b57;
    margin-right: 15px;
    font-size: 16px;
}
</style>
@endsection