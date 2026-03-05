<div>
    @if ($slides->isNotEmpty())
        <div class="sliderContainer">
            <div class="banner-slider single-item">
                @foreach ($slides as $index => $slide)
                    <div class="item slide-no-{{ $index + 1 }}"
                        style="background-image: url('{{ asset('storage/' . $slide->media_path) }}');">
                        <div class="home-slider-description">
                            @if ($slide->subtitle)
                                <div class="slider-maintitle">{{ strtoupper($slide->subtitle) }}</div>
                            @endif
                            <div class="slider-title">{!! $slide->title !!}</div>
                            @if ($slide->description)
                                <div class="silder-subtitle">{{ $slide->description }}</div>
                            @endif
                            @if ($slide->button_text && $slide->button_url)
                                <a href="{{ $slide->button_url }}" class="silder-btn">{{ $slide->button_text }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="progressBarContainer">
                @foreach ($slides as $index => $slide)
                    <div class="item baritem">
                        <span data-slick-index="{{ $index }}" class="progressBar">
                            <span class="progressText">
                                {{ strtoupper($slide->subtitle ?: substr(strip_tags($slide->title), 0, 20)) }}
                            </span>
                            <span class="inProgress inProgress{{ $index }}"></span>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
