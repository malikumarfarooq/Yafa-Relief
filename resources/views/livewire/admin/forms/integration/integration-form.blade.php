<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-light">
                <h6 class="mb-0 fw-bold">Integrations</h6>
            </div>
            <div class="list-group list-group-flush">
                @foreach(array_keys($config) as $p)
                <button type="button" wire:click="loadTab('{{ $p }}')"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $activeTab === $p ? 'bg-dark text-white' : '' }}">
                    <span>
                        <i class="bi bi-gear-fill me-2"></i> {{ ucfirst($p) }}
                    </span>
                    @if(App\Models\Integration::where('provider', $p)->where('is_active', true)->exists())
                    <span class="badge rounded-pill bg-success">Active</span>
                    @endif
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-9 mb-3">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 text-danger fw-bold">
                    {{ ucfirst($activeTab) }} Configuration
                </h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" wire:model="is_active" id="activeSwitch">
                    <label class="form-check-label" for="activeSwitch">Enable Integration</label>
                </div>
            </div>

            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Internal Name</label>
                        <input type="text" wire:model="name" class="form-control"
                            placeholder="e.g. My {{ ucfirst($activeTab) }} Account">
                    </div>

                    <hr class="my-4">

                    <div class="row g-3">
                        @foreach($config[$activeTab]['fields'] as $field)
                        <div class="col-md-6">
                            <label class="form-label text-capitalize">{{ str_replace('_', ' ', $field) }}</label>
                            <input
                                type="{{ in_array($field, ['secret_key', 'password', 'access_token', 'key', 'secret']) ? 'password' : 'text' }}"
                                wire:model="settings.{{ $field }}" class="form-control">
                            @error("settings.$field") <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        @endforeach
                    </div>

                    @if($type === 'tracking')
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Custom Scripts</h6>
                        <div class="mb-3">
                            <label class="form-label">Head Script (Inside &lt;head&gt;)</label>
                            <textarea wire:model="head_script" class="form-control font-monospace" rows="4"
                                placeholder="<script>...</script>"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Body Script (After &lt;body&gt;)</label>
                            <textarea wire:model="body_script" class="form-control font-monospace" rows="4"
                                placeholder="<script>...</script>"></textarea>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-dark px-4">
                            <span wire:loading class="spinner-border spinner-border-sm me-1" role="status"></span>
                            Save {{ ucfirst($activeTab) }} Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>