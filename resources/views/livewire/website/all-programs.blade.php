<div>
    <div class="container">
        <div class="category-filter mb-5 d-flex gap-3 flex-wrap">

            {{-- All --}}
            <button wire:click="$set('filter','all')" class="category-pill {{ $filter === 'all' ? 'active' : '' }}">

                <span>All</span>
                <span class="count">{{ $totalCount }}</span>
            </button>

            {{-- Categories --}}
            @foreach ($categories as $category)
            <button wire:click="$set('filter','{{ $category->slug }}')"
                class="category-pill {{ $filter === $category->slug ? 'active' : '' }}">

                <span>{{ $category->name }}</span>
                <span class="count">{{ $category->programs_count }}</span>
            </button>
            @endforeach

        </div>

        {{-- Programs --}}
        <div class="row mt-5 supporting-boxes">
            @forelse ($programs as $program)
            <div class="col-lg-4 col-md-6">
                <div class="supporting-section-box">
                    <img src="{{ $program->thumbnail ? asset('/storage/'.$program->thumbnail) : asset('/src/images/our-program.webp') }}"
                        alt="{{ $program->title }}" class="supporting-box-img">
                    <div class="category-tag h6 mt-3 text-danger">{{ $program->getCategoriesStringAttribute() }}</div>
                    <h3 class="h3-title mt-3 mb-3">{{ $program->title }}</h3>
                    <p class="global-text mb-2"
                        style="height: 42px; overflow: hidden; font-size: 14px; line-height: 1.4;">
                        {{ $program->short_description }}
                    </p>
                    <div class="d-flex justify-content-between align-items-center supporting-box-info">
                        <div>
                            <h6 class="mb-0">Goals</h6>
                            <span>${{ number_format($program->goal_amount, 0) }}</span>
                        </div>
                        <div></div>
                        <div>
                            <h6 class="mb-0">Raises</h6>
                            <span>${{ number_format($program->current_amount, 0) }}</span>
                        </div>
                        <div></div>
                        <div>
                            <h6 class="mb-0">To Go</h6>
                            <span>${{ number_format($program->goal_amount - $program->current_amount, 0) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('website.program-details', $program->slug) }}"
                        class="btn btn-dark d-flex justify-content-center align-items-center mt-3">Donate Now <img
                            src="/src/icons/btn-arrow.svg" alt=""></a>
                </div>
            </div>

            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No programs found.</p>
            </div>
            @endforelse
        </div>

        {{-- Show More --}}
        @if ($programs->hasMorePages())
        <div class="d-flex justify-content-center align-items-center mt-5">
            <button wire:click="loadMore" wire:loading.attr="disabled"
                class="btn d-flex justify-content-center align-items-center gap-2 show-more-btn">

                <span wire:loading.remove>Show More</span>
                <span wire:loading>Loading...</span>

                <img src="/src/icons/show-more-arrow.svg" alt="">
            </button>
        </div>
        @endif

    </div>
</div>
@push('styles')
<style>
    .category-filter {
    justify-content: center;
}

.category-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 18px;
    border-radius: 50px;
    background: #f4f8f4;
    border: 1px solid transparent;
    font-size: 14px;
    font-weight: 600;
    color: #333;
    cursor: pointer;
    transition: all 0.25s ease;
}

.category-pill .count {
    background: #e0e0e0;
    color: #555;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}

.category-pill:hover {
    background: #eeffee;
    border-color: #bdf8b5;
    transform: translateY(-1px);
}

.category-pill.active {
    background: #00a824;
    color: #fff;
}

.category-pill.active .count {
    background: rgba(255, 255, 255, 0.25);
    color: #fff;
}
@media (max-width: 576px) {
    .category-pill {
        padding: 8px 14px;
        font-size: 12px;
    }

    .category-pill .count {
        padding: 1px 8px;
        font-size: 10px;
    }
}
</style>
    
@endpush