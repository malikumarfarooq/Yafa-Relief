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
                        <img src="{{ $user->AvatarUrl }}" alt="User Avatar" class="w-75 rounded mb-5">
                    </div>
                    <div class="col-md-10 position-relative">
                        <div class="user-profile-general-info">
                            <div class="mb-2 d-flex justify-content-between align-items-center">
                                {!! $user->StatusBadge !!}
                                <a href="/admin/profile/edit" class="highlight-text fs-24"><i
                                        class="lni lni-pen-to-square"></i></a>
                            </div>
                            <h3>{{ $user->f_name }} {{ $user->l_name }}</h3>
                            <div class="profile-info-line"><strong>Email:</strong> {{ $user->email }}
                            </div>
                            <div class="profile-info-line"><strong>Role:</strong> {{ ucfirst($user->roles->first()->name
                                ?? 'No Role Assigned') }}</div>
                            <br>
                            <div class="profile-info-line"><strong>Contact Number:</strong> {{ $user->phone ?? 'Not
                                Provided' }}</div>
                            <br>
                            <div class="profile-info-line"><strong>Address Line 1:</strong> {{ $user->UserAddress ?
                                $user->UserAddress['address_line1'] : '' }}</div>
                            <div class="profile-info-line"><strong>Address Line 2:</strong> {{ $user->UserAddress ?
                                $user->UserAddress['address_line2'] : '' }}</div>
                            <div class="profile-info-line"><strong>City:</strong> {{ $user->UserAddress ?
                                $user->UserAddress['city'] : '' }}</div>
                            <div class="profile-info-line"><strong>State:</strong> {{ $user->UserAddress ?
                                $user->UserAddress['state'] : ''}}</div>
                            <div class="profile-info-line"><strong>Country:</strong> {{ $user->UserAddress ?
                                $user->UserAddress['country'] : '' }}
                            </div>
                            <div class="profile-info-line"><strong>Zip/Postal Code:</strong> {{ $user->UserAddress ?
                                $user->UserAddress['postal_code'] : '' }}</div>
                            <br>
                            <div class="profile-info-line"><strong>Joined:</strong> {{
                                \Carbon\Carbon::parse($user->created_at)->format('F j, Y | g:i A') }}
                            </div>
                            <div class="profile-info-line"><strong>Last Active:</strong> {{ $user->last_login_at ?
                                \Carbon\Carbon::parse($user->last_login_at)->format('F j, Y | g:i A') : 'Never' }}</div>
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