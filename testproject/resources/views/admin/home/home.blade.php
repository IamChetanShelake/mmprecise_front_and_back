@extends('layouts.app')

@section('content')
<!-- Home Section - Modern Dashboard -->
<div id="home" class="section active">
    <!-- Welcome Header -->
    <div class="welcome-header">
        <div class="welcome-content">
            <div class="welcome-text">
                <h1 class="welcome-title">
                    <i class="bi bi-house-door-fill"></i>
                    Welcome to Your Website Dashboard
                </h1>
                <p class="welcome-subtitle">Manage all aspects of your company website from this central hub</p>
            </div>
            <div class="welcome-stats">
                <div class="stat-item">
                    <div class="stat-number">{{ \App\Models\Hero::count() + \App\Models\About::count() + \App\Models\CompanyOverview::count() + \App\Models\Expertise::count() + \App\Models\Achievement::count() + \App\Models\WhyChoose::count() + \App\Models\FeaturedHighlight::count() + \App\Models\ClientFeedback::count() + \App\Models\LatestNews::count() + \App\Models\Partner::count() + \App\Models\Leadership::count() + \App\Models\Team::count() }}</div>
                    <div class="stat-label">Total Content Items</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ \App\Models\Career::where('is_active', true)->count() }}</div>
                    <div class="stat-label">Active Job Openings</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ \App\Models\ClientFeedback::where('is_active', true)->count() }}</div>
                    <div class="stat-label">Published Testimonials</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2 class="section-heading">
            <i class="bi bi-lightning-charge"></i>
            Quick Actions
        </h2>
        <div class="actions-grid">
            <a href="{{ route('admin.hero.create') }}" class="action-card primary">
                <div class="action-icon">
                    <i class="bi bi-plus-circle"></i>
                </div>
                <div class="action-content">
                    <h3>Add Hero Section</h3>
                    <p>Create a new hero banner</p>
                </div>
            </a>
            <a href="{{ route('admin.achievements.create') }}" class="action-card success">
                <div class="action-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <div class="action-content">
                    <h3>Add Achievement</h3>
                    <p>Showcase company success</p>
                </div>
            </a>
            <a href="{{ route('admin.latest-news.create') }}" class="action-card info">
                <div class="action-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="action-content">
                    <h3>Publish News</h3>
                    <p>Share company updates</p>
                </div>
            </a>
            <a href="{{ route('admin.careers.create') }}" class="action-card warning">
                <div class="action-icon">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="action-content">
                    <h3>Post Job Opening</h3>
                    <p>Attract new talent</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Content Sections -->
    <div class="content-sections">
        <h2 class="section-heading">
            <i class="bi bi-grid-3x3-gap"></i>
            Content Management
        </h2>
        <div class="sections-grid">
            <!-- Hero & Branding -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-palette"></i>
                    Hero & Branding
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon hero">
                                <i class="bi bi-image"></i>
                            </div>
                            <div class="card-info">
                                <h4>Hero Section</h4>
                                <span class="item-count">{{ \App\Models\Hero::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.hero') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.hero.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Information -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-building"></i>
                    Company Information
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon about">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="card-info">
                                <h4>About Section</h4>
                                <span class="item-count">{{ \App\Models\About::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.about') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.about.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon overview">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="card-info">
                                <h4>Company Overview</h4>
                                <span class="item-count">{{ \App\Models\CompanyOverview::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.company-overview') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.company-overview.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services & Expertise -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-tools"></i>
                    Services & Expertise
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon expertise">
                                <i class="bi bi-tools"></i>
                            </div>
                            <div class="card-info">
                                <h4>Expertise</h4>
                                <span class="item-count">{{ \App\Models\Expertise::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.expertise') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.expertise.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon specializations">
                                <i class="bi bi-gear-wide-connected"></i>
                            </div>
                            <div class="card-info">
                                <h4>Technical Specializations</h4>
                                <span class="item-count">{{ \App\Models\TechnicalSpecialization::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.technical-specializations') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.technical-specializations.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Achievements & Social Proof -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-trophy"></i>
                    Achievements & Social Proof
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon achievements">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <div class="card-info">
                                <h4>Achievements</h4>
                                <span class="item-count">{{ \App\Models\Achievement::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.achievements') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.achievements.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon feedback">
                                <i class="bi bi-chat-quote"></i>
                            </div>
                            <div class="card-info">
                                <h4>Client Feedback</h4>
                                <span class="item-count">{{ \App\Models\ClientFeedback::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.clients-feedback') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.clients-feedback.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content & Marketing -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-megaphone"></i>
                    Content & Marketing
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon highlights">
                                <i class="bi bi-star"></i>
                            </div>
                            <div class="card-info">
                                <h4>Featured Highlights</h4>
                                <span class="item-count">{{ \App\Models\FeaturedHighlight::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.featured-highlights') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.featured-highlights.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon news">
                                <i class="bi bi-newspaper"></i>
                            </div>
                            <div class="card-info">
                                <h4>Latest News</h4>
                                <span class="item-count">{{ \App\Models\LatestNews::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.latest-news') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.latest-news.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team & Leadership -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-people"></i>
                    Team & Leadership
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon leadership">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            <div class="card-info">
                                <h4>Leadership</h4>
                                <span class="item-count">{{ \App\Models\Leadership::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.leadership') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.leadership.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon team">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="card-info">
                                <h4>Team Members</h4>
                                <span class="item-count">{{ \App\Models\Team::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.team') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.team.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Operations -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-briefcase"></i>
                    Business Operations
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon careers">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="card-info">
                                <h4>Careers</h4>
                                <span class="item-count">{{ \App\Models\Career::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.careers') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.careers.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon applications">
                                <i class="bi bi-file-earmark-person"></i>
                            </div>
                            <div class="card-info">
                                <h4>Job Applications</h4>
                                <span class="item-count">{{ \App\Models\JobApplication::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.job-applications') }}" class="btn-view">View</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact & Support -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-headset"></i>
                    Contact & Support
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon contact">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="card-info">
                                <h4>Get In Touch</h4>
                                <span class="item-count">{{ \App\Models\GetInTouch::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.get-in-touch') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.get-in-touch.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon form">
                                <i class="bi bi-envelope-paper"></i>
                            </div>
                            <div class="card-info">
                                <h4>Contact Form</h4>
                                <span class="item-count">Manage</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.contact-form') }}" class="btn-view">View</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Sections -->
            <div class="section-group">
                <h3 class="group-title">
                    <i class="bi bi-plus-circle"></i>
                    Additional Sections
                </h3>
                <div class="group-cards">
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon partners">
                                <i class="bi bi-handshake"></i>
                            </div>
                            <div class="card-info">
                                <h4>Partners</h4>
                                <span class="item-count">{{ \App\Models\Partner::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.partners') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.partners.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon why-choose">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="card-info">
                                <h4>Why Choose Us</h4>
                                <span class="item-count">{{ \App\Models\WhyChoose::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.why-choose') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.why-choose.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon hours">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="card-info">
                                <h4>Business Hours</h4>
                                <span class="item-count">{{ \App\Models\BusinessHours::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.business-hours') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.business-hours.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon mentorship">
                                <i class="bi bi-lightbulb"></i>
                            </div>
                            <div class="card-info">
                                <h4>Mentorship</h4>
                                <span class="item-count">{{ \App\Models\Mentorship::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.mentorship') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.mentorship.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon certifications">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="card-info">
                                <h4>Certifications</h4>
                                <span class="item-count">{{ \App\Models\Certification::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.certifications') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.certifications.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                    <div class="section-card">
                        <div class="card-header">
                            <div class="card-icon memberships">
                                <i class="bi bi-badge-ad"></i>
                            </div>
                            <div class="card-info">
                                <h4>Memberships</h4>
                                <span class="item-count">{{ \App\Models\Membership::count() }} items</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('admin.memberships') }}" class="btn-view">View</a>
                            <a href="{{ route('admin.memberships.create') }}" class="btn-add">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Home Dashboard Styles */

/* Welcome Header */
#home .welcome-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 3rem 2rem;
    margin-bottom: 3rem;
    box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
    position: relative;
    overflow: hidden;
}

#home .welcome-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="50" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.1;
}

#home .welcome-content {
    position: relative;
    z-index: 1;
    max-width: 1200px;
    margin: 0 auto;
}

#home .welcome-text {
    text-align: center;
    margin-bottom: 2rem;
}

#home .welcome-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin: 0 0 1rem 0;
    text-shadow: 0 4px 8px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

#home .welcome-title i {
    font-size: 3.5rem;
    opacity: 0.9;
}

#home .welcome-subtitle {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
}

#home .welcome-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

#home .stat-item {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

#home .stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.2);
}

#home .stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

#home .stat-label {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Quick Actions */
#home .quick-actions {
    margin-bottom: 3rem;
}

#home .section-heading {
    font-size: 2rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 2rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

#home .section-heading i {
    color: #FF6B35;
    font-size: 1.5rem;
}

#home .actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

#home .action-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

#home .action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

#home .action-card.primary {
    background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%);
    color: white;
    border: none;
}

#home .action-card.primary:hover {
    background: linear-gradient(135deg, #e55a2b 0%, #e67e3a 100%);
}

#home .action-card.success {
    border-left: 4px solid #10b981;
}

#home .action-card.success .action-icon {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

#home .action-card.info {
    border-left: 4px solid #3b82f6;
}

#home .action-card.info .action-icon {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
}

#home .action-card.warning {
    border-left: 4px solid #f59e0b;
}

#home .action-card.warning .action-icon {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}

#home .action-icon {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

#home .action-content h3 {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    color: inherit;
}

#home .action-content p {
    margin: 0;
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.4;
}

#home .action-card.primary .action-content p {
    color: rgba(255, 255, 255, 0.9);
}

/* Content Sections */
#home .content-sections {
    margin-bottom: 3rem;
}

#home .sections-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

#home .section-group {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

#home .section-group:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 48px rgba(0,0,0,0.12);
}

#home .group-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 2rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

#home .group-title i {
    color: #FF6B35;
    font-size: 1.25rem;
}

#home .group-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

#home .section-card {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

#home .section-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    background: white;
}

#home .card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

#home .card-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

#home .card-icon.hero { background: linear-gradient(135deg, #FF6B35 0%, #FF8C42 100%); }
#home .card-icon.about { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
#home .card-icon.overview { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
#home .card-icon.expertise { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
#home .card-icon.specializations { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); }
#home .card-icon.achievements { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
#home .card-icon.feedback { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
#home .card-icon.highlights { background: linear-gradient(135deg, #84cc16 0%, #65a30d 100%); }
#home .card-icon.news { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
#home .card-icon.partners { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
#home .card-icon.leadership { background: linear-gradient(135deg, #14b8a6 0%, #0f766e 100%); }
#home .card-icon.team { background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); }
#home .card-icon.careers { background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%); }
#home .card-icon.applications { background: linear-gradient(135deg, #64748b 0%, #475569 100%); }
#home .card-icon.contact { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); }
#home .card-icon.form { background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%); }
#home .card-icon.why-choose { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); }
#home .card-icon.hours { background: linear-gradient(135deg, #84cc16 0%, #65a30d 100%); }
#home .card-icon.mentorship { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
#home .card-icon.certifications { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
#home .card-icon.memberships { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }

#home .card-info {
    flex: 1;
}

#home .card-info h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 0.25rem 0;
}

#home .item-count {
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 500;
}

#home .card-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1rem;
}

#home .btn-view, #home .btn-add {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

#home .btn-view {
    background: #e5e7eb;
    color: #374151;
}

#home .btn-view:hover {
    background: #d1d5db;
    color: #1f2937;
}

#home .btn-add {
    background: #FF6B35;
    color: white;
}

#home .btn-add:hover {
    background: #e55a2b;
    color: white;
}

/* Responsive Design */
@media (max-width: 1200px) {
    #home .sections-grid {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    }

    #home .group-cards {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    #home .welcome-header {
        padding: 2rem 1.5rem;
    }

    #home .welcome-title {
        font-size: 2.5rem;
        flex-direction: column;
        gap: 0.5rem;
    }

    #home .welcome-title i {
        font-size: 2.5rem;
    }

    #home .welcome-subtitle {
        font-size: 1.1rem;
    }

    #home .welcome-stats {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    #home .actions-grid {
        grid-template-columns: 1fr;
    }

    #home .sections-grid {
        grid-template-columns: 1fr;
    }

    #home .section-group {
        padding: 2rem 1.5rem;
    }

    #home .group-title {
        font-size: 1.25rem;
    }

    #home .action-card {
        padding: 1.5rem;
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    #home .section-card {
        padding: 1.25rem;
    }

    #home .card-header {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
}

@media (max-width: 480px) {
    #home .welcome-title {
        font-size: 2rem;
    }

    #home .welcome-title i {
        font-size: 2rem;
    }

    #home .section-heading {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 0.5rem;
    }

    #home .group-title {
        font-size: 1.125rem;
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endsection
