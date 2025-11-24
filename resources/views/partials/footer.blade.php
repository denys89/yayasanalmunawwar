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

<!-- Footer Style -->
<footer class="main-footer">
    <div class="footer_bg-image" style="background-image: url({{ asset('assets/images/background/footer-bg.jpg') }})"></div>
    <div class="auto-container">
        <div class="inner-container">
            <!-- Widgets Section -->
            <div class="widgets-section">
                
                <div class="row clearfix">
                    <!-- Footer Column -->
                    <div class="footer-column col-lg-4 col-md-4 col-sm-12">
                        <div class="footer-widget links-widget">
                            <h4 class="footer-title">Tentang Kami</h4>
                            <ul class="footer-list">
                                <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                                <li><a href="{{ route('visi-misi') }}">Visi Misi</a></li>
                                <li><a href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
                                <li><a href="{{ route('hubungi-kami') }}">Hubungi Kami</a></li>
                                <li><a href="{{ route('home') }}">Beranda</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer Column -->
                    <div class="footer-column col-lg-4 col-md-4 col-sm-12">
                        <div class="footer-widget links-widget">
                            <h4 class="footer-title">Unit Sekolah</h4>
                            <ul class="footer-list">
                                <li><a href="{{ route('programs.show', ['slug' => 'kb-tk-islam-al-munawwar']) }}">KB-TK Islam Al Munawwar</a></li>
                                <li><a href="{{ route('programs.show', ['slug' => 'sdit-al-munawwar']) }}">SDIT Islam Al Munawwar</a></li>
                                <li><a href="{{ route('programs.show', ['slug' => 'rumah-kasih-sayang-untuk-anak-yatim']) }}">Panti Al Munawwar</a></li>
                                <li><a href="{{ route('programs.show', ['slug' => 'masjid-al-munawwar']) }}">Masjid Al Munawwar</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Footer Column -->
                    <div class="footer-column col-lg-4 col-md-4 col-sm-12">
                        <div class="footer-widget links-widget">
                            <h4 class="footer-title">News & Events</h4>
                            <ul class="footer-list">
                                <li><a href="{{ route('berita') }}">Berita Terbaru</a></li>
                                <li><a href="{{ route('acara') }}">Acara & Kegiatan</a></li>
                            </ul>
                        </div>
                    </div>



                </div>
                <div class="row clearfix">
                    <div class="footer-column col-lg-12 col-md-12 col-sm-12">
                        <div class="footer-widget logo-widget">
                            <!-- <div class="footer-logo" style="max-width: 80px;"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-tk-almunawwar-footer.png') }}" alt="" title=""></a></div> -->
                            
                            <!-- Social Box -->
                            <div class="footer_socials mb-4">
                                <a href="https://facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://twitter.com/"><i class="fa-brands fa-twitter"></i></a>
                                <a href="https://youtube.com/"><i class="fa-brands fa-youtube"></i></a>
                                <a href="https://instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                            <!-- Footer List -->
                            <div class="footer_list">
                                <li style="font-size: 17px;">Jln. Pemuda no. 42, 43 Bogor,  Jawa Barat Indonesia 16161 0896-3954-5861, yayasanpendidikanislamalmunaww@gmail.com</li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer_bottom-bg" style="background-image: url({{ asset('assets/images/background/footer-bg_2.jpg') }})"></div>
        <div class="auto-container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="copyright">All rights reserved {{ date('Y') }} &copy; Yayasan Pendidikan Islam Al Munawwar</div>
                <ul class="footer-nav">
                    <li><a href="#">Terms of use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Style -->