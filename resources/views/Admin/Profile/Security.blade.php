<x-admin.layout tabTitle="Profile Security" pageTitle="Manage my profile details and settings"
    breadcrumb="Home ➔ Profile ➔ Security">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            @include('Admin.Profile.Partials.Navigation')
        </div>
        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', ['sectionTitle' => 'Profile Security', 'isBackButton' =>
            true, 'backURL' => '/admin/profile', 'isActionButton' => false, 'actionButtonText' => 'Add New User',
            'actionButtonURL' => '/admin/users/create', 'btnClass' => 'btn-dark'])

            <div class="content-wrapper">
                <div class="security-settings-section mt-md-5 mt-3">
                    <h5 class="">Multi-Factor Authentication Settings</h5>
                    <p>Enhance the security of your account by enabling multi-factor authentication methods. Choose one or more options below to add an extra layer of protection to your profile.</p>

                    <div class="security-setting-item mb-4 p-3 border rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5>Authenticator App</h5>
                                <p class="text-muted mb-0">Use an authenticator app to generate verification codes.</p>
                            </div>
                            <div>
                                <button class="btn btn-primary me-2">Enable</button>
                                <button class="btn btn-outline-secondary">Disable</button>
                            </div>
                        </div>
                        <small class="text-muted">Recommended: Use apps like Google Authenticator or Authy for better security.</small>
                    </div>
                    <div class="security-setting-item mb-4 p-3 border rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5>SMS Verification</h5>
                                <p class="text-muted mb-0">Receive verification codes via SMS to your registered phone number.</p>
                            </div>
                            <div>
                                <button class="btn btn-primary me-2">Enable</button>
                                <button class="btn btn-outline-secondary">Disable</button>
                            </div>
                        </div>
                        <small class="text-muted">Note: Standard messaging rates may apply.</small>
                    </div>
                    <div class="security-setting-item mb-4 p-3 border rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5>Email Verification</h5>
                                <p class="text-muted mb-0">Receive verification codes via email to your registered email address.</p>
                            </div>
                            <div>
                                <button class="btn btn-primary me-2">Enable</button>
                                <button class="btn btn-outline-secondary">Disable</button>
                            </div>
                        </div>
                        <small class="text-muted">Ensure your email is up-to-date to receive codes promptly.</small>
                    </div>
                </div>
                <div class="security-codes">
                    <h5 class="mt-5">Recovery Codes</h5>
                    <p>In case you lose access to your multi-factor authentication methods, you can use the recovery codes below to regain access to your account. Store these codes in a safe place.</p>
                    <div class="recovery-codes-list d-flex flex-wrap gap-2">
                        <span class="code-item p-2 border rounded bg-light">ABCD-EFGH</span>
                        <span class="code-item p-2 border rounded bg-light">IJKL-MNOP</span>
                        <span class="code-item p-2 border rounded bg-light">QRST-UVWX</span>
                        <span class="code-item p-2 border rounded bg-light">YZ12-3456</span>
                        <span class="code-item p-2 border rounded bg-light">7890-ABCD</span>
                        <span class="code-item p-2 border rounded bg-light">EFGH-IJKL</span>
                    </div>
                    <button class="btn btn-secondary mt-3">Generate New Recovery Codes</button>
                </div>


            </div>
        </div>
    </div>
</x-admin.layout>