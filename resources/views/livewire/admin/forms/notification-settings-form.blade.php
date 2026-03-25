<div>
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Email Notifications</h3>

            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" wire:model="settings.donation_confirmation" id="donation_confirmation" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="donation_confirmation" class="ml-2 block text-sm text-gray-900">
                        Send donation confirmation emails to donors
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="settings.admin_new_donation" id="admin_new_donation" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="admin_new_donation" class="ml-2 block text-sm text-gray-900">
                        Notify admin on new donations
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="settings.newsletter_subscription" id="newsletter_subscription" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="newsletter_subscription" class="ml-2 block text-sm text-gray-900">
                        Send newsletter subscription confirmation
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="settings.contact_message" id="contact_message" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="contact_message" class="ml-2 block text-sm text-gray-900">
                        Notify admin on new contact messages
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="settings.program_updates" id="program_updates" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="program_updates" class="ml-2 block text-sm text-gray-900">
                        Send program update notifications to subscribers
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Save Settings
            </button>
        </div>

        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>