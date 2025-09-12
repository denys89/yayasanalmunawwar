<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'CMS') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.75rem 1rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #495057;
        }
        .main-content {
            min-height: 100vh;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h5 class="text-white">CMS Panel</h5>
                        <small class="text-muted">{{ Auth::user()->name }}</small>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.dashboard*') ? 'active' : '' }}" href="{{ route('cms.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.pages*') ? 'active' : '' }}" href="{{ route('cms.pages.editor.index') }}">
                                <i class="bi bi-file-text me-2"></i>
                                Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.programs*') ? 'active' : '' }}" href="{{ route('cms.programs.index') }}">
                                <i class="bi bi-book me-2"></i>
                                Programs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.explores*') ? 'active' : '' }}" href="{{ route('cms.explores.index') }}">
                                <i class="bi bi-compass me-2"></i>
                                Explores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.news*') ? 'active' : '' }}" href="{{ route('cms.news.editor.index') }}">
                                <i class="bi bi-newspaper me-2"></i>
                                News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.admissions*') ? 'active' : '' }}" href="{{ route('cms.admissions.index') }}">
                                <i class="bi bi-person-plus me-2"></i>
                                Admissions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.media*') ? 'active' : '' }}" href="{{ route('cms.media.editor.index') }}">
                                <i class="bi bi-images me-2"></i>
                                Media
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.faqs*') ? 'active' : '' }}" href="{{ route('cms.faqs.index') }}">
                                <i class="bi bi-question-circle me-2"></i>
                                FAQs
                            </a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.users*') ? 'active' : '' }}" href="{{ route('cms.users.index') }}">
                                <i class="bi bi-people me-2"></i>
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cms.settings*') ? 'active' : '' }}" href="{{ route('cms.settings.index') }}">
                                <i class="bi bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>
                        @endif
                        
                        <hr class="text-muted">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-house me-2"></i>
                                Main Site
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-start w-100 border-0">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Top navbar -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('page-title', 'Dashboard')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('page-actions')
                    </div>
                </div>

                <!-- Flash messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Page content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>