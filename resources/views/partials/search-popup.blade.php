<!-- Search Popup -->
<div class="search-popup" aria-modal="true" role="dialog">
    <div class="color-layer" aria-hidden="true"></div>
    <button class="close-search" type="button" aria-label="Tutup pencarian"><span class="fa fa-arrow-up"></span></button>
    <form method="get" action="{{ route('berita') }}" novalidate>
        <div class="form-group">
            <input
                type="search"
                name="q"
                value="{{ old('q', isset($query) ? e($query) : '') }}"
                placeholder="Cari berita..."
                minlength="2"
                maxlength="100"
                required
                autocomplete="off"
            >
            <button type="submit" class="theme-btn" aria-label="Cari"><i class="fa fa-search"></i></button>
        </div>
        @error('q')
            <div class="text-danger small" role="alert">{{ $message }}</div>
        @enderror
    </form>
</div>