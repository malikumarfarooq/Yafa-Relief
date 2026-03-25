<div class="utility-bar">
        <div class="toolbar-actions">
            <div class="toolbar-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotifications"
                aria-controls="offcanvasNotifications">
                <div class="toolbar-btn-badge">{{ \App\Models\ContactMessage::where('status', 'new')->count() + \App\Models\Donation::where('payment_status', 'paid')->where('created_at', '>', now()->subDays(1))->count() }}</div>
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
                        <input type="text" class="form-control" id="globalSearchInput" placeholder="Search users, donations, programs..." aria-label="Search">
                    </div>
                    <div class="recent-searches">
                        <label for="searchInput" class="form-label" style="font-size: 12px;">Recent Searches</label>
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
                        <label for="searchInput" class="form-label" style="font-size: 12px;">Suggested Searches</label>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark">Users</span>
                            <span class="badge bg-light text-dark">Sales</span>
                            <span class="badge bg-light text-dark">Marketing</span>
                            <span class="badge bg-light text-dark">Development</span>
                            <span class="badge bg-light text-dark">Support</span>
                            <span class="badge bg-light text-dark">Finance</span>
                        </div>
                    </div>
                    <div id="searchResults" class="mt-3" style="display: none;">
                        <h6>Search Results</h6>
                        <div id="searchResultsContent"></div>
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
                <!-- Recent Donations -->
                @php
                    $recentDonations = \App\Models\Donation::where('payment_status', 'paid')
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                @endphp

                @if($recentDonations->count() > 0)
                @foreach($recentDonations as $donation)
                <a href="{{ route('admin.donations.show', $donation->donation_number) }}" class="list-group-item list-group-item-action border-0 border-bottom">
                    <div class="d-flex w-100 align-items-start">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-success-light rounded-circle d-flex align-items-center justify-content-center text-success notification-icon">
                                <i class="lni lni-dollar"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-semibold fs-16">New Donation</h6>
                                <small class="text-muted fs-14">{{ $donation->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 small fs-14">${{ number_format($donation->total_amount, 2) }} from {{ $donation->first_name }} {{ $donation->last_name }}</p>
                            <span class="badge bg-success rounded-pill fs-14">Paid</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif

                <!-- New Contact Messages -->
                @php
                    $newMessages = \App\Models\ContactMessage::where('status', 'new')
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();
                @endphp

                @if($newMessages->count() > 0)
                @foreach($newMessages as $message)
                <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="list-group-item list-group-item-action border-0 border-bottom">
                    <div class="d-flex w-100 align-items-start">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-warning-light rounded-circle d-flex align-items-center justify-content-center text-warning notification-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-semibold fs-16">New Message</h6>
                                <small class="text-muted fs-14">{{ $message->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 small fs-14">{{ Str::limit($message->subject, 40) }}</p>
                            <span class="badge bg-warning rounded-pill fs-14">New</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif

                <!-- Newsletter Subscriptions -->
                @php
                    $recentSubscriptions = \App\Models\Newsletter::where('status', 'subscribed')
                        ->where('created_at', '>', now()->subDays(1))
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
                @endphp

                @if($recentSubscriptions->count() > 0)
                @foreach($recentSubscriptions as $subscription)
                <a href="{{ route('admin.settings.newsletters.index') }}" class="list-group-item list-group-item-action border-0 border-bottom">
                    <div class="d-flex w-100 align-items-start">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-info-light rounded-circle d-flex align-items-center justify-content-center text-info notification-icon">
                                <i class="lni lni-user"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 fw-semibold fs-16">New Subscriber</h6>
                                <small class="text-muted fs-14">{{ $subscription->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 small fs-14">{{ $subscription->email }}</p>
                            <span class="badge bg-info rounded-pill fs-14">Subscribed</span>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif
            </div>

            <!-- Empty State -->
            @if($recentDonations->count() == 0 && $newMessages->count() == 0 && $recentSubscriptions->count() == 0)
            <div class="text-center py-5">
                <i class="bi bi-bell-slash fs-1 text-muted"></i>
                <p class="text-muted mt-3">No notifications yet</p>
            </div>
            @endif
        </div>
    </div>
    <!-- End Notifications Offcanvas -->