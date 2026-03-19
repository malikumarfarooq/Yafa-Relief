@php
    $sitekey = config('services.turnstile.sitekey');
    // Livewire property name to set (default: captchaToken)
    $wireId = $wireId ?? 'captchaToken';
    // Unique DOM id per widget instance to avoid collisions when multiple forms exist
    $widgetId = $widgetId ?? $wireId;
@endphp

@if($sitekey)
    <div
        id="turnstile-widget-{{ $widgetId }}"
        class="cf-turnstile my-3"
        data-sitekey="{{ $sitekey }}"
        data-theme="light"
    ></div>

    <script>
        (function() {
            function renderTurnstile() {
                if (typeof turnstile === 'undefined') {
                    setTimeout(renderTurnstile, 300);
                    return;
                }

                const el = document.getElementById('turnstile-widget-{{ $widgetId }}');
                if (!el) return;

                // Clear previous render
                el.innerHTML = '';

                turnstile.render(el, {
                    sitekey: '{{ $sitekey }}',
                    callback: function(token) {
                        // Livewire 3
                        const component = el.closest('[wire\\:id]');
                        if (component) {
                            const wireId = component.getAttribute('wire:id');
                            Livewire.find(wireId).set('{{ $wireId }}', token);
                        }
                    },
                    'expired-callback': function() {
                        const component = el.closest('[wire\\:id]');
                        if (component) {
                            const wireId = component.getAttribute('wire:id');
                            Livewire.find(wireId).set('{{ $wireId }}', null);
                        }
                    },
                    'error-callback': function() {
                        const component = el.closest('[wire\\:id]');
                        if (component) {
                            const wireId = component.getAttribute('wire:id');
                            Livewire.find(wireId).set('{{ $wireId }}', null);
                        }
                    }
                });
            }

            // Run on page load
            document.addEventListener('DOMContentLoaded', renderTurnstile);

            // Re-run after every Livewire update
            document.addEventListener('livewire:navigated', renderTurnstile);
            document.addEventListener('livewire:update', renderTurnstile);
        })();
    </script>
@endif