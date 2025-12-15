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
                    @if($news && method_exists($news, 'isPublished') ? $news->isPublished() : ($news->status ?? null) === 'published')
                    <div class="blog-detail">
                        <div class="blog-detail_inner">
                            <div class="blog-detail_image">
                                @php
                                    $heroSrc = null;
                                    if (!empty($news->image_url)) {
                                        $heroSrc = Str::startsWith($news->image_url, 'http')
                                            ? $news->image_url
                                            : asset('storage/' . $news->image_url);
                                    } else {
                                        $heroSrc = asset('images/resource/news-1.jpg');
                                    }
                                @endphp
                                <img
                                    src="{{ $heroSrc }}"
                                    alt="{{ $news->title ?? 'Detail Berita' }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="blog-hero"
                                    onerror="this.src='{{ asset('images/resource/news-1.jpg') }}';this.onerror=null;"
                                />
                            </div>
                            <div class="blog-detail_content">
                                <ul class="blog-detail_meta">
                                    <li><span class="icon fa-solid fa-user fa-fw" aria-hidden="true"></span> Dibuat oleh {{ optional($news->createdBy)->name ?? 'Admin' }}</li>
                                    @php
                                        $date = $news->published_at ?? $news->created_at ?? null;
                                    @endphp
                                    <li><span class="icon fa-solid fa-clock fa-fw"></span>{{ $date ? \Carbon\Carbon::parse($date)->format('d M Y') : date('d M Y') }}</li>
                                    @if($news->category ?? null)
                                    <li><span class="icon fa-solid fa-tag fa-fw"></span>{{ $news->category }}</li>
                                    @endif
                                </ul>
                                <h3 class="blog-detail_heading">{{ $news->title ?? 'Program Pendidikan Al-Quran untuk Anak-Anak' }}</h3>
                                @php
                                    $summaryText = null;
                                    if (!empty($news->summary)) {
                                        $summaryText = Str::limit($news->summary, 220);
                                    } elseif (!empty($news->content)) {
                                        $summaryText = Str::limit(strip_tags($news->content), 220);
                                    }
                                @endphp
                                <div class="blog-detail_text">
                                    @if(($news->summary ?? null) || ($news->content ?? null))
                                        @if($news->content ?? null)
                                            {!! \App\Helpers\TinyMCEHelper::sanitizeContent($news->content ?? '') !!}
                                        @endif
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
                                
                                
                                
                                
                                <!-- Share -->
                                <div class="event-detail_share">
                                    <span>Bagikan Berita:</span>
                                    @php
                                        $shareUrl = route('berita.detail', $news->slug ?? request()->path());
                                        $shareText = trim($news->title ?? 'Berita');
                                    @endphp
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}"
                                       target="_blank"
                                       rel="noopener nofollow"
                                       aria-label="Bagikan ke Facebook"
                                       class="fa-brands fa-facebook-f fa-fw"></a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}"
                                       target="_blank"
                                       rel="noopener nofollow"
                                       aria-label="Bagikan ke Twitter"
                                       class="fa-brands fa-twitter fa-fw"></a>
                                    <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $shareUrl) }}"
                                       target="_blank"
                                       rel="noopener nofollow"
                                       aria-label="Bagikan ke WhatsApp"
                                       class="fa-brands fa-whatsapp fa-fw"></a>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    @else
                        <div class="alert alert-warning">Artikel tidak ditemukan atau belum dipublikasikan.</div>
                    @endif
                </div>
                
                <!-- Sidebar Side -->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        
                        <!-- Search -->
                        <div class="sidebar-widget search-box">
                            <form method="get" action="{{ route('berita') }}" novalidate>
                                <div class="form-group">
                                    <input
                                        type="search"
                                        name="q"
                                        value="{{ old('q') }}"
                                        placeholder="Cari berita..."
                                        minlength="2"
                                        maxlength="100"
                                        required
                                        autocomplete="off"
                                    >
                                    <button type="submit" aria-label="Cari"><span class="icon fa fa-search"></span></button>
                                </div>
                                @error('q')
                                    <div class="text-danger small" role="alert">{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                        
                        <!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title">
                                <h4>Berita Terbaru</h4>
                            </div>
                            
                            @foreach($latestNews as $latest)
                            @continue(!(method_exists($latest, 'isPublished') ? $latest->isPublished() : (($latest->status ?? null) === 'published')))
                            @php
                                $imgSrc = !empty($latest->image_url)
                                    ? (Str::startsWith($latest->image_url, 'http') ? $latest->image_url : asset('storage/' . $latest->image_url))
                                    : asset('images/resource/post-thumb-1.png');
                                $dateToShow = $latest->published_at ?? $latest->created_at;
                            @endphp
                            <article class="post d-flex">
                                <figure class="post-thumb">
                                    <a href="{{ route('berita.detail', $latest->slug) }}">
                                        <img src="{{ $imgSrc }}" alt="{{ $latest->title }}" loading="lazy" decoding="async" width="84" height="84" onerror="this.src='{{ asset('images/resource/post-thumb-1.png') }}';this.onerror=null;">
                                    </a>
                                </figure>
                                <div class="post-content">
                                    <a class="post-title" href="{{ route('berita.detail', $latest->slug) }}">{{ Str::limit($latest->title, 60) }}</a>
                                    <div class="post-info">{{ $dateToShow?->format('d M Y') }}</div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </aside>
                </div>
                
            </div>
        </div>
    </div>

</div>
<style>
    .event-detail_share {
    border-top: 1px solid #eee;
    padding-top: 20px;
    margin-top: 30px;
}

.event-detail_share span {
    font-weight: 600;
    margin-right: 15px;
}

.event-detail_share a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: #f8f9fa;
    color: #666;
    margin-right: 10px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.event-detail_share a:hover {
    background: #2e8b57;
    color: #ffffff;
}

/* Hero image responsive styling */
.blog-detail_image .blog-hero {
    width: 100%;
    height: auto;
    max-height: 480px;
    object-fit: cover;
    border-radius: 8px;
    display: block;
}

/* Summary block styling */
.blog-detail_summary {
    background: #f8fafc;
    border-left: 3px solid #0f5132;
    padding: 12px 16px;
    margin: 16px 0;
    color: #1f2937;
}
.blog-detail_summary p { margin: 0; }

/* Category list formatting */
.categories .blog-cat { list-style: none; padding-left: 0; margin: 0; }
.categories .blog-cat li { padding: 6px 0; }
.categories .blog-cat a { display: inline-block; color: #0f5132; }

/* Sidebar Latest Posts layout */
.popular-posts .post { align-items: center; gap: 12px; padding: 10px 0; }
.popular-posts .post-thumb { flex: 0 0 84px; margin: 0; }
.popular-posts .post-thumb img { width: 84px; height: 84px; object-fit: cover; border-radius: 6px; display: block; }
.popular-posts .post-content { display: flex; flex-direction: column; justify-content: center; }
.popular-posts .post-title { display: block; line-height: 1.3; }
.popular-posts .post-info { font-size: 0.875rem; color: #6b7280; }

@media (max-width: 576px) {
    .popular-posts .post-thumb { flex-basis: 64px; }
    .popular-posts .post-thumb img { width: 64px; height: 64px; }
}

/* CTA extracted widget styling */
.cta-extracted .cta-list-group { border-top: 1px solid #eee; padding-top: 8px; margin-top: 12px; }
.cta-extracted .cta-group-title { margin: 0 0 6px; font-weight: 600; color: #111827; font-size: 1rem; }
.cta-extracted .cta-link-list { list-style: none; padding: 0; margin: 0; }
.cta-extracted .cta-link-list li { margin: 4px 0; }
.cta-extracted .cta-link { color: #0f5132; }
.cta-extracted .cta-link:hover { text-decoration: underline; }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var container = document.querySelector('.event-detail_share');
    if (!container || !navigator.share) return;
    var titleEl = document.querySelector('.blog-detail_heading');
    var title = titleEl ? (titleEl.textContent || '').trim() : document.title;
    var url = window.location.href;
    container.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link) return;
        e.preventDefault();
        navigator.share({ title: title, url: url }).catch(function(){ window.open(link.href, '_blank', 'noopener'); });
    });
});
</script>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const container = document.getElementById('cta-extracted-widget');
  if (!container) return;

  // Candidate containers to scan for CTA buttons on this page
  const candidateSelectors = [
    '.blog-detail_text',        // Buttons possibly embedded in the article content
    'section.cta-one',          // Global CTA sections if present
    'section.cta-two',          // Global CTA sections if present
    '.event-detail_button'      // Parity with event detail template
  ];

  const collected = [];
  const seen = new Set();

  function classifyCategory(anchor) {
    const ds = anchor.dataset?.category;
    if (ds) return ds;
    const cls = anchor.classList;
    // Map button styles to human-friendly categories
    if (cls.contains('btn-style-three')) return 'Pendaftaran';
    if (cls.contains('btn-style-one')) return 'Unduhan';
    if (cls.contains('btn-style-two')) return 'Informasi';
    return 'Lainnya';
  }

  candidateSelectors.forEach(sel => {
    document.querySelectorAll(sel + ' a.theme-btn').forEach(a => {
      const href = a.getAttribute('href') || '#';
      const text = (a.textContent || '').trim();
      const key = href + '|' + text;
      if (!text) return; // skip empty labels
      if (seen.has(key)) return; // de-duplicate
      seen.add(key);
      collected.push({
        href,
        text,
        category: classifyCategory(a)
      });
    });
  });

  if (!collected.length) {
    container.innerHTML = '<p>Tidak ada CTA ditemukan.</p>';
    return;
  }

  // Group by category
  const groups = collected.reduce((acc, item) => {
    (acc[item.category] = acc[item.category] || []).push(item);
    return acc;
  }, {});

  // Render groups with clear separation
  const frag = document.createDocumentFragment();
  Object.keys(groups).sort().forEach(cat => {
    const group = document.createElement('div');
    group.className = 'cta-list-group';

    const title = document.createElement('h5');
    title.className = 'cta-group-title';
    title.textContent = cat;
    group.appendChild(title);

    const ul = document.createElement('ul');
    ul.className = 'cta-link-list';
    groups[cat].forEach(item => {
      const li = document.createElement('li');
      const link = document.createElement('a');
      link.href = item.href;
      link.textContent = item.text;
      link.className = 'cta-link';
      link.rel = 'noopener';
      li.appendChild(link);
      ul.appendChild(li);
    });
    group.appendChild(ul);
    frag.appendChild(group);
  });

  container.innerHTML = '';
  container.appendChild(frag);
});
</script>
@endpush
@endsection
