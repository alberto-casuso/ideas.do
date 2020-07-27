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