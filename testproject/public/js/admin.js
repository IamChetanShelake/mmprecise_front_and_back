// Contractor Admin Panel JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Get all navigation links
    const navLinks = document.querySelectorAll('.sidebar .nav-link');
    const sections = document.querySelectorAll('.section');

    // Since we now use separate pages for each section, the section showing/hiding logic is not needed
    // Each page displays only its designated section

    // Add smooth scrolling for better UX
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Scroll to top of main content on mobile
            if (window.innerWidth < 768) {
                document.querySelector('main').scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Add keyboard navigation support
    document.addEventListener('keydown', function(e) {
        // Allow navigation with arrow keys
        const activeLink = document.querySelector('.sidebar .nav-link.active');
        if (!activeLink) return;

        const links = Array.from(navLinks);
        const currentIndex = links.indexOf(activeLink);

        if (e.key === 'ArrowDown' && currentIndex < links.length - 1) {
            e.preventDefault();
            links[currentIndex + 1].click();
        } else if (e.key === 'ArrowUp' && currentIndex > 0) {
            e.preventDefault();
            links[currentIndex - 1].click();
        }
    });

    // Add loading animation for section transitions
    sections.forEach(section => {
        section.addEventListener('transitionend', function() {
            // Remove loading class if added
            this.classList.remove('loading');
        });
    });

    // Responsive sidebar toggle for mobile
    const sidebar = document.querySelector('.sidebar');
    let sidebarVisible = window.innerWidth >= 768;

    function toggleSidebar() {
        if (window.innerWidth < 768) {
            sidebarVisible = !sidebarVisible;
            if (sidebarVisible) {
                sidebar.style.transform = 'translateX(0)';
            } else {
                sidebar.style.transform = 'translateX(-100%)';
            }
        }
    }

    // Add toggle button for mobile (if needed in future)
    // const toggleBtn = document.createElement('button');
    // toggleBtn.innerHTML = '<i class="bi bi-list"></i>';
    // toggleBtn.className = 'btn btn-primary d-md-none position-fixed';
    // toggleBtn.style.cssText = 'top: 10px; left: 10px; z-index: 1001;';
    // toggleBtn.addEventListener('click', toggleSidebar);
    // document.body.appendChild(toggleBtn);

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            sidebar.style.transform = '';
            sidebarVisible = true;
        } else {
            sidebarVisible = false;
            sidebar.style.transform = 'translateX(-100%)';
        }
    });

    // Sidebar toggle functionality - hover based
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        // Make sidebar hidden by default
        sidebar.classList.add('hidden');

        sidebarToggle.addEventListener('mouseenter', function() {
            sidebar.classList.remove('hidden');
        });

        sidebar.addEventListener('mouseenter', function() {
            sidebar.classList.remove('hidden');
        });

        sidebar.addEventListener('mouseleave', function() {
            sidebar.classList.add('hidden');
        });
    }

    // Initialize sidebar state on load
    if (window.innerWidth < 768) {
        sidebar.style.transform = 'translateX(-100%)';
    } else {
        // Ensure sidebar is hidden by default on desktop
        sidebar.classList.add('hidden');
    }

    // Add scroll event listener to sidebar navigation container
    const sidebarNavContainer = document.querySelector('.sidebar-nav-container');
    if (sidebarNavContainer) {
        sidebarNavContainer.addEventListener('scroll', function() {
            console.log('Sidebar navigation scrolled');
        });
    }
});
