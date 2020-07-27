(function($) {
    "use strict";

    window.qodef = {};
    qodef.modules = {};

    qodef.scroll = 0;
    qodef.window = $(window);
    qodef.document = $(document);
    qodef.windowWidth = $(window).width();
    qodef.windowHeight = $(window).height();
    qodef.body = $('body');
    qodef.html = $('html, body');
    qodef.htmlEl = $('html');
    qodef.menuDropdownHeightSet = false;
    qodef.defaultHeaderStyle = '';
    qodef.minVideoWidth = 1500;
    qodef.videoWidthOriginal = 1280;
    qodef.videoHeightOriginal = 720;
    qodef.videoRatio = 1.61;

    qodef.qodefOnDocumentReady = qodefOnDocumentReady;
    qodef.qodefOnWindowLoad = qodefOnWindowLoad;
    qodef.qodefOnWindowResize = qodefOnWindowResize;
    qodef.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodef.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(qodef.body.hasClass('qodef-dark-header')){ qodef.defaultHeaderStyle = 'qodef-dark-header';}
        if(qodef.body.hasClass('qodef-light-header')){ qodef.defaultHeaderStyle = 'qodef-light-header';}
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodef.windowWidth = $(window).width();
        qodef.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
        qodef.scroll = $(window).scrollTop();
    }

    //set boxed layout width variable for various calculations

    switch(true){
        case qodef.body.hasClass('qodef-grid-1300'):
            qodef.boxedLayoutWidth = 1350;
            break;
        case qodef.body.hasClass('qodef-grid-1200'):
            qodef.boxedLayoutWidth = 1250;
            break;
        case qodef.body.hasClass('qodef-grid-1000'):
            qodef.boxedLayoutWidth = 1050;
            break;
        case qodef.body.hasClass('qodef-grid-800'):
            qodef.boxedLayoutWidth = 850;
            break;
        default :
            qodef.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
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
(function($) {
    "use strict";

    var header = {};
    qodef.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour = '';

    header.qodefOnDocumentReady = qodefOnDocumentReady;
    header.qodefOnWindowLoad = qodefOnWindowLoad;
    header.qodefOnWindowResize = qodefOnWindowResize;
    header.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefHeaderBehaviour();
        qodefSideArea();
        qodefSideAreaScroll();
        qodefFullscreenMenu();
        qodefInitMobileNavigation();
        qodefMobileHeaderBehavior();
        qodefSetDropDownMenuPosition();
        qodefDropDownMenu();    
        qodefSearch();
        qodefVerticalMenu().init();
        qodefPopup();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefSetDropDownMenuPosition();
        qodefInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitDividedHeaderMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
        
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function qodefHeaderBehaviour() {

        var header = $('.qodef-page-header'),
	        stickyHeader = $('.qodef-sticky-header'),
            fixedHeaderWrapper = $('.qodef-fixed-wrapper');
        
        var revSliderHeight =  0;
        if ($('.qodef-slider').length) {
            revSliderHeight = $('.qodef-slider').outerHeight();
        }

        var headerMenuAreaOffset = $('.qodef-page-header').find('.qodef-fixed-wrapper').length ? $('.qodef-page-header').find('.qodef-fixed-wrapper').offset().top - qodefGlobalVars.vars.qodefAddForAdminBar : 0;
		
        var stickyAppearAmount;
        var headerAppear;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-up'):
                qodef.modules.header.behaviour = 'qodef-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = qodefGlobalVars.vars.qodefTopBarHeight + qodefGlobalVars.vars.qodefLogoAreaHeight + qodefGlobalVars.vars.qodefMenuAreaHeight + qodefGlobalVars.vars.qodefStickyHeaderHeight;

                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();

                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        qodef.modules.header.isStickyVisible= false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .second').removeClass('qodef-drop-down-start');
                    }else {
                        qodef.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-down-up'):
                qodef.modules.header.behaviour = 'qodef-sticky-header-on-scroll-down-up';
                
                if(qodefPerPageVars.vars.qodefStickyScrollAmount !== 0){
                    qodef.modules.header.stickyAppearAmount = qodefPerPageVars.vars.qodefStickyScrollAmount;
                } else {
                    var menuHeight = qodefGlobalVars.vars.qodefMenuAreaHeight;
                    
                    qodef.modules.header.stickyAppearAmount = qodefGlobalVars.vars.qodefStickyScrollAmount !== 0 ? qodefGlobalVars.vars.qodefStickyScrollAmount : qodefGlobalVars.vars.qodefTopBarHeight + qodefGlobalVars.vars.qodefLogoAreaHeight + menuHeight + revSliderHeight;
                }

                headerAppear = function(){
                    if(qodef.scroll < qodef.modules.header.stickyAppearAmount) {
                        qodef.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .second').removeClass('qodef-drop-down-start');
                    }else{
                        qodef.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case qodef.body.hasClass('qodef-fixed-on-scroll'):
                qodef.modules.header.behaviour = 'qodef-fixed-on-scroll';
                var headerFixed = function(){

                    if(qodef.scroll <= headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom', '0');
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom', fixedHeaderWrapper.outerHeight());
                    }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function qodefSideArea() {

        var wrapper = $('.qodef-wrapper'),
            sideMenuButtonOpen = $('a.qodef-side-menu-button-opener'),
            cssClass = 'qodef-right-side-menu-opened';

        wrapper.prepend('<div class="qodef-cover"/>');

        $('a.qodef-side-menu-button-opener, a.qodef-close-side-menu').on('click', function(e) {
            e.preventDefault();

            if(!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                qodef.body.addClass(cssClass);

                $('.qodef-wrapper .qodef-cover').on('click',function() {
                    qodef.body.removeClass('qodef-right-side-menu-opened');
                    sideMenuButtonOpen.removeClass('opened');
                });

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function() {
                    if(Math.abs(qodef.scroll - currentScroll) > 400){
                        qodef.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                    }
                });
            } else {
                sideMenuButtonOpen.removeClass('opened');
                qodef.body.removeClass(cssClass);
            }
        });
    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function qodefSideAreaScroll(){

        var sideMenu = $('.qodef-side-menu');

        if(sideMenu.length){    
            sideMenu.niceScroll({ 
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0, 
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false, 
                horizrailenabled: false 
            });
        }
    }

    /**
     * Init Divided Header Menu
     */
    function qodefInitDividedHeaderMenu(){
        if(qodef.body.hasClass('qodef-header-divided')){
            //get left side menu width
            var menuArea = $('.qodef-menu-area'),
                menuAreaWidth = menuArea.width(),
	            menuAreaItem = $('.qodef-main-menu > ul > li > a'),
	            menuItemPadding = 0,
	            logoArea = menuArea.find('.qodef-logo-wrapper .qodef-normal-logo'),
	            logoAreaWidth = 0;

            if(menuArea.children('.qodef-grid').length) {
                menuAreaWidth = menuArea.children('.qodef-grid').outerWidth();
            }

	        if(menuAreaItem.length) {
		        menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
	        }

	        if(logoArea.length) {
		        logoAreaWidth = logoArea.width() / 2;
	        }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth/2 - menuItemPadding - logoAreaWidth);

            $('.qodef-menu-area .qodef-position-left').width(menuAreaLeftRightSideWidth);
			$('.qodef-menu-area .qodef-position-right').width(menuAreaLeftRightSideWidth);

            menuArea.css('opacity',1);

            qodefDropDownMenu();
            qodefSetDropDownMenuPosition();
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function qodefFullscreenMenu() {

        if ($('a.qodef-fullscreen-menu-opener').length) {

            var popupMenuOpener = $( 'a.qodef-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".qodef-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.qodef-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.qodef-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.qodef-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.qodef-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.qodef-fullscreen-menu ul li:not(.has_sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(qodef.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(qodef.windowHeight);
            });

            if (qodef.body.hasClass('qodef-fade-push-text-right')) {
                cssClass = 'qodef-push-nav-right';
                fadeRight = true;
            } else if (qodef.body.hasClass('qodef-fade-push-text-top')) {
                cssClass = 'qodef-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('qodef-fm-opened')) {
                    popupMenuOpener.addClass('qodef-fm-opened');
                    qodef.body.addClass('qodef-fullscreen-menu-opened');
                    qodef.body.removeClass('qodef-fullscreen-fade-out').addClass('qodef-fullscreen-fade-in');
                    qodef.body.removeClass(cssClass);
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefDisableScroll();
                    }
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) {
                            popupMenuOpener.removeClass('qodef-fm-opened');
                            qodef.body.removeClass('qodef-fullscreen-menu-opened');
                            qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                            qodef.body.addClass(cssClass);
                            if(!qodef.body.hasClass('page-template-full_screen-php')){
                                qodef.modules.common.qodefEnableScroll();
                            }
                            $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('qodef-fm-opened');
                    qodef.body.removeClass('qodef-fullscreen-menu-opened');
                    qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                    qodef.body.addClass(cssClass);
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }
                    $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent();

                if (thisItemParent.hasClass('has_sub')) {
                    var submenu = thisItemParent.find('> ul.sub_menu');

                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
	                    thisItemParent.removeClass('open_sub');
                    } else {
	                    thisItemParent.addClass('open_sub');
                        submenu.slideDown(200, function() {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click',function (e) {

                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){

                    if (e.which === 1) {
                        popupMenuOpener.removeClass('qodef-fm-opened');
                        qodef.body.removeClass('qodef-fullscreen-menu-opened');
                        qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                        qodef.body.addClass(cssClass);
                        $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function(){
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        qodef.modules.common.qodefEnableScroll();
                    }
                }else{
                    return false;
                }
            });
        }
    }

    function qodefInitMobileNavigation() {
        var navigationOpener = $('.qodef-mobile-header .qodef-mobile-menu-opener');
        var navigationHolder = $('.qodef-mobile-header .qodef-mobile-nav');
        var dropdownOpener = $('.qodef-mobile-nav .mobile_arrow, .qodef-mobile-nav h6, .qodef-mobile-nav a.qodef-mobile-no-link');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if(navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function(e) {
                e.stopPropagation();
                e.preventDefault();

                if(navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                    navigationOpener.removeClass("qodef-mobile-menu-opened");
                } else {
                    navigationHolder.slideDown(animationSpeed);
                    navigationOpener.addClass("qodef-mobile-menu-opened");
                }
            });
        }

        //dropdown opening / closing
        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                $(this).on('tap click', function(e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('qodef-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('qodef-opened');
                        }
                    }

                });
            });
        }

        $('.qodef-mobile-nav a, .qodef-mobile-logo-wrapper a').on('click tap', function(e) {
            if($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
                navigationOpener.removeClass("qodef-mobile-menu-opened");
            }
        });
    }

    function qodefMobileHeaderBehavior() {
        if(qodef.body.hasClass('qodef-sticky-up-mobile-header')) {
            var stickyAppearAmount,
                mobileHeader = $('.qodef-mobile-header'),
                mobileMenuOpener = mobileHeader.find('.qodef-mobile-menu-opener'),
                mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
                adminBar     = $('#wpadminbar');

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = mobileHeaderHeight + qodefGlobalVars.vars.qodefAddForAdminBar;

            $(window).scroll(function() {
                var docYScroll2 = $(document).scrollTop();

                if(docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('qodef-animate-mobile-header');
                } else {
                    mobileHeader.removeClass('qodef-animate-mobile-header');
                }

                if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('qodef-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', 0);

                    if(adminBar.length) {
                        mobileHeader.find('.qodef-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');
                    mobileHeader.css('margin-bottom', stickyAppearAmount);
                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function qodefSetDropDownMenuPosition(){

        var menuItems = $(".qodef-drop-down > ul > li.narrow");
        menuItems.each( function(i) {

            var browserWidth = qodef.windowWidth-16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.second .inner ul').width();

            var menuItemFromLeft = 0;
            if(qodef.body.hasClass('qodef-boxed')){
                menuItemFromLeft = qodef.boxedLayoutWidth  - (menuItemPosition - (browserWidth - qodef.boxedLayoutWidth )/2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if($(this).find('li.sub').length > 0){
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
                $(this).find('.second').addClass('right');
                $(this).find('.second .inner ul').addClass('right');
            }
        });
    }

    function qodefDropDownMenu() {

        var menu_items = $('.qodef-drop-down > ul > li');

        menu_items.each(function(i) {
            if($(menu_items[i]).find('.second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.second');

                if($(menu_items[i]).hasClass('wide')) {
                    
                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.second > .inner > ul > li').each(function() {
                        var thisHeight = $(this).height();
                        if(thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });

                    $(this).find('.second > .inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.second > .inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    var left_position;

                    if(!$(this).hasClass('left_position') && !$(this).hasClass('right_position')) {
                        left_position = dropDownSecondDiv.offset().left;

                        dropDownSecondDiv.css('left', -left_position);
                        dropDownSecondDiv.css('width', qodef.windowWidth);
                    }
                }

                if(!qodef.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function() {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function() {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if(qodef.body.hasClass('qodef-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function() {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 300, function() {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function() {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 150, function() {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function() {
                                setTimeout(function() {
                                    dropDownSecondDiv.addClass('qodef-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function() {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('qodef-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
         $('.qodef-drop-down ul li.wide ul li a').on('click', function(e) {
            if (e.which === 1){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            }
        });

        qodef.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function qodefSearch() {

        var searchOpener = $('.qodef-search-opener'),
            touch = false;

        if ( $('html').hasClass( 'touch' ) ) {
            touch = true;
        }

        if ( searchOpener.length > 0 ) {
            //Check for type of search
            if ( qodef.body.hasClass( 'qodef-fullscreen-search' ) ) {

                qodefFullscreenSearch();

            } else if ( qodef.body.hasClass( 'qodef-slide-from-header-bottom' ) ) {

                qodefSearchSlideFromHeaderBottom();

            } else if ( qodef.body.hasClass( 'qodef-search-slide-from-icon' ) ) {

                qodefSearchSlideFromIcon();

            }
        }

        /**
         * Search slide from header bottom type of search
         */
        function qodefSearchSlideFromHeaderBottom() {

            searchOpener.on('click', function(e) {
                e.preventDefault();
                var thisItem = $(this),
                    searchIconPosition = parseInt(qodef.windowWidth - thisItem.offset().left - thisItem.outerWidth());
                if(qodef.body.hasClass('qodef-boxed') && qodef.windowWidth > 1024) {
                    searchIconPosition -= parseInt((qodef.windowWidth - $('.qodef-boxed .qodef-wrapper .qodef-wrapper-inner').outerWidth()) / 2);
                }

                if(!qodef.body.hasClass('qodef-search-opened')){
                    qodef.body.addClass('qodef-search-opened');
                    if(thisItem.parents('.qodef-fixed-wrapper').length) {
                        thisItem.parents('.qodef-fixed-wrapper').find('.qodef-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeToggle(100, 'swing');
                    } else if (thisItem.parents('.qodef-sticky-header').length) {
                        thisItem.parents('.qodef-sticky-header').find('.qodef-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeToggle(100, 'swing');
                    } else if (thisItem.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').length) {
                        thisItem.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeToggle(100, 'swing');
                    } else if (thisItem.parents('.qodef-mobile-header').length) {
                        thisItem.parents('.qodef-mobile-header').find('.qodef-slide-from-header-bottom-holder').css('right', searchIconPosition).fadeToggle(100, 'swing');
                    }  
                    setTimeout(function(){
                        $('.qodef-slide-from-header-bottom-holder input').focus();
                    },400);
                } else {
                    qodef.body.removeClass('qodef-search-opened');
                    if(thisItem.parents('.qodef-fixed-wrapper').length) {
                        thisItem.parents('.qodef-fixed-wrapper').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (thisItem.parents('.qodef-sticky-header').length) {
                        thisItem.parents('.qodef-sticky-header').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (thisItem.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').length) {
                        thisItem.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (thisItem.parents('.qodef-mobile-header').length) {
                        thisItem.parents('.qodef-mobile-header').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } 
                }
            });

            qodef.body.on('click',function(e) {
                if(!$(e.target).hasClass('qodef-search-field') && !$(e.target).hasClass('qodef-search-icon') && !$(e.target).hasClass('icon_search') && qodef.body.hasClass('qodef-search-opened')) {
                    qodef.body.removeClass('qodef-search-opened');
                    if(searchOpener.parents('.qodef-fixed-wrapper').length) {
                        searchOpener.parents('.qodef-fixed-wrapper').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (searchOpener.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').length) {
                        searchOpener.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (searchOpener.parents('.qodef-sticky-header').length) {
                        searchOpener.parents('.qodef-sticky-header').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (searchOpener.parents('.qodef-mobile-header').length) {
                        searchOpener.parents('.qodef-mobile-header').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    }
                }
            });

            //Close on escape
            $(document).keyup(function(e){
                if (e.keyCode === 27 ) { //KeyCode for ESC button is 27
                    qodef.body.removeClass('qodef-search-opened');
                    if(searchOpener.parents('.qodef-fixed-wrapper').length) {
                        searchOpener.parents('.qodef-fixed-wrapper').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (searchOpener.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').length) {
                        searchOpener.parents('.qodef-page-header').children('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (searchOpener.parents('.qodef-sticky-header').length) {
                        searchOpener.parents('.qodef-sticky-header').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } else if (searchOpener.parents('.qodef-mobile-header').length) {
                        searchOpener.parents('.qodef-mobile-header').find('.qodef-slide-from-header-bottom-holder').fadeOut(0);
                    } 
                }
            });    
        
        }

        /**
         * Fullscreen search fade
         */
        function qodefFullscreenSearch() {

            var searchHolder = $( '.qodef-fullscreen-search-holder');
            var searchClose = $( '.qodef-fullscreen-search-close' );

            searchOpener.on('click', function(e) {
                e.preventDefault();
                var samePosition = false,
                    closeTop = 0,
                    closeLeft = 0;
                if ( $(this).data('icon-close-same-position') === 'yes' ) {
                    closeTop = $(this).find('.qodef-search-opener-wrapper').offset().top;
                    closeLeft = $(this).offset().left;
                    samePosition = true;
                }

                if ( searchHolder.hasClass( 'qodef-animate' ) ) {
                    qodef.body.removeClass('qodef-fullscreen-search-opened');
                    qodef.body.addClass( 'qodef-search-fade-out' );
                    qodef.body.removeClass( 'qodef-search-fade-in' );
                    searchHolder.removeClass( 'qodef-animate' );
                    setTimeout(function(){
                        searchHolder.find('.qodef-search-field').val('');
                        searchHolder.find('.qodef-search-field').blur();
                    },300);
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }
                } else {
                    qodef.body.addClass('qodef-fullscreen-search-opened');
                    setTimeout(function(){
                        searchHolder.find('.qodef-search-field').focus();
                    },900);
                    qodef.body.removeClass('qodef-search-fade-out');
                    qodef.body.addClass('qodef-search-fade-in');
                    searchHolder.addClass('qodef-animate');
                    if (samePosition) {
                        searchClose.css({
                            'top' : closeTop - qodef.scroll,
                            'left' : closeLeft
                        });
                    }
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefDisableScroll();
                    }
                }
                searchClose.on('click', function(e) {
                    e.preventDefault();
                    qodef.body.removeClass('qodef-fullscreen-search-opened');
                    searchHolder.removeClass('qodef-animate');
                    setTimeout(function(){
                        searchHolder.find('.qodef-search-field').val('');
                        searchHolder.find('.qodef-search-field').blur();
                    },300);
                    qodef.body.removeClass('qodef-search-fade-in');
                    qodef.body.addClass('qodef-search-fade-out');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }
                });

                //Close on click away
                $(document).mouseup(function (e) {
                    var container = $(".qodef-form-holder-inner");
                    if (!container.is(e.target) && container.has(e.target).length === 0)  {
                        e.preventDefault();
                        qodef.body.removeClass('qodef-fullscreen-search-opened');
                        searchHolder.removeClass('qodef-animate');
                        setTimeout(function(){
                            searchHolder.find('.qodef-search-field').val('');
                            searchHolder.find('.qodef-search-field').blur();
                        },300);
                        qodef.body.removeClass('qodef-search-fade-in');
                        qodef.body.addClass('qodef-search-fade-out');
                        if(!qodef.body.hasClass('page-template-full_screen-php')){
                            qodef.modules.common.qodefEnableScroll();
                        }
                    }
                });

                //Close on escape
                $(document).keyup(function(e){
                    if (e.keyCode === 27 ) { //KeyCode for ESC button is 27
                        qodef.body.removeClass('qodef-fullscreen-search-opened');
                        searchHolder.removeClass('qodef-animate');
                        setTimeout(function(){
                            searchHolder.find('.qodef-search-field').val('');
                            searchHolder.find('.qodef-search-field').blur();
                        },300);
                        qodef.body.removeClass('qodef-search-fade-in');
                        qodef.body.addClass('qodef-search-fade-out');
                        if(!qodef.body.hasClass('page-template-full_screen-php')){
                            qodef.modules.common.qodefEnableScroll();
                        }
                    }
                });
            });

            //Text input focus change
            $('.qodef-fullscreen-search-holder .qodef-search-field').focus(function(){
                $('.qodef-fullscreen-search-holder .qodef-field-holder .qodef-line').css("width","100%");
            });

            $('.qodef-fullscreen-search-holder .qodef-search-field').blur(function(){
                $('.qodef-fullscreen-search-holder .qodef-field-holder .qodef-line').css("width","0");
            });
        }

        function qodefSearchSlideFromIcon() {
            searchOpener.find('.qodef-search-icon').on('mouseenter', function(e) {
                e.preventDefault();

                if(!qodef.body.hasClass('qodef-search-opened')) {
                    qodef.body.addClass('qodef-search-opened');
                    setTimeout(function(){
                        $('.qodef-slide-from-icon-holder input').focus();
                    },300);
                }

            });

            $(document).keyup(function(e) {
                if (e.keyCode === 27 && qodef.body.hasClass('qodef-search-opened')) { //KeyCode for ESC button is 27
                    qodef.body.removeClass('qodef-search-opened');
                }
            });

            qodef.body.on('click',function(e) {
                if(!$(e.target).hasClass('qodef-search-field') && qodef.body.hasClass('qodef-search-opened')) {
                    qodef.body.removeClass('qodef-search-opened');
                }
            });
        }
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalMenu = function() {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.qodef-vertical-menu-area');

        /**
         * Resizes vertical area. Called whenever height of navigation area changes
         * It first check if vertical area is scrollable, and if it is resizes scrollable area
         */
        var resizeVerticalArea = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.getNiceScroll().resize();
            }
        };

        /**
         * Checks if vertical area is scrollable (if it has qodef-with-scroll class)
         *
         * @returns {bool}
         */
        var verticalAreaScrollable = function() {
            return verticalMenuObject.hasClass('.qodef-with-scroll');
        };

        /**
         * Initialzes navigation functionality. It checks navigation type data attribute and calls proper functions
         */
        var initNavigation = function() {
            var verticalNavObject = verticalMenuObject.find('.qodef-vertical-menu');

            dropdownClickToggle();

            /**
             * Initializes click toggle navigation type. Works the same for touch and no-touch devices
             */
            function dropdownClickToggle() {
                var menuItems = verticalNavObject.find('ul li.menu-item-has-children');

                menuItems.each(function() {
                    var elementToExpand = $(this).find(' > .second, > ul');
                    var menuItem = this;
                    var dropdownOpener = $(this).find('> a');
                    var slideUpSpeed = 'fast';
                    var slideDownSpeed = 'slow';

                    dropdownOpener.on('click tap', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if(elementToExpand.is(':visible')) {
                            $(menuItem).removeClass('open');
                            elementToExpand.slideUp(slideUpSpeed, function() {
                                resizeVerticalArea();
                            });
                        } else if (dropdownOpener.parent().parent().children().hasClass('open') && dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
                            $(this).parent().parent().children().removeClass('open');
                            $(this).parent().parent().children().find(' > .second').slideUp(slideUpSpeed);

                            $(menuItem).addClass('open');
                            elementToExpand.slideDown(slideDownSpeed, function() {
                                resizeVerticalArea();
                            });
                        } else {

                            if(!$(this).parents('li').hasClass('open')) {
                                menuItems.removeClass('open');
                                menuItems.find(' > .second, > ul').slideUp(slideUpSpeed);
                            }

                            if($(this).parent().parent().children().hasClass('open')) {
                                $(this).parent().parent().children().removeClass('open');
                                $(this).parent().parent().children().find(' > .second, > ul').slideUp(slideUpSpeed);
                            }

                            $(menuItem).addClass('open');
                            elementToExpand.slideDown(slideDownSpeed, function() {
                                resizeVerticalArea();
                            });
                        }
                    });
                });
            }
        };

        /**
         * Initializes scrolling in vertical area. It checks if vertical area is scrollable before doing so
         */
        var initVerticalAreaScroll = function() {
            if(verticalAreaScrollable()) {
                verticalMenuObject.niceScroll({
                    scrollspeed: 60,
                    mousescrollstep: 40,
                    cursorwidth: 0,
                    cursorborder: 0,
                    cursorborderradius: 0,
                    cursorcolor: "transparent",
                    autohidemode: false,
                    horizrailenabled: false
                });
            }
        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function() {
                if(verticalMenuObject.length) {
                    initNavigation();
                    initVerticalAreaScroll();
                }
            }
        };
    };


    function qodefPopup() {
        var popupOpener = $('a.qodef-popup-opener'),
            popupClose = $( '.qodef-popup-close' );

        popupOpener.on('click', function(e) {
            
            e.preventDefault();
            if ( qodef.body.hasClass( 'qodef-popup-opened' ) ) {
                qodef.body.removeClass('qodef-popup-opened');
                if(!qodef.body.hasClass('page-template-full_screen-php')){
                    qodef.modules.common.qodefEnableScroll();
                }
            } else {
                qodef.body.addClass('qodef-popup-opened');
                if(!qodef.body.hasClass('page-template-full_screen-php')){
                    qodef.modules.common.qodefDisableScroll();
                }
            }
            popupClose.on('click', function(e) {
                e.preventDefault();
                qodef.body.removeClass('qodef-popup-opened');
                if(!qodef.body.hasClass('page-template-full_screen-php')){
                    qodef.modules.common.qodefEnableScroll();
                }
            });
            //Close on escape
            $(document).keyup(function(e){
                if (e.keyCode === 27 ) { //KeyCode for ESC button is 27
                    qodef.body.removeClass('qodef-popup-opened');
                    if(!qodef.body.hasClass('page-template-full_screen-php')){
                        qodef.modules.common.qodefEnableScroll();
                    }
                }
            });
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    qodef.modules.title = title;

    title.qodefParallaxTitle = qodefParallaxTitle;

    title.qodefOnDocumentReady = qodefOnDocumentReady;
    title.qodefOnWindowLoad = qodefOnWindowLoad;
    title.qodefOnWindowResize = qodefOnWindowResize;
    title.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }

    /*
     **	Title image with parallax effect
     */
    function qodefParallaxTitle(){
        if($('.qodef-title.qodef-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.qodef-title.qodef-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.qodef-title.qodef-has-parallax-background.qodef-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(qodef.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+qodefGlobalVars.vars.qodefAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-qodef.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(qodef.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+qodefGlobalVars.vars.qodefAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-qodef.scroll + 'px auto'});
            });
        }
    }

})(jQuery);

(function($) {
    'use strict';

    var shortcodes = {};

    qodef.modules.shortcodes = shortcodes;

    shortcodes.qodefOnDocumentReady = qodefOnDocumentReady;
    shortcodes.qodefOnWindowLoad = qodefOnWindowLoad;
    shortcodes.qodefOnWindowResize = qodefOnWindowResize;
    shortcodes.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);

    /*
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitAccordions();
	    qodefInitAnimationHolder();
        qodefButton().init();
	    qodefInitClientsCarousel();
        qodefCustomFontResize();
	    qodefInitElementsHolderResponsiveStyle();
	    qodefShowGoogleMap();
	    qodefIcon().init();
	    qodefIconWithHover().init();
        qodefInitIconList().init();
	    qodefInitImageGallery();
	    qodefInitPieChart();
	    qodefInitProgressBars();
        qodefInitTabs();
	    qodefInitTestimonials();
	    qodefInstagramCarousel();
	    qodefTwitterSlider();
    }

    /*
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitCoverBoxes();
	    qodefInitParallax();
	    if(qodef.body.hasClass('wpb-js-composer')) {
		    window.vc_rowBehaviour(); //call vc row behavior on load, this is for parallax on row since it is not loaded after some other shortcodes are loaded
	    }
    }

    /*
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefCustomFontResize();
    }

    /*
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
    }

	/**
	 * Init accordions shortcode
	 */
	function qodefInitAccordions(){
		var accordion = $('.qodef-accordion-holder');
		if(accordion.length){
			accordion.each(function(){

				var thisAccordion = $(this);

				if(thisAccordion.hasClass('qodef-accordion')){

					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('qodef-toggle')){

					var toggleAccordion = $(this);
					var toggleAccordionTitle = toggleAccordion.find('.qodef-title-holder');
					var toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						thisTitle.on('mouseenter mouseleave', function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

	/*
	 *	Init animation holder shortcode
	 */
	function qodefInitAnimationHolder(){

		var elements = $('.qodef-grow-in, .qodef-fade-in-down, .qodef-element-from-fade, .qodef-element-from-left, .qodef-element-from-right, .qodef-element-from-top, .qodef-element-from-bottom, .qodef-flip-in, .qodef-x-rotate, .qodef-z-rotate, .qodef-y-translate, .qodef-fade-in, .qodef-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;

		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);

				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));

					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';

						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}

	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var qodefButton = qodef.modules.shortcodes.qodefButton = function() {
		//all buttons on the page
		var buttons = $('.qodef-btn');

		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};

				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');

				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};

		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};

				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');

				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};

		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};

				var originalBorderColor = button.css('border-color'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');

				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};

		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};

	/**
	 * Init clients carousel shortcode
	 */
	function qodefInitClientsCarousel(){

		var carouselHolder = $('.qodef-clients-carousel-holder');

		if(carouselHolder.length){
			carouselHolder.each(function(){

				var thisCarouselHolder = $(this),
					thisCarousel = thisCarouselHolder.children('.qodef-cc-inner'),
					numberOfItems = 4,
					autoplay = true,
					autoplayTimeout = 5000,
					loop = true,
					speed = 650;

				if (typeof thisCarouselHolder.data('number-of-items') !== 'undefined' && thisCarouselHolder.data('number-of-items') !== false) {
					numberOfItems = parseInt(thisCarouselHolder.data('number-of-items'));
				}

				if (typeof thisCarouselHolder.data('autoplay') !== 'undefined' && thisCarouselHolder.data('autoplay') !== false) {
					autoplay = thisCarouselHolder.data('autoplay');
				}

				if (typeof thisCarouselHolder.data('autoplay-timeout') !== 'undefined' && thisCarouselHolder.data('autoplay-timeout') !== false) {
					autoplayTimeout = thisCarouselHolder.data('autoplay-timeout');
				}

				if (typeof thisCarouselHolder.data('loop') !== 'undefined' && thisCarouselHolder.data('loop') !== false) {
					loop = thisCarouselHolder.data('loop');
				}

				if (typeof thisCarouselHolder.data('speed') !== 'undefined' && thisCarouselHolder.data('speed') !== false) {
					speed = thisCarouselHolder.data('speed');
				}

				if(numberOfItems === 1) {
					autoplay = false;
					loop = false;
				}

                var responsiveItems1 = numberOfItems;
                var responsiveItems2 = 4;
                var responsiveItems3 = 3;
                var responsiveItems4 = 2;

                if (numberOfItems > 5) {
                    responsiveItems1 = 5;
                }

                if(numberOfItems < 4) {
                    responsiveItems2 = numberOfItems;
                }

                if (numberOfItems < 3) {
                    responsiveItems3 = numberOfItems;
                }

                if (numberOfItems === 1) {
                    responsiveItems4 = numberOfItems;
                }

				thisCarousel.owlCarousel({
					items: numberOfItems,
					autoplay: autoplay,
					autoplayTimeout: autoplayTimeout,
					loop: loop,
					smartSpeed: speed,
					nav: false,
					dots: false,
                    responsive:{
                        1200:{
                            items: numberOfItems
                        },
                        1024:{
                            items: responsiveItems1
                        },
                        769:{
                            items: responsiveItems2
                        },
                        601:{
                            items: responsiveItems3
                        },
                        0:{
                            items: responsiveItems4
                        }
                    }
				});

				thisCarousel.css({'visibility': 'visible'});
			});
		}
	}

    /*
     ** Cover boxes
     */
    function qodefInitCoverBoxes() {

        var coverBoxes = $('.qodef-cover-boxes');

        if (coverBoxes.length > 0) {
            coverBoxes.each(function () {
                var activeElement = 0;
                var dataActiveElement = 1;
                if (typeof $(this).data('active-element') !== 'undefined' && $(this).data('active-element') !== false) {
                    dataActiveElement = parseFloat($(this).data('active-element'));
                    activeElement = dataActiveElement - 1;
                }

                var numberOfColumns = 3;

                if (typeof $(this).data('active-element') !== 'undefined' && $(this).data('active-element') === 2) {
                    numberOfColumns = 2;
                }

                //validate active element
                activeElement = dataActiveElement > numberOfColumns ? 0 : activeElement;

                $(this).find('li').eq(activeElement).addClass('act');
                var coverBoxed = $(this);
                $(this).find('li').each(function () {
                    $(this).on('mouseenter', function () {
                        $(coverBoxed).find('li').removeClass('act');
                        $(this).addClass('act');
                    });

                });

                //calculate holder height based on children
                var holder = $(this).find('ul');
                var max = -1;
                holder.find('li').each(function() {
                    var h = $(this).outerHeight(true);
                    max = h > max ? h : max;
                });
                holder.css({'height' : max + 'px'});
            });
        }
    }

    /*
     **	Custom Font resizing
     */
    function qodefCustomFontResize(){
        var customFont = $('.qodef-custom-font-holder');
        if (customFont.length){
            customFont.each(function(){
                var thisCustomFont = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;
                var coef3 = 1;

                if (qodef.windowWidth < 1500){
                    coef3 = 0.7;
                }

                if (qodef.windowWidth < 1300){
                    coef1 = 0.8;
                    coef3 = 0.7;
                    coef2 = 0.9;
                }

                if (qodef.windowWidth < 1024){
                    coef1 = 0.7;
                    coef3 = 0.6;
                    coef2 = 0.8;
                }

                if (qodef.windowWidth < 768){
                    coef1 = 0.6;
                    coef2 = 0.7;
                    coef3 = 0.5;
                }

                if (qodef.windowWidth < 600){
                    coef1 = 0.5;
                    coef2 = 0.6;
                    coef3 = 0.4;
                }

                if (qodef.windowWidth < 480){
                    coef1 = 0.4;
                    coef2 = 0.5;
                    coef3 = 0.3;
                }

                if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
                    fontSize = parseInt(thisCustomFont.data('font-size'));

                    if  (fontSize > 100){
                        fontSize = Math.round(fontSize*coef3);
                    }
                    else if (fontSize > 70) {
                        fontSize = Math.round(fontSize*coef1);
                    }
                    else if (fontSize > 35) {
                        fontSize = Math.round(fontSize*coef2);

                    }

                    thisCustomFont.css('font-size',fontSize + 'px');
                }

                if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
                    lineHeight = parseInt(thisCustomFont.data('line-height'));
                    //Check if font size is set
                    if(typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
                        fontSize = parseInt(thisCustomFont.data('font-size'));
                    }
                    else {
                        fontSize = 0;
                    }

                    if(fontSize !== 0 && fontSize === lineHeight) {
                        if  (fontSize > 100){
                            lineHeight = Math.round(fontSize*coef3) + 'px';
                        }
                        else if (fontSize > 70) {
                            lineHeight = Math.round(fontSize*coef1) + 'px';
                        }
                        else if (fontSize > 35) {
                            lineHeight = Math.round(fontSize*coef2) + 'px';

                        }
                    }
                    else if (lineHeight > 70 && qodef.windowWidth < 1200) {
                        lineHeight = '1.2em';
                    }
                    else if (lineHeight > 35 && qodef.windowWidth < 768) {
                        lineHeight = '1.2em';
                    }
                    else{
                        lineHeight += 'px';
                    }
                    thisCustomFont.css('line-height', lineHeight);
                }
            });
        }
    }

	/*
	 **	Elements Holder responsive style
	 */
	function qodefInitElementsHolderResponsiveStyle(){

		var elementsHolder = $('.qodef-elements-holder');

		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.qodef-eh-item'),
					style = '',
					responsiveStyle = '';

				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
						largeLaptop = thisItem.data('1280-1600');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
						ipadPortrait = thisItem.data('600-768');
					}
					if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
						mobileLandscape = thisItem.data('480-600');
					}
					if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
						mobilePortrait = thisItem.data('480');
					}

					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1600px) {.qodef-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.qodef-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.qodef-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
						if(mobilePortrait.length) {
							responsiveStyle += "@media only screen and (max-width: 480px) {.qodef-eh-item-content."+itemClass+" { padding: "+mobilePortrait+" !important; } }";
						}
					}
				});

				if(responsiveStyle.length) {
					style = '<style type="text/css" data-type="coney_qodef_shortcodes_custom_css">'+responsiveStyle+'</style>';
				}

				if(style.length) {
					$('head').append(style);
				}
			});
		}
	}

	/*
	 **	Show Google Map
	 */
	function qodefShowGoogleMap(){
		var googleMap = $('.qodef-google-map');

		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);

				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}

				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}

				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}

				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}

				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}

				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}

				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}

				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}

				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}

				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "qodef-map-"+ uniqueId;

				qodefInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}

	/*
	 **	Init Google Map
	 */
	function qodefInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){

		if( typeof google !== 'object' ){
			return;
		}

		var mapStyles = [
			{
				stylers: [
					{hue: color },
					{saturation: saturation},
					{lightness: lightness},
					{gamma: 1}
				]
			}
		];

		var googleMapStyleId;

		if(customMapStyle === 'yes'){
			googleMapStyleId = 'qodef-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}

		if(wheel === 'yes'){
			wheel = true;
		} else {
			wheel = false;
		}

		var qoogleMapType = new google.maps.StyledMapType(mapStyles,
			{name: "Qode Google Map"});

		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);

		if (!isNaN(height)){
			height = height + 'px';
		}

		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};

		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('qodef-style', qoogleMapType);

		var index;

		for (index = 0; index < data.length; ++index) {
			qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
		}

		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}

	/*
	 **	Init Google Map Addresses
	 */
	function qodefInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}

		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data['store_title']
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});

				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var qodefIcon = function() {
        //get all icons on page
        var icons = $('.qodef-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('qodef-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.qodef-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });
                }
            }
        };
    };

	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var qodefIconWithHover = function() {
		//get all icons on page
		var icons = $('.qodef-icon-has-hover');

		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};

				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');

				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};

		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};

	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var qodefInitIconList = function() {
		var iconList = $('.qodef-animate-list');

		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			},30);
		};

		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};

	/**
	 * Init image gallery shortcode
	 */
	function qodefInitImageGallery() {

		var galleries = $('.qodef-image-gallery');

		if (galleries.length) {
			galleries.each(function () {
				var gallery = $(this).find('.qodef-ig-slider'),
					numberOfItems = gallery.data('number-of-visible-items'),
					autoplay = gallery.data('autoplay'),
					animation = (gallery.data('animation') === 'slide') ? false : gallery.data('animation'),
					navigation = (gallery.data('navigation') === 'yes'),
					pagination = (gallery.data('pagination') === 'yes');

				//Responsive breakpoints
				var items = numberOfItems;

				var responsiveItems1 = 4;
				var responsiveItems2 = 3;
				var responsiveItems3 = 2;
				var responsiveItems4 = 1;

				if (items < 3) {
					responsiveItems1 = items;
					responsiveItems2 = items;
				}

				if (items < 2) {
					responsiveItems3 = items;
				}

				gallery.owlCarousel({
					autoplay: true,
					autoplayTimeout: autoplay * 1000,
					loop: true,
					smartSpeed: 600,
					animateIn : animation, //fade, fadeUp, backSlide, goDown
					nav: navigation,
					dots: pagination,
					navText: [
						'<span class="qodef-prev-icon"><span class="qodef-icon-arrow ion-ios-arrow-thin-left"></span></span>',
						'<span class="qodef-next-icon"><span class="qodef-icon-arrow ion-ios-arrow-thin-right"></span></span>'
					],
					responsive:{
						1201:{
							items: items
						},
						769:{
							items: responsiveItems1
						},
						601:{
							items: responsiveItems2
						},
						481:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					}
				});

				gallery.css({'visibility': 'visible'});
			});
		}
	}

	/*
	 ** Sections with parallax background image
	 */
	function qodefInitParallax(){

		var parallaxHolder = $('.qodef-parallax-holder');

		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					speed = parallaxElement.data('parallax-speed')*0.4;

				parallaxElement.parallax('50%', speed);
			});
		}
	}

	/**
	 * Init Pie Chart shortcode
	 */
	function qodefInitPieChart() {
		var pieChartHolder = $('.qodef-pie-chart-holder');

		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.qodef-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 3,
					size = 176;

				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}

				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}

				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}

				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');

					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}

	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.qodef-pc-percent'),
			max = parseFloat(counter.text());

		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}

	/*
	 **	Horizontal progress bars shortcode
	 */
	function qodefInitProgressBars(){

		var progressBar = $('.qodef-progress-bar');

		if(progressBar.length){

			progressBar.each(function() {

				var thisBar = $(this),
					thisBarContent = thisBar.find('.qodef-pb-content'),
					percentage = thisBarContent.data('percentage'),
                    progressNumber = thisBar.find('.qodef-pb-number-box');

				thisBar.appear(function() {
					qodefInitToCounterProgressBar(thisBar, percentage);

					thisBarContent.css('width', '0%');
					thisBarContent.animate({'width': percentage+'%'}, 2000);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage+'%'}, 2000);
				});
			});
		}
	}

	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function qodefInitToCounterProgressBar(progressBar, $percentage){
		var percentage = parseFloat($percentage),
			percent = progressBar.find('.qodef-pb-number');

		if(percent.length) {
			percent.each(function() {
				var thisPercent = $(this);
                thisPercent.parents('.qodef-pb-number-wrapper').css('opacity', '1');
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}

	/*
	 **	Init tabs shortcode
	 */
	function qodefInitTabs(){
		var tabs = $('.qodef-tabs');

		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);

				thisTabs.children('.qodef-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.qodef-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');

					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});

				thisTabs.tabs();
			});
		}
	}

	/**
	 * Init testimonials shortcode
	 */
	function qodefInitTestimonials(){

		var testimonialsHolder = $('.qodef-testimonials-holder');

		if(testimonialsHolder.length){
			testimonialsHolder.each(function(){

				var thisTestimonials = $(this),
					testimonials = thisTestimonials.children('.qodef-testimonials'),
					numberOfItems = 3,
					loop = true,
					autoplay = true,
					number = 0,
					speed = 5000,
					animationSpeed = 600,
					navArrows = true,
					navDots = true,
					margin = 26;

				if (typeof testimonials.data('number') !== 'undefined' && testimonials.data('number') !== false) {
					number = parseInt(testimonials.data('number'));
				}

				if (typeof testimonials.data('speed') !== 'undefined' && testimonials.data('speed') !== false) {
					speed = testimonials.data('speed');
				}

				if (typeof testimonials.data('animation-speed') !== 'undefined' && testimonials.data('animation-speed') !== false) {
					animationSpeed = testimonials.data('animation-speed');
				}

				if (typeof testimonials.data('nav-arrows') !== 'undefined' && testimonials.data('nav-arrows') !== false && testimonials.data('nav-arrows') === 'no') {
					navArrows = false;
				}

				if (typeof testimonials.data('nav-dots') !== 'undefined' && testimonials.data('nav-dots') !== false && testimonials.data('nav-dots') === 'no') {
					navDots = false;
				}

				if(number === 1) {
					loop = false;
					autoplay = false;
					navArrows = false;
					navDots = false;
				}

				testimonials.owlCarousel({
					items: numberOfItems,
					responsive:  {
						// breakpoint from 0 up
						0 : {
							items : 1
						},
						// breakpoint from 768 up
						769 : {
							items : 2
						},
						// breakpoint from 1025 up
						1025 : {
							items : numberOfItems
						}
					},
					loop: loop,
					autoplay: false,
					autoplayTimeout: speed,
					smartSpeed: animationSpeed,
					margin: margin,
					nav: navArrows,
					dots: navDots,
					navText: [
						'<span class="qodef-prev-icon"><span class="qodef-icon-arrow ion-ios-arrow-thin-left"></span></span>',
						'<span class="qodef-next-icon"><span class="qodef-icon-arrow ion-ios-arrow-thin-right"></span></span>'
					]
				});

				thisTestimonials.css({'visibility': 'visible'});
			});
		}
	}

	function qodefInstagramCarousel() {

		var instagramCarousels = $('.qodef-instagram-feed.qodef-instagram-carousel');

		if (instagramCarousels.length) {
			instagramCarousels.each(function(){

				var carousel = $(this),
					items = 6,
					loop = true,
					margin;

				if (typeof carousel.data('items') !== 'undefined' && carousel.data('items') !== false) {
					items = carousel.data('items');
				}

				// Fix for the issue with the carousels holding only one item - the carousel's core issue
				if (carousel.children().length === 1) { loop = false; }

				if(items === 1) {
					margin = 0;
				} else if((carousel.data('space-between-items') === 'normal')) {
					margin = 20;
				} else if((carousel.data('space-between-items') === 'small')) {
					margin = 10;
				} else if((carousel.data('space-between-items') === 'tiny')) {
					margin = 5;
				} else if((carousel.data('space-between-items') === 'no')) {
					margin = 0;
				}

				var responsiveItems1 = items;
				var responsiveItems2 = 4;
				var responsiveItems3 = 3;
				var responsiveItems4 = 2;

				if (items > 5) {
					responsiveItems1 = 5;
				}

				if(items < 4) {
					responsiveItems2 = items;
				}

				if (items < 3) {
					responsiveItems3 = items;
				}

				if (items === 1) {
					responsiveItems4 = items;
				}

				carousel.owlCarousel({
					autoplay: true,
					autoplayHoverPause: true,
					autoplayTimeout: 5000,
					smartSpeed: 600,
					items: items,
					margin: margin,
					loop: loop,
					dots: false,
					nav: false,
					responsive:{
						1200:{
							items: items
						},
						1024:{
							items: responsiveItems1
						},
						769:{
							items: responsiveItems2
						},
						601:{
							items: responsiveItems3
						},
						0:{
							items: responsiveItems4
						}
					},
					onInitialized: function() {
						carousel.css({'opacity': 1});
					}
				});

			});
		}
	}

	function qodefTwitterSlider(){

		var twitterSlider = $('.qodef-twitter-slider');

		if(twitterSlider.length){
			twitterSlider.each(function(){

				var thisTwitterSlider = $(this),
				//tweets = thisTwitterSlider.children('.qodef-tweet-holder'),
					loop = true,
					autoplay = true,
					items = 0,
					speed = 5000,
					animationSpeed = 600,
					navigation = true;

				if(items === 1) {
					loop = false;
					autoplay = false;
					navigation = false;
				}

				thisTwitterSlider.owlCarousel({
					items: 1,
					loop: loop,
					autoplay: autoplay,
					autoplayTimeout: speed,
					smartSpeed: animationSpeed,
					dots: navigation
				});

				thisTwitterSlider.css({'visibility': 'visible'});
			});
		}
	}

})(jQuery);
(function ($) {
    "use strict";

    var blog = {};
    qodef.modules.blog = blog;

    blog.qodefOnDocumentReady = qodefOnDocumentReady;
    blog.qodefOnWindowLoad = qodefOnWindowLoad;
    blog.qodefOnWindowResize = qodefOnWindowResize;
    blog.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitAudioPlayer();
        qodefInitBlogMasonry();
        qodefInitBlogListMasonry();
        qodefInitRelatedPosts();
        qodefInitBlogSlider();
        qodefBlogArticlesAppearTrigger();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitBlogPagination().init();
        qodefInitBlogListShortcodePagination().init();
        qodefInitBlogChequered();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitBlogMasonry();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
        qodefInitBlogPagination().scroll();
        qodefInitBlogListShortcodePagination().scroll();
    }

    /**
     * Init audio player for Blog list and single pages
     */
    function qodefInitAudioPlayer() {

        var players = $('audio.qodef-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }

    /**
     * Init Resize Blog Items
     */
    function qodefResizeBlogItems(size, container) {

        if (container.hasClass('qodef-masonry-images-fixed')) {
            var padding = parseInt(container.find('article').css('padding-left')),
                defaultMasonryItem = container.find('.qodef-post-size-default'),
                largeWidthMasonryItem = container.find('.qodef-post-size-large-width'),
                largeHeightMasonryItem = container.find('.qodef-post-size-large-height'),
                largeWidthHeightMasonryItem = container.find('.qodef-post-size-large-width-height');

            if (qodef.windowWidth > 680) {
                defaultMasonryItem.css('height', size - 2 * padding);
                largeHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthHeightMasonryItem.css('height', Math.round(2 * size) - 2 * padding);
                largeWidthMasonryItem.css('height', size - 2 * padding);
            } else {
                defaultMasonryItem.css('height', size);
                largeHeightMasonryItem.css('height', size);
                largeWidthHeightMasonryItem.css('height', size);
                largeWidthMasonryItem.css('height', Math.round(size / 2));
            }
        }
    }

    /**
     * Init Blog Masonry Layout
     */
    function qodefInitBlogMasonry() {
        var holder = $('.qodef-blog-holder.qodef-blog-type-masonry');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    masonry = thisHolder.children('.qodef-blog-holder-inner'),
                    size = thisHolder.find('.qodef-blog-masonry-grid-sizer').width();

                qodefResizeBlogItems(size, thisHolder);

                masonry.waitForImages(function () {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: 'article',
                        percentPosition: true,
                        packery: {
                            gutter: '.qodef-blog-masonry-grid-gutter',
                            columnWidth: '.qodef-blog-masonry-grid-sizer'
                        }
                    });
                    masonry.css('opacity', '1');
                });
            });
        }
    }

    /**
     *  Init Blog Chequered
     */
    function qodefInitBlogChequered() {
        var container = $('.qodef-blog-holder.qodef-blog-chequered');
        var masonry = container.children('.qodef-blog-holder-inner');
        var newSize, padding;

        if (container.length) {
            padding = parseInt(masonry.find('article').css('padding-left'));
            newSize = masonry.find('.qodef-blog-masonry-grid-sizer').outerWidth() - 2 * padding;
            masonry.children('article').css({'height': (newSize) + 'px'});
            masonry.isotope('layout');
        }
    }

    /**
     *  Trigger blog list animation initially
     */
    function qodefBlogArticlesAppearTrigger() {
        var blogLists = $('.qodef-blog-holder');

        if (blogLists.length) {
            blogLists.each(function () {
                var blogList = $(this),
                    preloader = false,
                    initialDelay = 0,
                    isotopeDelay = 200; //extend layout complete timing

                if (qodef.body.hasClass('qodef-smooth-page-transitions')) {
                    preloader = true;

                    if ($('.qodef-smooth-transition-loader .progress-loader-holder').length) {
                        initialDelay = 1000; //preloader remove delay
                    }
                }

                //trigger function
                var triggerAppear = function () {
                    setTimeout(function () {
                        if (blogList.hasClass('qodef-blog-type-masonry')) {
                            blogList.on('layoutComplete', setTimeout(function () {
                                qodefInitBlogArticlesAppear()
                            }, isotopeDelay));
                        } else {
                            qodefInitBlogArticlesAppear();
                        }
                    }, initialDelay);
                };

                if (!preloader) {
                    triggerAppear();
                } else {
                    $(window).load(function () {
                        triggerAppear();
                    });
                }
            });
        }
    }

    /**
     *  Animate blog lists
     */
    function qodefInitBlogArticlesAppear() {
        var blogList = $('.qodef-blog-holder.qodef-blog-list-animate');

        if (blogList.length && !qodef.htmlEl.hasClass('touch')) {
            blogList.each(function () {
                var thisBlogList = $(this),
                    article = thisBlogList.find('article'),
                    pagination = thisBlogList.find('.qodef-blog-pag-load-more'),
                    cycleAnimation = thisBlogList.hasClass('qodef-blog-animate-cycle') ? true : false; //cycle animation for lists with more than one article in a row

                if (cycleAnimation) {
                    var animateCycle = 0, // rewind delay
                        animateCycleCounter = 0;

                    article.each(function () {
                        if ($(this).offset().top === article.first().offset().top) { //find the number of articles in the same row
                            animateCycle++
                        }
                    });

                    article.appear(function () {
                        var currentArticle = $(this);

                        if (animateCycleCounter === animateCycle) {
                            animateCycleCounter = 0;
                        }

                        setTimeout(function () {
                            currentArticle.addClass('qodef-appear');

                            currentArticle.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                                currentArticle.addClass('qodef-appeared');
                            });
                        }, animateCycleCounter * 200);

                        animateCycleCounter++;
                    });
                } else {
                    article.appear(function () {
                        var currentArticle = $(this);

                        currentArticle.addClass('qodef-appear');

                        currentArticle.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                            currentArticle.addClass('qodef-appeared');
                        });
                    }, {accX: 0, accY: 0});
                }

                if (pagination.length) {
                    pagination.appear(function () {
                        pagination.addClass('qodef-appeared');
                    }, {accX: 0, accY: 0});
                }
            });
        }
    }

    /**
     * Initializes blog pagination functions
     */
    function qodefInitBlogPagination() {
        var holder = $('.qodef-blog-holder');

        var initLoadMorePagination = function (thisHolder) {
            var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                initMainPagFunctionality(thisHolder);

                loadMoreButton.fadeOut(100, function () {
                    thisHolder.find('.qodef-blog-pag-load-more .progress-loader-holder-number').text("0");
                    qodef.modules.common.qodefInitProgressLoader();
                });
            });
        };

        var initInifiteScrollPagination = function (thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;

            if (!thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function (thisHolder) {
            var thisHolderInner = thisHolder.children('.qodef-blog-holder-inner'),
                nextPage,
                maxNumPages,
                loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if (thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
                thisHolder.addClass('qodef-blog-pagination-infinite-scroll-started');
                thisHolder.find('.qodef-blog-pag-load-more .progress-loader-holder-number').text("0");
                qodef.modules.common.qodefInitProgressLoader();
            }

            var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.qodef-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');

            loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
            loadMoreDatta.blog_load_more_nonce = nonceHolder.val();

            if (nextPage <= maxNumPages) {
                loadingItem.addClass('qodef-showing');

                var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'coney_qodef_blog_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: QodefAjaxUrl,
                    success: function (data) {
                        nextPage++;

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        thisHolder.waitForImages(function () {
                            if (thisHolder.hasClass('qodef-blog-type-masonry')) {
                                qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                qodefResizeBlogItems(thisHolderInner.find('.qodef-blog-masonry-grid-sizer').width(), thisHolder);
                            } else {
                                qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
                            }

                            setTimeout(function () {
                                qodefInitAudioPlayer();
                                qodef.modules.common.qodefOwlSlider();
                                qodef.modules.common.qodefFluidVideo();
                                qodefInitBlogArticlesAppear();
                                qodefInitBlogChequered();
                                loadMoreButton.fadeIn(200);
                            }, 400);
                        });

                        if (thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started')) {
                            thisHolder.removeClass('qodef-blog-pagination-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisHolder.find('.qodef-blog-pag-load-more').hide();
            }
        };

        var qodefInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('qodef-showing');

            setTimeout(function () {
                thisHolderInner.isotope('layout');
            }, 400);
        };

        var qodefInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('qodef-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('qodef-blog-pagination-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if (thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

    /**
     * Init blog list shortcode masonry layout
     */
    function qodefInitBlogListMasonry() {
        var holder = $('.qodef-blog-list-holder.qodef-bl-masonry');

        if (holder.length) {
            holder.each(function () {
                var thisHolder = $(this),
                    masonry = thisHolder.find('.qodef-blog-list');

                masonry.waitForImages(function () {
                    masonry.isotope({
                        layoutMode: 'packery',
                        itemSelector: '.qodef-bl-item',
                        percentPosition: true,
                        packery: {
                            gutter: '.qodef-bl-grid-gutter',
                            columnWidth: '.qodef-bl-grid-sizer'
                        }
                    });

                    masonry.css('opacity', '1');
                });
            });
        }
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function qodefInitBlogListShortcodePagination() {
        var holder = $('.qodef-blog-list-holder');

        var initStandardPagination = function (thisHolder) {
            var standardLink = thisHolder.find('.qodef-bl-standard-pagination li');

            if (standardLink.length) {
                standardLink.each(function () {
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function (thisHolder) {
            var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');

            loadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);

                thisHolder.find('.qodef-blog-pag-load-more .progress-loader-holder-number').text("0");
                qodef.modules.common.qodefInitProgressLoader();
            });
        };

        var initInifiteScrollPagination = function (thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;

            if (!thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function (thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.qodef-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if (thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
                thisHolder.data('next-page', pagedLink);
            }

            if (thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                thisHolder.addClass('qodef-bl-pag-infinite-scroll-started');
                thisHolder.find('.qodef-blog-pag-load-more .progress-loader-holder-number').text("0");
                qodef.modules.common.qodefInitProgressLoader();
            }

            var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.qodef-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');

            loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
            loadMoreDatta.blog_load_more_nonce = nonceHolder.val();

            if (nextPage <= maxNumPages) {
                if (thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
                    loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
                    thisHolder.addClass('qodef-bl-pag-standard-blog-list-animate');
                } else {
                    loadingItem.addClass('qodef-showing');
                }

                var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'coney_qodef_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: QodefAjaxUrl,
                    success: function (data) {
                        if (!thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml = response.html;

                        if (thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
                            qodefInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function () {
                                if (thisHolder.hasClass('qodef-bl-masonry')) {
                                    qodefInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    qodefInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function () {
                                if (thisHolder.hasClass('qodef-bl-masonry')) {
                                    qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
                                }
                            });
                        }

                        if (thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('qodef-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if (nextPage === maxNumPages) {
                thisHolder.find('.qodef-blog-pag-load-more').hide();
            }
        };

        var qodefInitStandardPaginationLinkChanges = function (thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.qodef-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.qodef-bl-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.qodef-bl-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.qodef-bl-pag-next a');

            standardPagNumericItem.removeClass('qodef-bl-pag-active');
            standardPagNumericItem.eq(nextPage - 1).addClass('qodef-bl-pag-active');

            standardPagPrevItem.data('paged', nextPage - 1);
            standardPagNextItem.data('paged', nextPage + 1);

            if (nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if (nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var qodefInitHtmlIsotopeNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
            thisHolder.removeClass('qodef-bl-pag-standard-blog-list-animate');

            setTimeout(function () {
                thisHolderInner.isotope('layout');
            }, 400);
        };

        var qodefInitHtmlGalleryNewContent = function (thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
            thisHolder.removeClass('qodef-bl-pag-standard-blog-list-animate');
            thisHolderInner.html(responseHtml);
        };

        var qodefInitAppendIsotopeNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('qodef-showing');

            setTimeout(function () {
                thisHolderInner.isotope('layout');
            }, 400);
        };

        var qodefInitAppendGalleryNewContent = function (thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('qodef-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('qodef-bl-pag-standard-blog-list')) {
                            initStandardPagination(thisHolder);
                        }

                        if (thisHolder.hasClass('qodef-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if (thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function () {
                if (holder.length) {
                    holder.each(function () {
                        var thisHolder = $(this);

                        if (thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

    /**
     * Init Related Posts
     */
    function qodefInitRelatedPosts() {

        var relatedPostsHolder = $('.qodef-related-posts-holder-inner');

        if (relatedPostsHolder.length) {
            relatedPostsHolder.each(function () {

                var thisRelatedPosts = $(this),
                    relatedPosts = thisRelatedPosts.children('.qodef-related-posts-inner'),
                    numberOfItems = 4;

                if (typeof relatedPosts.data('number-visible') !== 'undefined' && relatedPosts.data('number-visible') !== false) {
                    numberOfItems = parseInt(relatedPosts.data('number-visible'));
                }

                if (typeof relatedPosts.data('layout') !== 'undefined' && relatedPosts.data('layout') === 'carousel') {
                    relatedPosts.owlCarousel({
                        items: numberOfItems,
                        loop: true,
                        autoplay: false,
                        dots: true,
                        responsive: {
                            769: {
                                items: numberOfItems
                            },
                            601: {
                                items: 2
                            },
                            0: {
                                items: 1
                            }
                        }
                    });
                }

            });
        }
    }

    function qodefInitBlogSlider() {

        var blogSlider = $('.qodef-blog-slider-holder .qodef-blog-slider');

        if (blogSlider.length) {
            blogSlider.each(function () {

                var thisBlogSlider = $(this),
                    startPosition = 0,
                    stagePaddin = 0,
                    stagePaddinResp = 0,
                    marginValue = 0,
                    dots = false,
                    arrow = false;


                if (typeof thisBlogSlider.data('centered') !== 'undefined' && thisBlogSlider.data('centered') !== false && thisBlogSlider.data('centered') === 'yes' && $('body').hasClass('qodef-grid-1100') && qodef.windowWidth > 1490) {
                    stagePaddin = 400;
                    startPosition = 1;
                } else if (typeof thisBlogSlider.data('centered') !== 'undefined' && thisBlogSlider.data('centered') !== false && thisBlogSlider.data('centered') === 'yes' && $('body').hasClass('qodef-grid-1200')) {
                    stagePaddin = 350;
                } else if (typeof thisBlogSlider.data('centered') !== 'undefined' && thisBlogSlider.data('centered') !== false && thisBlogSlider.data('centered') === 'yes' && $('body').hasClass('qodef-grid-1300')) {
                    stagePaddin = 300;
                } else if (typeof thisBlogSlider.data('centered') !== 'undefined' && thisBlogSlider.data('centered') !== false && thisBlogSlider.data('centered') === 'yes' && $('body').hasClass('qodef-grid-1000')) {
                    stagePaddin = 450;
                } else if (typeof thisBlogSlider.data('centered') !== 'undefined' && thisBlogSlider.data('centered') !== false && thisBlogSlider.data('centered') === 'yes' && $('body').hasClass('qodef-grid-800')) {
                    stagePaddin = 550;
                } else if (typeof thisBlogSlider.data('centered') !== 'undefined' && thisBlogSlider.data('centered') !== false && thisBlogSlider.data('centered') === 'yes' && $(window).width() < 1490) {
                    stagePaddin = 250;
                }

                if (typeof thisBlogSlider.data('dots') !== 'undefined' && thisBlogSlider.data('dots') !== false && thisBlogSlider.data('dots') === 'yes') {
                    dots = true;
                }

                if (typeof thisBlogSlider.data('navigation') !== 'undefined' && thisBlogSlider.data('navigation') !== false && thisBlogSlider.data('navigation') === 'yes') {
                    arrow = true;
                }

                if (typeof thisBlogSlider.data('centered') !== 'undefined' && thisBlogSlider.data('centered') !== false && thisBlogSlider.data('centered') === 'yes') {
                    marginValue = 50;
                    if (qodef.windowWidth > 1280) {
                        stagePaddinResp = 133;
                    } else if (qodef.windowWidth > 1024) {
                        stagePaddinResp = 90;
                    }
                }

                blogSlider.owlCarousel({
                    responsive: {
                        0: {
                            loop: true,
                            items: 1,
                            center: true,
                            startPosition: startPosition,
                            margin: 0,
                            dots: dots,
                            autoplay: true,
                            nav: false
                        },
                        1025: {
                            loop: true,
                            items: 1,
                            startPosition: startPosition,
                            margin: marginValue,
                            dots: dots,
                            center: true,
                            autoplay: true,
                            nav: arrow,
                            autoWidth: false,
                            stagePadding: stagePaddinResp,
                            navText: [
                                '<span class="qodef-prev-icon"><span class="qodef-icon-arrow arrow_carrot-left"></span></span>',
                                '<span class="qodef-next-icon"><span class="qodef-icon-arrow arrow_carrot-right"></span></span>'
                            ]
                        },
                        1460: {
                            loop: true,
                            items: 1,
                            startPosition: startPosition,
                            margin: marginValue,
                            dots: dots,
                            autoplay: true,
                            center: true,
                            nav: arrow,
                            autoWidth: false,
                            stagePadding: stagePaddin,
                            navText: [
                                '<span class="qodef-prev-icon"><span class="qodef-icon-arrow arrow_carrot-left"></span></span>',
                                '<span class="qodef-next-icon"><span class="qodef-icon-arrow arrow_carrot-right"></span></span>'
                            ]
                        }
                    },
                    onInitialized: function () {
                        blogSlider.parent().css({'visibility': 'visible'});
                    }
                });
            });
        }

    }

})(jQuery);
(function($) {
    'use strict';

    var portfolio = {};
    qodef.modules.portfolio = portfolio;

    portfolio.qodefOnDocumentReady = qodefOnDocumentReady;
    portfolio.qodefOnWindowLoad = qodefOnWindowLoad;
    portfolio.qodefOnWindowResize = qodefOnWindowResize;
    portfolio.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitPortfolioSlider();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitPortfolioFilter();
        qodefInitPortfolioListAnimation();
	    qodefInitPortfolioPagination().init();
        qodefPortfolioSingleFollow().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function qodefOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
	    qodefInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function qodefInitPortfolioListAnimation(){
        var portList = $('.qodef-portfolio-list-holder.qodef-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.qodef-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('qodef-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('qodef-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function qodefInitPortfolioFilter(){
        var filterHolder = $('.qodef-portfolio-list-holder .qodef-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.qodef-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.qodef-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('qodef-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.qodef-pl-filter:first').addClass('qodef-pl-current');
	            
	            if(thisPortListHolder.hasClass('qodef-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.qodef-pl-filter').on('click',function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
                        portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.qodef-pl-filter').removeClass('qodef-pl-current');
                    thisFilter.addClass('qodef-pl-current');

                    if(portListHasLoadMore && !portListHasArticles) {
                        qodefInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
                    } else {
                        thisFilterHolder.parent().children('.qodef-pl-inner').isotope({ filter: filterValue });
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function qodefInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {

        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.qodef-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'qodef_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.qodef-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('qodef-showing qodef-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: QodefAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArtciles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                        if(portListHasArtciles) {
                            setTimeout(function() {
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('qodef-showing qodef-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('qodef-showing qodef-filter-trigger');
                            qodefInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function qodefInitPortfolioPagination(){
		var portList = $('.qodef-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.qodef-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.qodef-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisPortList.hasClass('qodef-pl-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.qodef-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
				thisPortList.addClass('qodef-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.qodef-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages){
				if(thisPortList.hasClass('qodef-pl-pag-standard')) {
					loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
					thisPortList.addClass('qodef-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('qodef-showing');
				}
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'qodef_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: QodefAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('qodef-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							qodefInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter')) {
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter')) {
									qodefInitAppendIsotopeNewContent(thisPortListInner, loadingItem, responseHtml);
								} else {
									qodefInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
								}
							});
						}
						
						if(thisPortList.hasClass('qodef-pl-infinite-scroll-started')) {
							thisPortList.removeClass('qodef-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.qodef-pl-load-more-holder').hide();
			}
		};
		
		var qodefInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.qodef-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.qodef-pl-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.qodef-pl-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.qodef-pl-pag-next a');
			
			standardPagNumericItem.removeClass('qodef-pl-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('qodef-pl-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
			}
		};
		
		var qodefInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
			}, 400);
		};
		
		var qodefInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			qodefInitPortfolioListAnimation();
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
			}, 400);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisPortListInner.append(responseHtml);
			qodefInitPortfolioListAnimation();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			}
		};
	}

    /**
     * Initializes portfolio slider
     */
    function qodefInitPortfolioSlider(){
        var portSlider = $('.qodef-portfolio-slider-holder');
	
	    if(portSlider.length) {
		    portSlider.each(function () {
			    var thisPortSlider = $(this),
				    portHolder = thisPortSlider.children('.qodef-portfolio-list-holder'),
				    portSlider = portHolder.children('.qodef-pl-inner'),
				    numberOfItems = 4,
				    margin = 0,
				    marginLabel,
				    sliderSpeed = 5000,
				    loop = true,
				    padding = false,
				    navigation = true,
				    pagination = true;
			
			    if (typeof portHolder.data('number-of-columns') !== 'undefined' && portHolder.data('number-of-columns') !== false) {
				    numberOfItems = portHolder.data('number-of-columns');
			    }
			
			    if (typeof portHolder.data('space-between-items') !== 'undefined' && portHolder.data('space-between-items') !== false) {
				    marginLabel = portHolder.data('space-between-items');
				
				    if (marginLabel === 'normal') {
                        margin = 30;
                    } else if (marginLabel === 'small') {
					    margin = 20;
				    } else if (marginLabel === 'tiny') {
                        margin = 10;
                    } else {
					    margin = 0;
				    }
			    }
			
			    if (typeof portHolder.data('slider-speed') !== 'undefined' && portHolder.data('slider-speed') !== false) {
				    sliderSpeed = portHolder.data('slider-speed');
			    }
			    if (typeof portHolder.data('enable-loop') !== 'undefined' && portHolder.data('enable-loop') !== false && portHolder.data('enable-loop') === 'no') {
				    loop = false;
			    }
			    if (typeof portHolder.data('padding') !== 'undefined' && portHolder.data('padding') !== false && portHolder.data('padding') === 'yes') {
				    padding = true;
			    }
			    if (typeof portHolder.data('navigation') !== 'undefined' && portHolder.data('navigation') !== false && portHolder.data('navigation') === 'no') {
				    navigation = false;
			    }
			    if (typeof portHolder.data('pagination') !== 'undefined' && portHolder.data('pagination') !== false && portHolder.data('pagination') === 'no') {
				    pagination = false;
			    }
			
			    var responsiveNumberOfItems1 = 1,
				    responsiveNumberOfItems2 = 2,
				    responsiveNumberOfItems3 = 3;
			
			    if (numberOfItems < 3) {
				    responsiveNumberOfItems1 = numberOfItems;
				    responsiveNumberOfItems2 = numberOfItems;
				    responsiveNumberOfItems3 = numberOfItems;
			    }
			
			    portSlider.owlCarousel({
				    items: numberOfItems,
				    margin: margin,
				    loop: loop,
				    autoplay: true,
				    autoplayTimeout: sliderSpeed,
				    autoplayHoverPause: true,
				    smartSpeed: 800,
				    nav: navigation,
				    navText: [
					    '<span class="qodef-prev-icon"><span class="qodef-icon-arrow icon-arrows-left"></span></span>',
					    '<span class="qodef-next-icon"><span class="qodef-icon-arrow icon-arrows-right"></span></span>'
				    ],
				    dots: pagination,
				    responsive: {
					    0: {
						    items: responsiveNumberOfItems1,
						    stagePadding: 0
					    },
					    600: {
						    items: responsiveNumberOfItems2
					    },
					    768: {
						    items: responsiveNumberOfItems3
					    },
					    1024: {
						    items: numberOfItems
					    }
				    }
			    });
			
			    thisPortSlider.css('opacity', '1');
		    });
	    }
    }

    var qodefPortfolioSingleFollow = function() {

        var info = $('.qodef-follow-portfolio-info .qodef-portfolio-single-holder .qodef-ps-info-sticky-holder');

        if (info.length) {
            var infoHolderOffset = info.offset().top,
                infoHolderHeight = info.height(),
                mediaHolder = $('.qodef-ps-image-holder'),
                mediaHolderHeight = mediaHolder.height(),
                header = $('.header-appear, .qodef-fixed-wrapper'),
                headerHeight = (header.length) ? header.height() : 0;
        }

        var infoHolderPosition = function() {

            if(info.length) {

                if (mediaHolderHeight > infoHolderHeight) {
                    if(qodef.scroll > infoHolderOffset) {
                        var marginTop = qodef.scroll + headerHeight + qodefGlobalVars.vars.qodefAddForAdminBar - infoHolderOffset;
                        // if scroll is initially positioned below mediaHolderHeight
                        if(marginTop + infoHolderHeight > mediaHolderHeight){
                            marginTop = mediaHolderHeight - infoHolderHeight;
                        }
                        info.animate({
                            marginTop: marginTop
                        });
                    }
                }
            }
        };

        var recalculateInfoHolderPosition = function() {

            if (info.length) {
                if(mediaHolderHeight > infoHolderHeight) {
                    if(qodef.scroll > infoHolderOffset) {
                    	
                        if(qodef.scroll + headerHeight + infoHolderHeight <  mediaHolderHeight) {
                            //Calculate header height if header appears
                            if ($('.header-appear, .qodef-fixed-wrapper').length) {
                                headerHeight = $('.header-appear, .qodef-fixed-wrapper').height();
                            }
                            info.stop().animate({
                                marginTop: (qodef.scroll + headerHeight + qodefGlobalVars.vars.qodefAddForAdminBar - infoHolderOffset)
                            });
                            //Reset header height
                            headerHeight = 0;
                        } else{
                            info.stop().animate({
                            	marginTop: mediaHolderHeight - infoHolderHeight
                            });
                        }
                    } else {
                        info.stop().animate({
                            marginTop: 0
                        });
                    }
                }
            }
        };

        return {
            init : function() {
                infoHolderPosition();
                $(window).scroll(function(){
                    recalculateInfoHolderPosition();
                });
            }
        };
    };

})(jQuery);
(function($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;
    woocommerce.qodefOnWindowLoad = qodefOnWindowLoad;
    woocommerce.qodefOnWindowResize = qodefOnWindowResize;
    woocommerce.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
	    qodefInitSingleProductImageSwitchLogic();
		qodefInitSingleProductLightbox();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {}
    
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
    function qodefInitQuantityButtons() {
    
        $(document).on( 'click', '.qodef-quantity-minus, .qodef-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.siblings('.qodef-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('qodef-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger( 'change' );
        });
    }

    /*
    ** Init select2 script for select html dropdowns
    */
    function qodefInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length) {
            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });
        }

        if($('#calc_shipping_country').length) {
            $('#calc_shipping_country').select2();
        }

        if($('.cart-collaterals .shipping select#calc_shipping_state').length) {
            $('.cart-collaterals .shipping select#calc_shipping_state').select2();
        }
    }


	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function qodefInitSingleProductLightbox() {
		var item = $('.qodef-woo-single-page.qodef-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');

		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');

			if (typeof qodef.modules.common.qodefPrettyPhoto === "function") {
				qodef.modules.common.qodefPrettyPhoto();
			}
		}
	}

	
	/*
	 ** Init switch image logic for thumbnail and featured images on product single page
	 */
	function qodefInitSingleProductImageSwitchLogic() {
		if(qodef.body.hasClass('qodef-woo-single-switch-image')){
			
			var thumbnailImage = $('.qodef-woo-single-page .woocommerce-product-gallery__image:not(:first) > a'),
				featuredImage = $('.qodef-woo-single-page .woocommerce-product-gallery__image:first > a');
			
			if(featuredImage.length) {
				featuredImage.on('click', function() {
					if($('div.pp_overlay').length) {
						$.prettyPhoto.close();
					}
					if(qodef.body.hasClass('qodef-disable-thumbnail-prettyphoto')){
						qodef.body.removeClass('qodef-disable-thumbnail-prettyphoto');
					}
					if(featuredImage.children('.qodef-fake-featured-image').length){
						$('.qodef-fake-featured-image').stop().animate({'opacity': '0'}, 300, function() {
							$(this).remove();
						});
					}
				});
			}
			
			if(thumbnailImage.length) {
				thumbnailImage.each(function(){
					var thisThumbnailImage = $(this),
						thisThumbnailImageSrc = thisThumbnailImage.find('img').attr('src');

					thisThumbnailImage.on('click', function() {
						if(!qodef.body.hasClass('qodef-disable-thumbnail-prettyphoto')){
							qodef.body.addClass('qodef-disable-thumbnail-prettyphoto');
						}
						
						if($('div.pp_overlay').length) {
							$.prettyPhoto.close();
						}
						if(thisThumbnailImageSrc !== '' && featuredImage !== '') {
							if (featuredImage.children('.qodef-fake-featured-image').length) {
								$('.qodef-fake-featured-image').remove();
							}
							featuredImage.append('<img itemprop="image" class="qodef-fake-featured-image" src="' + thisThumbnailImageSrc + '" />');
						}
					});
				});
			}
		}
	}

})(jQuery);