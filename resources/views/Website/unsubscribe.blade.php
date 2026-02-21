<x-website.layout
    metaTitle="Unsubscribed from Newsletter"
    metaDescription="You have been successfully removed from the Yafa Relief newsletter mailing list."
    metaKeywords="unsubscribe, newsletter, yafa relief, email preferences">

    <div class="container py-5 my-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card border-0 shadow-sm p-5">
                    <div class="mb-4">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>

                    <h2 class="mb-4 fw-bold">You've Been Unsubscribed</h2>
                    
                    <p class="lead text-muted mb-4">
                        {{ $message ?? 'You will no longer receive newsletter emails from us.' }}
                    </p>

                    <p class="text-muted mb-5">
                        We're sorry to see you go. You can always subscribe again in the future if you change your mind.
                    </p>

                    <a href="{{ route('website.home') }}" 
                       class="btn btn-primary btn-lg px-5 py-3 d-inline-flex align-items-center gap-2">
                        Back to Homepage
                        <img src="/src/icons/btn-arrow.svg" alt="→" style="height:20px;">
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-website.layout>



<!-- // if simple use the below one . -->
<!-- 

<x-website.layout
    metaTitle="Unsubscribed – Yafa Relief"
    metaDescription="Successfully unsubscribed from newsletter">

    <div class="container py-5 my-5 text-center">
        <h1 class="mb-4">Unsubscribed</h1>
        <p class="lead mb-5">{{ $message }}</p>
        <a href="{{ route('website.home') }}" class="btn btn-primary btn-lg">
            Back to Homepage
        </a>
    </div>

</x-website.layout> -->