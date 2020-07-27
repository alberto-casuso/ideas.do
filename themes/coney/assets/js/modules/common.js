(function ($) {
    "use strict";

    var common = {};
    qodef.modules.common = common;

    common.qodefFluidVideo = qodefFluidVideo;
    common.qodefEnableScroll = qodefEnableScroll;
    common.qodefDisableScroll = qodefDisableScroll;
    common.qodefOwlSlider = qodefOwlSlider;
    common.qodefPrettyPhoto = qodefPrettyPhoto;
    common.getLoadMoreData = getLoadMoreData;
    common.setLoadMoreAjaxData = setLoadMoreAjaxData;
    common.qodefInitProgressLoader = qodefInitProgressLoader;

    common.qodefOnDocumentReady = qodefOnDocumentReady;
    common.qodefOnWindowLoad = qodefOnWindowLoad;
    common.qodefOnWindowResize = qodefOnWindowResize;
    common.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefFluidVideo();
        qodefPreloadBackgrounds();
        qodefPrettyPhoto();
        qodefInitAnchor().init();
        qodefOwlSlider();
        qodefInitSelfHostedVideoPlayer();
        qodefSelfHostedVideoSize();
        qodefInitBackToTop();
        qodefBackButtonShowHide();
        qodefIEversion();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefSmoothTransition();
        qodefInitProgressLoader();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }

    function qodefFluidVideo() {
        fluidvids.init({
            selector: ['iframe'],
            players: ['www.youtube.com', 'player.vimeo.com']
        });
    }

    /**
     * Init Owl Carousel
     */
    function qodefOwlSlider() {

        var sliders = $('.qodef-owl-slider');

        if (sliders.length) {
            sliders.each(function () {
                var slider = $(this);

                slider.owlCarousel({
                    autoplay: true,
                    autoplayTimeout: 5000,
                    smartSpeed: 600,
                    items: 1,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    loop: true,
                    dots: false,
                    nav: true,
                    navText: [
                        '<span class="qodef-prev-icon"><span class="qodef-icon-arrow arrow_carrot-left"></span></span>',
                        '<span class="qodef-next-icon"><span class="qodef-icon-arrow arrow_carrot-right"></span></span>'
                    ]
                });

                slider.css('visibility', 'visible');
            });
        }
    }

    /*
     *	Preload background images for elements that have 'qodef-preload-background' class
     */
    function qodefPreloadBackgrounds() {

        $(".qodef-preload-background").each(function () {
            var preloadBackground = $(this);
            if (preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") !== "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function () {
                        preloadBackground.removeClass('qodef-preload-background');
                    });
                }
            } else {
                $(window).load(function () {
                    preloadBackground.removeClass('qodef-preload-background');
                }); //make sure that qodef-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function qodefPrettyPhoto() {
        /*jshint multistr: true */
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole,
            changepicturecallback: function () {
                // 1024px is presumed here to be the widest mobile device. Adjust at will.
                if (qodef.windowWidth < 768) {
                    $(".pp_pic_holder.pp_default").css("top", window.pageYOffset + "px");
                }
            }
        });
    }

    /*
     **	Anchor functionality
     */
    var qodefInitAnchor = qodef.modules.common.qodefInitAnchor = function () {
        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function (anchor) {

            $('.qodef-main-menu .qodef-active-item, .qodef-mobile-nav .qodef-active-item, .qodef-fullscreen-menu .qodef-active-item').removeClass('qodef-active-item');
            anchor.parent().addClass('qodef-active-item');

            $('.qodef-main-menu a, .qodef-mobile-nav a, .qodef-fullscreen-menu a').removeClass('current');
            anchor.addClass('current');
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function () {

            $('[data-qodef-anchor]').waypoint(function (direction) {
                if (direction === 'down') {
                    setActiveState($("a[href='" + window.location.href.split('#')[0] + "#" + $(this.element).data("qodef-anchor") + "']"));
                }
            }, {offset: '50%'});

            $('[data-qodef-anchor]').waypoint(function (direction) {
                if (direction === 'up') {
                    setActiveState($("a[href='" + window.location.href.split('#')[0] + "#" + $(this.element).data("qodef-anchor") + "']"));
                }
            }, {
                offset: function () {
                    return -($(this.element).outerHeight() - 150);
                }
            });

        };

        /**
         * Check anchor active state on load
         */
        var checkActiveStateOnLoad = function () {
            var hash = window.location.hash.split('#')[1];

            if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0) {
                anchorClickOnLoad(hash);
            }
        };

        /**
         * Handle anchor on load
         */
        var anchorClickOnLoad = function ($this) {
            var scrollAmount;
            var anchor = $('a');
            var hash = $this;
            if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0) {
                var anchoredElementOffset = $('[data-qodef-anchor="' + hash + '"]').offset().top;
                scrollAmount = $('[data-qodef-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - qodefGlobalVars.vars.qodefAddForAdminBar;

                setActiveState(anchor);

                qodef.html.stop().animate({
                    scrollTop: Math.round(scrollAmount)
                }, 1000, function () {
                    //change hash tag in url
                    if (history.pushState) {
                        history.pushState(null, null, '#' + hash);
                    }
                });
                return false;
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function (anchoredElementOffset) {

            if (qodef.modules.header.behaviour === 'qodef-sticky-header-on-scroll-down-up') {
                qodef.modules.header.isStickyVisible = (anchoredElementOffset > qodef.modules.header.stickyAppearAmount);
            }

            if (qodef.modules.header.behaviour === 'qodef-sticky-header-on-scroll-up') {
                if ((anchoredElementOffset > qodef.scroll)) {
                    qodef.modules.header.isStickyVisible = false;
                }
            }

            var headerHeight = qodef.modules.header.isStickyVisible ? qodefGlobalVars.vars.qodefStickyHeaderTransparencyHeight : qodefPerPageVars.vars.qodefHeaderTransparencyHeight;

            if (qodef.windowWidth < 1025) {
                headerHeight = 0;
            }

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function () {
            qodef.document.on("click", ".qodef-main-menu a, .qodef-fullscreen-menu a, .qodef-btn, .qodef-anchor, .qodef-mobile-nav a", function () {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0) {

                    var anchoredElementOffset = $('[data-qodef-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-qodef-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset) - qodefGlobalVars.vars.qodefAddForAdminBar;

                    setActiveState(anchor);

                    qodef.html.stop().animate({
                        scrollTop: Math.round(scrollAmount)
                    }, 1000, function () {
                        //change hash tag in url
                        if (history.pushState) {
                            history.pushState(null, null, '#' + hash);
                        }
                    });
                    return false;
                }
            });
        };

        return {
            init: function () {
                if ($('[data-qodef-anchor]').length) {
                    anchorClick();
                    checkActiveStateOnScroll();
                    $(window).load(function () {
                        checkActiveStateOnLoad();
                    });
                }
            }
        };
    };

    function qodefDisableScroll() {
        if (window.addEventListener) {
            window.addEventListener('DOMMouseScroll', qodefWheel, false);
        }

        window.onmousewheel = document.onmousewheel = qodefWheel;
        document.onkeydown = qodefKeydown;
    }

    function qodefEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('DOMMouseScroll', qodefWheel, false);
        }

        window.onmousewheel = document.onmousewheel = document.onkeydown = null;
    }

    function qodefWheel(e) {
        qodefPreventDefaultValue(e);
    }

    function qodefKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                qodefPreventDefaultValue(e);
                return;
            }
        }
    }

    function qodefPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function qodefInitSelfHostedVideoPlayer() {

        var players = $('.qodef-self-hosted-video');
        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    function qodefSelfHostedVideoSize() {

        $('.qodef-self-hosted-video-holder .qodef-video-wrap').each(function () {
            var thisVideo = $(this);

            var videoWidth = thisVideo.closest('.qodef-self-hosted-video-holder').outerWidth();
            var videoHeight = videoWidth / qodef.videoRatio;

            if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
                thisVideo.parent().width(videoWidth);
                thisVideo.parent().height(videoHeight);
            }

            thisVideo.width(videoWidth);
            thisVideo.height(videoHeight);

            thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
            thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
        });
    }

    function qodefToTopButton(a) {

        var b = $("#qodef-back-to-top");
        b.removeClass('off on');
        if (a === 'on') {
            b.addClass('on');
        } else {
            b.addClass('off');
        }
    }

    function qodefBackButtonShowHide() {
        qodef.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) {
                d = b + c / 2;
            } else {
                d = 1;
            }
            if (d < 1e3) {
                qodefToTopButton('off');
            } else {
                qodefToTopButton('on');
            }
        });
    }

    function qodefInitBackToTop() {
        var backToTopButton = $('#qodef-back-to-top');
        backToTopButton.on('click', function (e) {
            e.preventDefault();
            qodef.html.animate({scrollTop: 0}, qodef.window.scrollTop() / 3, 'linear');
        });
    }

    function qodefSmoothTransition() {

        if (qodef.body.hasClass('qodef-smooth-page-transitions')) {

            //check for preload animation
            if (qodef.body.hasClass('qodef-smooth-page-transitions-preloader')) {
                var loader = $('body > .qodef-smooth-transition-loader.qodef-mimic-ajax');
                var pause = loader.find('.progress-loader-holder-line') ? true : false;
                if (pause) {
                    setTimeout(function () {
                        loader.find('.progress-loader-holder-number').text('100');
                        loader.fadeOut(500);
                        $(window).on("pageshow", function (event) {
                            if (event.originalEvent.persisted) {
                                loader.fadeOut(500);
                            }
                        });
                    }, 1200);
                } else {
                    $(window).on("pageshow", function (event) {
                        loader.fadeOut(500);
                        if (event.originalEvent.persisted) {
                            loader.fadeOut(500);
                        }
                    });
                }
            }

            //check for fade out animation
            if (qodef.body.hasClass('qodef-smooth-page-transitions-fadeout')) {
                var linkItem = $('a');

                linkItem.on('click', function (e) {
                    var a = $(this);

                    if ((a.parents('.qodef-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
                        return false;
                    }

                    if (
                        e.which === 1 && // check if the left mouse button has been pressed
                        a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
                        (typeof a.data('rel') === 'undefined') && //Not pretty photo link
                        (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                        (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                        (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                    ) {
                        e.preventDefault();
                        $('.qodef-wrapper-inner').fadeOut(1000, function () {
                            window.location = a.attr('href');
                        });
                    }
                });
            }
        }
    }

    /*
     **	Progress Loader Preloader Type
     */
    function qodefInitProgressLoader() {

        var progressBar = $('.progress-loader-holder');

        if (progressBar.length) {

            progressBar.each(function () {

                var thisBar = $(this),
                    thisBarContent = thisBar.find('.progress-loader-holder-line'),
                    percentage = thisBarContent.data('percentage'),
                    progressNumber = thisBar.find('.progress-loader-holder-text');

                thisBar.appear(function () {
                    qodefInitToCounterProgressLoader(thisBar, percentage);

                    thisBarContent.css('width', '0%');
                    thisBarContent.animate({'width': 100 + '%'}, 900);
                });
            });
        }
    }

    /*
     **	Preloader Counter for horizontal progress bars percent from zero to defined percent
     */
    function qodefInitToCounterProgressLoader(progressBar, $percentage) {
        var percentage = parseFloat($percentage),
            percent = progressBar.find('.progress-loader-holder-number');

        if (percent.length) {
            percent.each(function () {
                var thisPercent = $(this);
                thisPercent.countTo({
                    from: 0,
                    to: 99,
                    speed: 900,
                    refreshInterval: 50
                });
            });
        }
    }

    /*
    * IE version
    */
    function qodefIEversion() {
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0) {
            var version = parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
            qodef.body.addClass('qodef-ms-ie' + version);
        }
        return false;
    }

    /**
     * Initializes load more data params
     * @param container with defined data params
     * return array
     */
    function getLoadMoreData(container) {
        var dataList = container.data(),
            returnValue = {};

        for (var property in dataList) {
            if (dataList.hasOwnProperty(property)) {
                if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
                    returnValue[property] = dataList[property];
                }
            }
        }

        return returnValue;
    }

    /**
     * Sets load more data params for ajax function
     * @param container with defined data params
     * return array
     */
    function setLoadMoreAjaxData(container, action) {
        var returnValue = {
            action: action
        };

        for (var property in container) {
            if (container.hasOwnProperty(property)) {

                if (typeof container[property] !== 'undefined' && container[property] !== false) {
                    returnValue[property] = container[property];
                }
            }
        }

        return returnValue;
    }

})(jQuery);