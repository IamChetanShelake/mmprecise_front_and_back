<!-- Sidebar -->
<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
    <div>
        <div class="logo-container p-3 mb-0">
            <img src="{{ asset('images/MM Precise.png') }}" alt="MM Precise Logo" class="logo-img">
        </div>
        <div class="sidebar-nav-container">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'home' ? 'active' : '' }}" href="{{ route('admin.home') }}" data-section="home">
                    <i class="bi bi-house-door"></i> <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'hero' ? 'active' : '' }}" href="{{ route('admin.hero') }}" data-section="hero">
                    <i class="bi bi-image"></i> <span>Hero Section</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'about' ? 'active' : '' }}" href="{{ route('admin.about') }}" data-section="about">
                    <i class="bi bi-info-circle"></i> <span>About Section</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'company-overview' ? 'active' : '' }}" href="{{ route('admin.company-overview') }}" data-section="company-overview">
                    <i class="bi bi-building"></i> <span>Company Overview</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'leadership' ? 'active' : '' }}" href="{{ route('admin.leadership') }}" data-section="leadership">
                    <i class="bi bi-person-badge"></i> <span>Leadership</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'team' ? 'active' : '' }}" href="{{ route('admin.team') }}" data-section="team">
                    <i class="bi bi-people"></i> <span>Our Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'mentorship' ? 'active' : '' }}" href="{{ route('admin.mentorship') }}" data-section="mentorship">
                    <i class="bi bi-lightbulb"></i> <span>Mentorship & Knowledge</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'expertise' ? 'active' : '' }}" href="{{ route('admin.expertise') }}" data-section="expertise">
                    <i class="bi bi-tools"></i> <span>Our Expertise</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'technical-specializations' ? 'active' : '' }}" href="{{ route('admin.technical-specializations') }}" data-section="technical-specializations">
                    <i class="bi bi-gear"></i> <span>Technical Specializations</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'achievements' ? 'active' : '' }}" href="{{ route('admin.achievements') }}" data-section="achievements">
                    <i class="bi bi-trophy"></i> <span>Achievements & Awards</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'certifications' ? 'active' : '' }}" href="{{ route('admin.certifications') }}" data-section="certifications">
                    <i class="bi bi-award"></i> <span>Certifications & Membership</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'clients-feedback' ? 'active' : '' }}" href="{{ route('admin.clients-feedback') }}" data-section="clients-feedback">
                    <i class="bi bi-chat-quote"></i> <span>Clients Feedback</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'partners' ? 'active' : '' }}" href="{{ route('admin.partners') }}" data-section="partners">
                    <i class="bi bi-diagram-3"></i> <span>Our Partners</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'why-choose' ? 'active' : '' }}" href="{{ route('admin.why-choose') }}" data-section="why-choose">
                    <i class="bi bi-star"></i> <span>Why Choose Us</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'featured-highlights' ? 'active' : '' }}" href="{{ route('admin.featured-highlights') }}" data-section="featured-highlights">
                    <i class="bi bi-star-fill"></i> <span>Featured Highlights</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'latest-news' ? 'active' : '' }}" href="{{ route('admin.latest-news') }}" data-section="latest-news">
                    <i class="bi bi-newspaper"></i> <span>Latest News & Updates</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'business-hours' ? 'active' : '' }}" href="{{ route('admin.business-hours') }}" data-section="business-hours">
                    <i class="bi bi-clock"></i> <span>Business Hours</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'careers' ? 'active' : '' }}" href="{{ route('admin.careers') }}" data-section="careers">
                    <i class="bi bi-person-plus"></i> <span>Careers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'job-applications' ? 'active' : '' }}" href="{{ route('admin.job-applications') }}" data-section="job-applications">
                    <i class="bi bi-envelope-paper"></i> <span>Job Applications</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'contact-form' ? 'active' : '' }}" href="{{ route('admin.contact-form') }}" data-section="contact-form">
                    <i class="bi bi-envelope"></i> <span>Contact Form</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'get-in-touch' ? 'active' : '' }}" href="{{ route('admin.get-in-touch') }}" data-section="get-in-touch">
                    <i class="bi bi-telephone"></i> <span>Get In Touch</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeSection == 'projects' ? 'active' : '' }}" href="{{ route('admin.projects') }}" data-section="projects">
                    <i class="bi bi-folder"></i> <span>Projects</span>
                </a>
            </li>
            <li class="nav-item" style="padding-bottom: 90px;">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link logout {{ $activeSection == 'logout' ? 'active' : '' }}" data-section="logout" >
                        <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
        </div>
    </div>
</nav>

<!-- Sidebar Toggle Button -->
<button class="sidebar-toggle-btn" id="sidebarToggle">
    <i class="bi bi-chevron-left"></i>
</button>
