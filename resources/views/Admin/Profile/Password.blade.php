<x-admin.layout tabTitle="Profile Password" pageTitle="Manage my profile details and settings"
    breadcrumb="Home ➔ Profile ➔ Password">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Profile.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Profile Password', 'isBackButton' =>
            true, 'backURL' => '/admin/profile', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <form action="#" method="POST">
                    <div class="row mt-md-5 mt-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Current Password</label>
                            <input type="password" class="form-control" name="current_password" placeholder="Enter current password">
                        </div>
                        <div class="col-md-12 mb-3">Fill out the new passwords</div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">New Password</label>
                            <input type="password" class="form-control" name="new_password" placeholder="Enter new password">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_new_password" placeholder="Confirm new password">
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</x-admin.layout>