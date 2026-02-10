<div class="utility-bar">
        <div class="toolbar-actions">
            <div class="toolbar-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotifications"
                aria-controls="offcanvasNotifications">
                <div class="toolbar-btn-badge">12</div>
                <i class="lni lni-bell-1"></i>
            </div>
            <div class="toolbar-btn" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="lni lni-search-2"></i>
            </div>
        </div>
        <div class="agency-stamp">Developera’s Designed and Developed</div>
    </div>


    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="searchInput" class="form-label">Search</label>
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search">

                    </div>
                    <div class="recent-searches">
                        <label for="searchInput" class="form-label" style="font-size: 12px;">Recent Searchs</label>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark">Dashboard</span>
                            <span class="badge bg-light text-dark">Analytics</span>
                            <span class="badge bg-light text-dark">Reports</span>
                            <span class="badge bg-light text-dark">Settings</span>
                            <span class="badge bg-light text-dark">Profile</span>
                            <span class="badge bg-light text-dark">Help</span>
                        </div>
                    </div>
                    <div class="suggested-search">
                        <label for="searchInput" class="form-label" style="font-size: 12px;">Suggested
                            Searches</label>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark">Users</span>
                            <span class="badge bg-light text-dark">Sales</span>
                            <span class="badge bg-light text-dark">Marketing</span>
                            <span class="badge bg-light text-dark">Development</span>
                            <span class="badge bg-light text-dark">Support</span>
                            <span class="badge bg-light text-dark">Finance</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Modal -->

    <!-- Notifications Offcanvas -->
    <div class="offcanvas offcanvas-end m-md-3 md-lg-3 notification-offcanvas" tabindex="-1" id="offcanvasNotifications"
        aria-labelledby="offcanvasNotificationsLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasNotificationsLabel">Notifications</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <!-- Notification Filters -->
            <div class="d-flex justify-content-end align-items-center text-end border-bottom">

                <button class="btn btn-sm btn-link text-decoration-none highlight-text">Mark all as read</button>
            </div>

            <!-- Notifications List -->
            <div class="list-group list-group-flush notification-list">
                <!-- Notification Item 1 - Unread -->
                <a href="#" class="list-group-item list-group-item-action border-0 border-bottom">
                    <div class="d-flex w-100 align-items-start">
                        <div class="flex-shrink-0 me-3">
                            <div
                                class="bg-danger-light rounded-circle d-flex align-items-center justify-content-center text-danger notification-icon">
                                <i class="lni lni-island-2"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-semibold fs-16">New Order</h6>
                                <small class="text-muted fs-14">2m</small>
                            </div>
                            <p class="mb-1 small fs-14">John Doe placed an order of $250</p>
                            <span class="badge bg-primary rounded-pill fs-14">New</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Empty State (hidden by default, show when no notifications) -->
            <div class="text-center py-5 d-none">
                <i class="bi bi-bell-slash fs-1 text-muted"></i>
                <p class="text-muted mt-3">No notifications yet</p>
            </div>
        </div>
    </div>
    <!-- End Notifications Offcanvas -->