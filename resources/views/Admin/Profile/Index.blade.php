<x-admin.layout tabTitle="Profile" pageTitle="Manage my profile details and settings" breadcrumb="Home ➔ Profile">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Profile.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'My Profile', 'isBackButton' =>
            true, 'backURL' => '/admin/dashboard', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <div class="row mt-md-5 mt-3">
                    <div class="col-md-2 text-md-end text-center">
                        <img src="/admin-assets/images/user-avatar.jpg" alt="User Avatar" class="w-75 rounded mb-5">
                    </div>
                    <div class="col-md-10 position-relative">
                        <div class="user-profile-general-info">
                            <div class="mb-2 d-flex justify-content-between align-items-center"><span
                                    class="badge rounded-pill bg-success">Active</span> 
                                    <a href="/admin/profile/edit" class="highlight-text fs-24"><i class="lni lni-pen-to-square"></i></a></div>
                            <h3>John Doe</h3>
                            <div class="profile-info-line"><strong>Email:</strong> salamaslam.official@gmail.com
                            </div>
                            <div class="profile-info-line"><strong>Role:</strong> Administrator</div>
                            <br>
                            <div class="profile-info-line"><strong>Contact Number:</strong> +923468887736</div>
                            <br>
                            <div class="profile-info-line"><strong>Address:</strong> Street 43, NYC</div>
                            <div class="profile-info-line"><strong>State:</strong> Washington DC</div>
                            <div class="profile-info-line"><strong>Country:</strong> United States of America
                            </div>
                            <div class="profile-info-line"><strong>Zip/Postal Code:</strong> 64132455</div>
                            <br>
                            <div class="profile-info-line"><strong>Joined:</strong> January 15, 2023 | 08:10 am
                            </div>
                            <div class="profile-info-line"><strong>Last Active:</strong> January 15, 2023 |
                                05:15 pm</div>
                        </div>
                        <div class="entity-action-section my-5">
                            <h5 class="fw-bold">Delete account</h5>
                            <p class="text-muted">Once you delete a user, there is no going back. Please be
                                certain.</p>
                            <button class="btn btn-danger me-2">Delete User</button>
                        </div>
                        <div class="activity-section">
                            <h5 class="fw-bold mb-2 p-3">Logs History</h5>
                            <div class="logs-items px-1">
                                <ul class="logs-list">
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                    <li>
                                        <h6>New Customer</h6>
                                        <p class="text-muted fs-12 mb-1">John Doe added a new customer "Acme
                                            Corp" to the system.</p>
                                        <span class="log-timestamp fs-10">2024-08-10 | 14:32</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>