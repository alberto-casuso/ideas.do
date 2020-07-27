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