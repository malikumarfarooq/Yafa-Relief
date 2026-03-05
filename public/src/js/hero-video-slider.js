$(document).ready(function () {
    const slideCount = $(".banner-slider .item").length;
    const indexCount = slideCount - 1;

    $(".banner-slider").slick({
        infinite: true,
        arrows: false,
        dots: false,
        autoplay: false,
        speed: 800,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    function updateProgressBar(index) {
        $('.progressBarContainer div').removeClass('active');
        $('.progressBarContainer div:eq(' + index + ')').addClass('active');
    }

    $(".banner-slider").on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        updateProgressBar(nextSlide);
    });
    updateProgressBar(0);
    var percentTime;
    var tick;
    var time = .1;
    var progressBarIndex = 0;

    function startProgressbar() {
        resetProgressbar();
        percentTime = 0;
        tick = setInterval(interval, 10);
    }

    function interval() {
        if ($('.banner-slider .slick-track div[data-slick-index="' + progressBarIndex + '"]').attr("aria-hidden") === "true") {
            progressBarIndex = $('.banner-slider .slick-track div[aria-hidden="false"]').data("slickIndex");
            startProgressbar();
        } else {
            percentTime += 1 / (time + 5);
            $('.inProgress.inProgress' + progressBarIndex).css({
                width: percentTime + "%"
            });
            if (percentTime >= 100) {
                $('.single-item').slick('slickNext');
                progressBarIndex++;
                if (progressBarIndex > indexCount) {
                    progressBarIndex = 0;
                }
                startProgressbar();
            }
        }
    }

    function resetProgressbar() {
        $('.inProgress').css({
            width: 0 + '%'
        });
        clearInterval(tick);
    }

    startProgressbar();

    $('.baritem').click(function () {
        clearInterval(tick);
        var goToThisIndex = $(this).find("span").data("slickIndex");
        $('.single-item').slick('slickGoTo', goToThisIndex, false);
        startProgressbar();
    });
});