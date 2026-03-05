<x-admin.layout tabTitle="Contact Messages" pageTitle="Contact Messages" breadcrumb="Home → Contact Messages">
    <div class="d-md-flex gap-3 mt-2">
        <div class="settings-tabs-section">
            <ul class="settings-links">
                <li>
                    <a href="{{ route('admin.contact-messages.index') }}"
                        class="{{ request()->routeIs('admin.contact-messages.index') && !request('status') ? 'active' : '' }}">
                        All Messages
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact-messages.index', ['status' => 'new']) }}"
                        class="{{ request('status') === 'new' ? 'active' : '' }}">
                        New Messages
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact-messages.index', ['status' => 'replied']) }}"
                        class="{{ request('status') === 'replied' ? 'active' : '' }}">
                        Replied
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact-messages.index', ['status' => 'closed']) }}"
                        class="{{ request('status') === 'closed' ? 'active' : '' }}">
                        Closed
                    </a>
                </li>
            </ul>
        </div>

        <div class="settings-details-section">
            @include('Admin.Partials.HeadNavigation', [
                'sectionTitle' => 'All Messages',
                'isBackButton' => false,
                'backURL' => '',
                'isActionButton' => false,
                'actionButtonText' => '',
                'actionButtonURL' => '',
                'btnClass' => '',
            ])
            <div class="content-wrapper">
                @livewire('admin.contact-messages.index')
            </div>
        </div>
    </div>
</x-admin.layout>
