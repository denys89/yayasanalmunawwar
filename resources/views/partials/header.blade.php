<!-- Main Header -->
<header class="main-header">
    
    <!-- Header Top -->
    <div class="header-top">
        <div class="auto-container">
            <div class="inner-container">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="left-box d-flex align-items-center flex-wrap">
                        <!-- Info List -->
                        <ul class="header-top_list">
                            <li><span class="icon fa-solid fa-envelope fa-fw"></span>almunawwar@gmail.com</li>
                            <li><span class="icon fa-solid fa-location-dot fa-fw"></span>Kota Bogor, Jawa Barat, Indonesia</li>
                        </ul>
                        <div class="bismillah"><img src="{{ asset('assets/images/icons/bismillah.png') }}" alt="" /> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Upper -->
    <div class="header-upper">
        <div class="auto-container">
            <div class="inner-container">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    
                    <div class="logo-box">
                        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo-tk-almunawwar.png') }}" alt="" title=""></a></div>
                    </div>
                    
                    <div class="nav-outer">
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md">
                            <div class="navbar-header">
                                <!-- Toggle Button -->    	
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            
                            <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    
                                    <li><a href="{{ url('/') }}">Beranda</a></li>
                                    <li class="dropdown"><a href="#">Tentang Kami</a>
                                        <ul>
                                            <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                                            <li><a href="{{ route('visi-misi') }}">Visi Misi</a></li>
                                            <li><a href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Explore</a>
                                        <ul>
                                            @if(isset($exploreNavigation) && $exploreNavigation->isNotEmpty())
                                                @foreach($exploreNavigation as $category => $item)
                                                    <li><a href="{{ route('explore.show', $item->slug) }}">{{ $item->title }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">Unit Sekolah</a>
                                        <ul>
                                            <li><a href="{{ route('programs.show', ['slug' => 'kb-tk-islam-al-munawwar']) }}">TK Islam Al Munawwar</a></li>
                                            <li><a href="{{ route('programs.show', ['slug' => 'sd-islam-al-munawwar']) }}">SD Islam Al Munawwar</a></li>
                                            <li><a href="{{ route('programs.show', ['slug' => 'rumah-kasih-sayang-untuk-anak-yatim']) }}">Panti Al Munawwar</a></li>
                                            <li><a href="{{ route('programs.show', ['slug' => 'masjid-al-munawwar']) }}">Masjid Al Munawwar</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#">News & Events</a>
                                        <ul>
                                            <li><a href="{{ route('berita') }}">News</a></li>
                                            <li><a href="{{ route('acara') }}">Events</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('hubungi-kami') }}">Hubungi Kami</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    
                    <!-- Main Menu End-->
                    <div class="outer-box d-flex align-items-center flex-wrap">
                        
                        <!-- Search Btn -->
                        <div class="search-box-btn search-box-outer"><span class="icon fa fa-search"></span></div>

                        <!-- User Box -->
                        <a class="user-box theme-btn" href="register.html">
                            <span class="fa-regular fa-user fa-fw"></span>
                        </a>

                        <!-- Button Box -->
                        <div class="header_button-box">
                            <a href="{{ route('hubungi-kami') }}" class="theme-btn btn-style-one">
                                <span class="btn-wrap">
                                    <span class="text-one">Daftar Sekarang</span>
                                    <span class="text-two">Daftar Sekarang</span>
                                </span>
                            </a>
                        </div>

                        <!-- Mobile Navigation Toggler -->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->
    
    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-close-1"></span></div>
        
        <nav class="menu-box">
            <!-- <div class="nav-logo"><a href="index.html"><img src="assets/images/logo-tk-almunawwar.png" alt="" title=""></a></div> -->
            <div class="menu-outer mt-5"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        </nav>
    </div>
    <!-- End Mobile Menu -->

</header>
<!-- End Main Header -->