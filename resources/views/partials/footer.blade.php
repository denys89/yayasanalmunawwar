<!-- Footer Style -->
<footer class="main-footer">
    <div class="footer_bg-image" style="background-image: url({{ asset('assets/images/background/footer-bg.jpg') }})"></div>
    <div class="auto-container">
        <div class="inner-container">
            <!-- Widgets Section -->
            <div class="widgets-section">
                <div class="row clearfix">
                    
                    <!-- Big Column -->
                    <div class="big-column col-lg-6 col-md-12 col-sm-12">
                        <div class="row clearfix">

                            <!-- Footer Column -->
                            <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget logo-widget">
                                    <div class="footer-logo" style="max-width: 100px;"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-tk-almunawwar.png') }}" alt="" title=""></a></div>
                                    <!-- Footer List -->
                                    <div class="footer_list">
                                        <li>Jl. Pendidikan No. 123, Kota Bogor <br> Jawa Barat 40123</li>
                                        <li>(022) 123-4567</li>
                                        <li>info@yayasanalmunawwar.org</li>
                                    </div>
                                    <!-- Social Box -->
                                    <div class="footer_socials">
                                        <a href="https://facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/"><i class="fa-brands fa-twitter"></i></a>
                                        <a href="https://youtube.com/"><i class="fa-brands fa-youtube"></i></a>
                                        <a href="https://instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Column -->
                            <div class="footer-column col-lg-6 col-md-6 col-sm-12">
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

                        </div>
                    </div>

                    <!-- Big Column -->
                    <div class="big-column col-lg-6 col-md-12 col-sm-12">
                        <div class="row clearfix">

                            <!-- Footer Column -->
                            <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget links-widget">
                                    <h4 class="footer-title">Unit Sekolah</h4>
                                    <ul class="footer-list">
                                        <li><a href="{{ route('tk-al-munawwar') }}">KB-TK Islam Al Munawwar</a></li>
                                        <li><a href="{{ route('sd-al-munawwar') }}">SD Islam Al Munawwar</a></li>
                                        <li><a href="{{ route('panti-al-munawwar') }}">Panti Al Munawwar</a></li>
                                        <li><a href="{{ route('masjid-al-munawwar') }}">Masjid Al Munawwar</a></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Footer Column -->
                            <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget links-widget">
                                    <h4 class="footer-title">News & Events</h4>
                                    <ul class="footer-list">
                                        <li><a href="{{ route('berita') }}">Berita Terbaru</a></li>
                                        <li><a href="{{ route('acara') }}">Acara & Kegiatan</a></li>
                                    </ul>
                                </div>
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
                <div class="copyright">All rights reserved 2025 &copy; template_mr</div>
                <ul class="footer-nav">
                    <li><a href="#">Terms of use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Style -->