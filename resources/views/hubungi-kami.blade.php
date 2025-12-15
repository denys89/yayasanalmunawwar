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
            @if (session('status'))
                <div class="alert alert-success" style="padding: 12px; border: 1px solid #d4edda; background-color: #dff0d8; color: #155724; border-radius: 6px; margin-bottom: 16px;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="padding: 12px; border: 1px solid #f5c6cb; background-color: #f8d7da; color: #721c24; border-radius: 6px; margin-bottom: 16px;">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('hubungi-kami.submit') }}" id="contact-form" accept-charset="UTF-8" autocomplete="on" novalidate>
                @csrf

                <!-- Honeypot (anti-spam) -->
                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" style="position:absolute; left:-10000px; opacity:0; height:0; width:0;" aria-hidden="true">

                <!-- Destination Selection -->
                <div class="form-group">
                    <select name="destination" id="destination" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #fff;">
                        <option value="">Pilih Tujuan Konsultasi/Pendaftaran</option>
                        <option value="kb/tk" {{ old('destination') === 'kb/tk' ? 'selected' : '' }}>KB-TK Al Munawwar</option>
                        <option value="sd" {{ old('destination') === 'sd' ? 'selected' : '' }}>SD Al Munawwar</option>
                        <option value="panti" {{ old('destination') === 'panti' ? 'selected' : '' }}>Panti Al Munawwar</option>
                        <option value="masjid" {{ old('destination') === 'masjid' ? 'selected' : '' }}>Masjid Al Munawwar</option>
                    </select>
                    @error('destination')
                        <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" name="name" placeholder="Nama Lengkap" required id="name" maxlength="100" value="{{ old('name') }}" disabled style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #f5f5f5;">
                    @error('name')
                        <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Alamat Email" required id="email" maxlength="255" value="{{ old('email') }}" disabled style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #f5f5f5;">
                    @error('email')
                        <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" name="subject" placeholder="Subjek" required id="subject" maxlength="255" value="{{ old('subject') }}" disabled style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #f5f5f5;">
                    @error('subject')
                        <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" name="phone_number" placeholder="Nomor Telepon (opsional)" id="phone_number" maxlength="20" value="{{ old('phone_number') }}" disabled style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #f5f5f5;">
                    @error('phone_number')
                        <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <textarea name="message" placeholder="Ketik pesanmu di sini" id="message" required maxlength="5000" disabled style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #f5f5f5; height: 160px;">{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <!-- Button Box -->
                    <div class="button-box">
                        <button type="submit" class="theme-btn btn-style-four" id="submit-btn" disabled style="opacity: 0.5; cursor: not-allowed;">
                            <span class="btn-wrap">
                                <span class="text-one">Kirim Pesan</span>
                                <span class="text-two">Kirim Pesan</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- JavaScript for form control -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tujuanSelect = document.getElementById('destination');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const subjectInput = document.getElementById('subject');
            const phoneInput = document.getElementById('phone_number');
            const messageTextarea = document.getElementById('message');
            const submitBtn = document.getElementById('submit-btn');

            function toggleFormFields(enable) {
                nameInput.disabled = !enable;
                emailInput.disabled = !enable;
                subjectInput.disabled = !enable;
                phoneInput.disabled = !enable;
                messageTextarea.disabled = !enable;
                submitBtn.disabled = !enable;

                const enabledBg = '#fff';
                const disabledBg = '#f5f5f5';
                nameInput.style.backgroundColor = enable ? enabledBg : disabledBg;
                emailInput.style.backgroundColor = enable ? enabledBg : disabledBg;
                subjectInput.style.backgroundColor = enable ? enabledBg : disabledBg;
                phoneInput.style.backgroundColor = enable ? enabledBg : disabledBg;
                messageTextarea.style.backgroundColor = enable ? enabledBg : disabledBg;
                submitBtn.style.opacity = enable ? '1' : '0.5';
                submitBtn.style.cursor = enable ? 'pointer' : 'not-allowed';
            }

            tujuanSelect.addEventListener('change', function() {
                const enabled = this.value !== '';
                toggleFormFields(enabled);
                if (!enabled) {
                    nameInput.value = '';
                    emailInput.value = '';
                    subjectInput.value = '';
                    phoneInput.value = '';
                    messageTextarea.value = '';
                }
            });

            toggleFormFields(!!tujuanSelect.value);
        });
        </script>
        <!-- End Comment Form -->

    </div>
</div>
<!-- End Contact Form Box -->

<!-- Map One -->
<section class="map-one">
    <div class="map-outer">
        <iframe class="map w-100" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=id&amp;q=-6.5718291,106.7977193%20(Yayasan%20Pendidikan%20Islam%20Al%20-%20Munawwar)&amp;t=m&amp;z=20&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
        </iframe>
    </div>
</section>
<!-- End Map One -->


@endsection
