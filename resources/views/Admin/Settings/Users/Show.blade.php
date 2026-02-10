<x-admin.layout tabTitle="User: John Doe" pageTitle="Manage the System Settings"
    breadcrumb="Home ➔ Settings ➔ Users ➔ John Doe">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Settings.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Viewing the System\'s User: John Doe',
            'isBackButton' =>
            true, 'backURL' => '/admin/settings/users', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
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
                                <a href="/admin/settings/users/1/edit" class="highlight-text fs-24"><i
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
                            <div class="profile-info-line"><strong>Address Line 1:</strong> {{ $user->UserAddress ? $user->UserAddress['address_line1'] : '' }}</div>
                            <div class="profile-info-line"><strong>Address Line 2:</strong> {{ $user->UserAddress ? $user->UserAddress['address_line2'] : '' }}</div>
                            <div class="profile-info-line"><strong>City:</strong> {{ $user->UserAddress ? $user->UserAddress['city'] : '' }}</div>
                            <div class="profile-info-line"><strong>State:</strong> {{ $user->UserAddress ? $user->UserAddress['state'] : ''}}</div>
                            <div class="profile-info-line"><strong>Country:</strong> {{ $user->UserAddress ? $user->UserAddress['country'] : '' }}
                            </div>
                            <div class="profile-info-line"><strong>Zip/Postal Code:</strong> {{ $user->UserAddress ? $user->UserAddress['postal_code'] : '' }}</div>
                            <br>
                            <div class="profile-info-line"><strong>Joined:</strong> {{
                                \Carbon\Carbon::parse($user->created_at)->format('F j, Y | g:i A') }}
                            </div>
                            <div class="profile-info-line"><strong>Last Active:</strong> {{ $user->last_login_at ?
                                \Carbon\Carbon::parse($user->last_login_at)->format('F j, Y | g:i A') : 'Never' }}</div>
                        </div>
                        <div class="entity-action-section my-5">
                            <h5 class="fw-bold">Delete account</h5>
                            <p class="text-muted">Once you delete a user, there is no going back. Please be
                                certain.</p>
                            <form method="POST" action="{{ route('admin.settings.users.destroy', $user->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')

                                @if($user->is_deletable)
                                <button type="submit" class="btn btn-danger me-2"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete User
                                </button>
                                @else
                                <span class="text-danger">This account cannot be deleted!</span>
                                @endif
                            </form>
                            @if (session()->has('error'))
                            <div class="alert alert-danger mt-3 d-flex justify-content-between align-items-center gap-3" style="position: fixed; bottom: 0px; right: 40px; z-index: 9999;">
                                <span class="pe-5">{{ session('error') }}</span> <span style="font-size: 48px" class="position-absolute top-50 start-100 translate-middle">😟</span>
                            </div>
                            @endif


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