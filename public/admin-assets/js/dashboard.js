document.addEventListener("DOMContentLoaded", function () {
    // Select all nav items that have children
    const navItems = document.querySelectorAll(".sidebar-nav-item");

    navItems.forEach(item => {
        const activeChild = item.querySelector(".sidebar-nav-item-childs .sidebar-nav-item-child.active");
        if (activeChild) {
            // Add a class to the parent if any child is active
            item.classList.add("open");
        }
    });
});

// Toggle sidebar

function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("collapsed");
}

// Global Search Functionality
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('globalSearchInput');
    const searchResults = document.getElementById('searchResults');
    const searchResultsContent = document.getElementById('searchResultsContent');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            if (query.length > 2) {
                performSearch(query);
            } else {
                searchResults.style.display = 'none';
            }
        });

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const query = this.value.trim();
                if (query.length > 0) {
                    performSearch(query);
                }
            }
        });
    }

    function performSearch(query) {
        // Show loading state
        searchResultsContent.innerHTML = '<div class="text-center"><div class="spinner-border spinner-border-sm" role="status"></div> Searching...</div>';
        searchResults.style.display = 'block';

        // Simulate search results (replace with actual API call)
        setTimeout(() => {
            const results = getMockSearchResults(query);
            displaySearchResults(results);
        }, 500);
    }

    function getMockSearchResults(query) {
        // Mock search results - replace with actual API endpoints
        const results = [];

        // Mock users
        if (query.toLowerCase().includes('user') || query.toLowerCase().includes('john') || query.toLowerCase().includes('admin')) {
            results.push({
                type: 'Users',
                items: [
                    { title: 'John Doe', subtitle: 'john@example.com', url: '/admin/users/1', icon: 'lni-user' },
                    { title: 'Admin User', subtitle: 'admin@example.com', url: '/admin/users/2', icon: 'lni-user' }
                ]
            });
        }

        // Mock donations
        if (query.toLowerCase().includes('donation') || query.toLowerCase().includes('payment') || query.toLowerCase().includes('$')) {
            results.push({
                type: 'Donations',
                items: [
                    { title: 'Donation #1234', subtitle: '$250.00 - Completed', url: '/admin/donations/1234', icon: 'lni-dollar' },
                    { title: 'Donation #1235', subtitle: '$150.00 - Pending', url: '/admin/donations/1235', icon: 'lni-dollar' }
                ]
            });
        }

        // Mock programs
        if (query.toLowerCase().includes('program') || query.toLowerCase().includes('campaign')) {
            results.push({
                type: 'Programs',
                items: [
                    { title: 'Education Fund', subtitle: 'Active Campaign', url: '/admin/programs/1', icon: 'lni-graduation' },
                    { title: 'Medical Aid', subtitle: 'Emergency Fund', url: '/admin/programs/2', icon: 'lni-heart' }
                ]
            });
        }

        return results;
    }

    function displaySearchResults(results) {
        if (results.length === 0) {
            searchResultsContent.innerHTML = '<p class="text-muted">No results found</p>';
            return;
        }

        let html = '';
        results.forEach(group => {
            html += `<div class="search-group mb-3">
                <h6 class="text-muted mb-2">${group.type}</h6>`;
            group.items.forEach(item => {
                html += `<a href="${item.url}" class="d-flex align-items-center p-2 text-decoration-none search-result-item">
                    <i class="lni ${item.icon} me-3"></i>
                    <div>
                        <div class="fw-semibold">${item.title}</div>
                        <small class="text-muted">${item.subtitle}</small>
                    </div>
                </a>`;
            });
            html += '</div>';
        });

        searchResultsContent.innerHTML = html;
    }
});

