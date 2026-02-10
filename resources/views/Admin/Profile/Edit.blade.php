<x-admin.layout tabTitle="Edit My Profile" pageTitle="Manage my profile details and settings"
    breadcrumb="Home ➔ Profile ➔ Edit">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Profile.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Edit My Profile', 'isBackButton' =>
            true, 'backURL' => '/admin/profile', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="row mt-md-5 mt-3">
                        <!-- Avatar -->
                        <div class="col-md-2 text-md-end text-center">
                            <img src="/admin-assets/images/user-avatar.jpg" alt="User Avatar" class="w-100 rounded mb-3">

                            <input type="file" class="form-control" name="avatar">
                            <small class="text-muted">Upload a new profile picture (Max size 2MB)</small>
                        </div>

                        <!-- Profile Info -->
                        <div class="col-md-10 position-relative">
                            <div class="user-profile-general-info row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="John">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="Doe">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="salamaslam.official@gmail.com" disabled readonly>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label fw-bold">Contact Number</label>
                                    <input type="text" class="form-control" name="contact" value="+923468887736">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Bio</label>
                                    <textarea class="form-control h-auto" name="bio"
                                        rows="3">Administrator of the system</textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label fw-bold">Address Line 1</label>
                                    <input type="text" class="form-control" name="address" value="Street 43, NYC">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Address Line 2</label>
                                    <input type="text" class="form-control" name="address2" value="">
                                </div>


                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">State</label>
                                        <input type="text" class="form-control" name="state" value="Washington DC">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Country</label>
                                        <input type="text" class="form-control" name="country"
                                            value="United States of America">
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Zip / Postal Code</label>
                                        <input type="text" class="form-control" name="zip" value="64132455">
                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-primary">
                                Save Changes
                            </button>
                            <!-- Delete Account -->
                            <div class="entity-action-section my-5">
                                <h5 class="fw-bold text-danger">Delete account</h5>
                                <p class="text-muted">
                                    Once you delete your account, there is no going back. Please be certain.
                                </p>
                                <button type="button" class="btn btn-danger me-2">
                                    Delete My Account
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin.layout>

