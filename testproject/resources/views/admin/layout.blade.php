@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky">
                <div class="logo-container p-3 mb-0">
                    <img src="{{ asset('images/MM Precise.png') }}" alt="MM Precise Logo" class="logo-img">
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ $activeSection == 'home' ? 'active' : '' }}" href="{{ route('admin.home') }}" data-section="home">
                            <i class="bi bi-house-door"></i> <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $activeSection == 'about' ? 'active' : '' }}" href="{{ route('admin.about') }}" data-section="about">
                            <i class="bi bi-info-circle"></i> <span>About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $activeSection == 'expertise' ? 'active' : '' }}" href="{{ route('admin.expertise') }}" data-section="expertise">
                            <i class="bi bi-tools"></i> <span>Expertise</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $activeSection == 'projects' ? 'active' : '' }}" href="{{ route('admin.projects') }}" data-section="projects">
                            <i class="bi bi-briefcase"></i> <span>Projects</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $activeSection == 'csr' ? 'active' : '' }}" href="{{ route('admin.csr') }}" data-section="csr">
                            <i class="bi bi-heart"></i> <span>CSR</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $activeSection == 'careers' ? 'active' : '' }}" href="{{ route('admin.careers') }}" data-section="careers">
                            <i class="bi bi-person-plus"></i> <span>Careers</span>
                        </a>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link {{ $activeSection == 'achievements' ? 'active' : '' }}" href="{{ route('admin.achievements') }}" data-section="achievements">
                            <i class="bi bi-trophy"></i> <span>Achievements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link logout {{ $activeSection == 'logout' ? 'active' : '' }}" data-section="logout" style="background: none; border: none; padding: 0; color: inherit; text-decoration: none; cursor: pointer;">
                                <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle-btn" id="sidebarToggle">
            <i class="bi bi-chevron-left"></i>
        </button>

        <!-- Main content -->
        <main>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            @yield('content')
        </main>
    </div>
</div>
@endsection
