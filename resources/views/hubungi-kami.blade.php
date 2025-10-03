@extends('layouts.app')

@section('title', 'Hubungi Kami - Yayasan Al-Munawwar')
@section('description', 'Hubungi Yayasan Al-Munawwar untuk informasi pendaftaran, konsultasi pendidikan, atau pertanyaan lainnya.')
@section('keywords', 'hubungi kami, kontak yayasan al-munawwar, pendaftaran sekolah islam')

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('images/background/page-title.jpg') }})">
    <div class="auto-container">
        <h2>Hubungi Kami</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="index.html">Home</a></li>
            <li>Hubungi Kami</li>
        </ul>
    </div>
</section>
<!-- End Page Title -->

<!-- Contact Info -->
<section class="contact-info">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <!-- Info Column -->
                <div class="contact-info_column col-lg-4 col-md-6 col-sm-12">
                    <div class="contact-info_outer">
                        <div class="contact-info_icon fa-solid fa-location-dot fa-fw"></div>
                        <h4 class="contact-info_heading">Alamat Yayasan</h4>
                        <div class="contact-info_text">Jl. Raya No. 123, Kota Jakarta, Indonesia</div>
                    </div>
                </div>

                <!-- Info Column -->
                <div class="contact-info_column col-lg-4 col-md-6 col-sm-12">
                    <div class="contact-info_outer">
                        <div class="contact-info_icon fa-solid fa-phone fa-fw"></div>
                        <h4 class="contact-info_heading">Nomor Telepon</h4>
                        <div class="contact-info_text">( +621 ) 48 26 48 26 <span>Let’s Talk +62 1 27 14 101</span></div>
                    </div>
                </div>

                <!-- Info Column -->
                <div class="contact-info_column col-lg-4 col-md-6 col-sm-12">
                    <div class="contact-info_outer">
                        <div class="contact-info_icon fa-solid fa-envelope fa-fw"></div>
                        <h4 class="contact-info_heading">Alamat Email</h4>
                        <div class="contact-info_text">almunawar@almunawar.org <br> info@almunawar.org</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- End Contact Info -->

<!-- Contact Form Box -->
<div class="contact-form_box">
    <div class="auto-container">
        <h4>Hubungi Kami untuk Konsultasi dan Pendaftaran</h4>

        <!-- Contact Form -->
        <div class="contact-form">
            <form method="post" action="sendemail.php" id="contact-form">
                
                <div class="form-group">
                    <input type="text" name="username" placeholder="Nama Lengkap" required="">
                </div>
                
                <div class="form-group">
                    <input type="text" name="email" placeholder="Alamat Email" required="">
                </div>
                
                <div class="form-group">
                    <textarea class="" name="message" placeholder="Ketik pesanmu di sini"></textarea>
                </div>
                
                <div class="form-group">
                    <!-- Button Box -->
                    <div class="button-box">
                        <button type="submit" class="theme-btn btn-style-four">
                            <span class="btn-wrap">
                                <span class="text-one">Kirim Pesan</span>
                                <span class="text-two">Kirim Pesan</span>
                            </span>
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
        <!-- End Comment Form -->

    </div>
</div>
<!-- End Contact Form Box -->

<!-- Map One -->
<section class="map-one">
    <div class="map-outer">
        <iframe  class="map w-100"  src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
    </div>
</section>
<!-- End Map One -->


@endsection

