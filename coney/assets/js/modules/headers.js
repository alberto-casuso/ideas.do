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