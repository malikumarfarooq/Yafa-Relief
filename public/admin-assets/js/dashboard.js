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
        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length > 2) {
                performSearch(query);
            } else {
                searchResults.style.display = 'none';
            }
        });

        searchInput.addEventListener('keypress', function (e) {
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

        // Fetch real search results from API
        fetch(`/api/admin/search?q=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Search failed');
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.results) {
                    displaySearchResults(data.results);
                } else {
                    searchResultsContent.innerHTML = '<p class="text-muted">No results found</p>';
                }
            })
            .catch(error => {
                console.error('Search error:', error);
                searchResultsContent.innerHTML = '<p class="text-danger">Error searching. Please try again.</p>';
            });
    }

    function displaySearchResults(results) {
        if (Object.keys(results).length === 0) {
            searchResultsContent.innerHTML = '<p class="text-muted">No results found</p>';
            return;
        }

        let html = '';
        Object.keys(results).forEach(key => {
            const group = results[key];
            if (group.items && group.items.length > 0) {
                html += `<div class="search-group mb-3">
                    <h6 class="text-muted mb-2">
                        <i class="lni ${group.icon} me-2"></i>
                        ${group.label}
                    </h6>`;
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
            }
        });

        if (html === '') {
            searchResultsContent.innerHTML = '<p class="text-muted">No results found</p>';
        } else {
            searchResultsContent.innerHTML = html;
        }
    }
});

