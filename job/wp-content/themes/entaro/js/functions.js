(function ($) {
    "use strict";
    $.fn.wrapStart = function(numWords){
        return this.each(function(){
            var $this = $(this);
            var node = $this.contents().filter(function(){
                return this.nodeType == 3;
            }).first(),
            text = node.text().trim(),
            first = text.split(' ', 1).join(" ");
            if (!node.length) return;
            node[0].nodeValue = text.slice(first.length);
            node.before('<b>' + first + '</b>');
        });
    }; 

    jQuery(document).ready(function() {
        $('.mod-heading .widget-title > span').wrapStart(1);
        function init_slick(self) {
            self.each( function(){
                var config = {
                    infinite: false,
                    arrows: $(this).data( 'nav' ),
                    dots: $(this).data( 'pagination' ),
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    prevArrow:"<button type='button' class='slick-arrow slick-prev pull-left'></span><span class='textnav'><i class='fa fa-arrow-circle-o-left' aria-hidden='true'></i></span></button>",
                    nextArrow:"<button type='button' class='slick-arrow slick-next pull-right'><span class='textnav'><i class='fa fa-arrow-circle-o-right' aria-hidden='true'></i></span></button>",
                };
            
                var slick = $(this);
                if( $(this).data('items') ){
                    config.slidesToShow = $(this).data( 'items' );
                    config.slidesToScroll = $(this).data( 'items' );
                }
                if( $(this).data('infinite') ){
                    config.infinite = true;
                }
                if( $(this).data('rows') ){
                    config.rows = $(this).data( 'rows' );
                }
                if( $(this).data('asnavfor') ){
                    config.asNavFor = $(this).data( 'asnavfor' );
                }
                if( $(this).data('slidestoscroll') ){
                    config.slidesToScroll = $(this).data( 'slidestoscroll' );
                }
                if( $(this).data('focusonselect') ){
                    config.focusOnSelect = $(this).data( 'focusonselect' );
                }
                if ($(this).data('large')) {
                    var desktop = $(this).data('large');
                } else {
                    var desktop = config.items;
                }
                if ($(this).data('medium')) {
                    var medium = $(this).data('medium');
                } else {
                    var medium = config.items;
                }
                if ($(this).data('smallmedium')) {
                    var smallmedium = $(this).data('smallmedium');
                } else {
                    var smallmedium = 2;
                }
                if ($(this).data('extrasmall')) {
                    var extrasmall = $(this).data('extrasmall');
                } else {
                    var extrasmall = 1;
                }
                config.responsive = [
                    {
                        breakpoint: 321,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: extrasmall,
                            slidesToScroll: extrasmall,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: smallmedium,
                            slidesToScroll: smallmedium
                        }
                    },
                    {
                        breakpoint: 981,
                        settings: {
                            slidesToShow: medium,
                            slidesToScroll: medium
                        }
                    },
                    {
                        breakpoint: 1501,
                        settings: {
                            slidesToShow: desktop,
                            slidesToScroll: desktop
                        }
                    }
                ];
                if ( $('html').attr('dir') == 'rtl' ) {
                    config.rtl = true;
                }

                $(this).slick( config );

            } );
        }
        init_slick($("[data-carousel=slick]"));
        
        $('body').on('click', '.apus-woocommerce-product-gallery-thumbs .woocommerce-product-gallery__image a', function(e){
            e.preventDefault();

        });
        // Fix owl in bootstrap tabs
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
            var $slick = $("[data-carousel=slick]", target);

            if ($slick.length > 0 && $slick.hasClass('slick-initialized')) {
                $slick.slick('refresh');
            }
            initProductImageLoad();
        });

        // loading ajax
         $('body').on('click', '[data-load="ajax"] a', function(e){
            e.preventDefault();
            var $href = $(this).attr('href');

            $(this).parent().parent().find('li').removeClass('active');
            $(this).parent().addClass('active');

            var self = $(this);
            var main = $($href);
            if ( main.length > 0 ) {
                if ( main.data('loaded') == false ) {
                    main.parent().addClass('loading');
                    main.data('loaded', 'true');

                    $.ajax({
                        url: entaro_ajax.ajaxurl,
                        type:'POST',
                        dataType: 'html',
                        data:  'action=entaro_ajax_get_products&settings=' + main.data('settings') + '&tab=' + main.data('tab')
                    }).done(function(reponse) {
                        main.html( reponse );
                        main.parent().removeClass('loading');
                        main.parent().find('.tab-pane').removeClass('active');
                        main.addClass('active');

                        if ( main.find('.slick-carousel') ) {
                            init_slick(main.find('.slick-carousel'));
                        }
                        initProductImageLoad();
                    });
                    return true;
                } else {
                    main.parent().removeClass('loading');
                    main.parent().find('.tab-pane').removeClass('active');
                    main.addClass('active');
                }
            }
        });
        
        setTimeout(function(){
            initProductImageLoad();
        }, 500);
        function initProductImageLoad() {
            $(window).off('scroll.unveil resize.unveil lookup.unveil');
            var $images = $('.image-wrapper:not(.image-loaded) .unveil-image'); // Get un-loaded images only
            if ($images.length) {
                $images.unveil(1, function() {
                    $(this).load(function() {
                        $(this).parents('.image-wrapper').first().addClass('image-loaded');
                    });
                });
            }

            var $images = $('.product-image:not(.image-loaded) .unveil-image'); // Get un-loaded images only
            if ($images.length) {
                $images.unveil(1, function() {
                    $(this).load(function() {
                        $(this).parents('.product-image').first().addClass('image-loaded');
                    });
                });
            }
        }
        
        //counter up
        if($('.counterUp').length > 0){
            $('.counterUp').counterUp({
                delay: 10,
                time: 800
            });
        }
        /*---------------------------------------------- 
         * Play Isotope masonry
         *----------------------------------------------*/  
        jQuery('.isotope-items').each(function(){  
            var $container = jQuery(this);
            
            setTimeout( function(){
                $container.isotope({
                    itemSelector : '.isotope-item',
                    transformsEnabled: true,         // Important for videos
                    masonry: {
                        columnWidth: $container.data('columnwidth')
                    }
                }); 
            }, 100 );
        });
        /*---------------------------------------------- 
         *    Apply Filter        
         *----------------------------------------------*/
        jQuery('.isotope-filter li a').on('click', function(){
           
            var parentul = jQuery(this).parents('ul.isotope-filter').data('related-grid');
            jQuery(this).parents('ul.isotope-filter').find('li a').removeClass('active');
            jQuery(this).addClass('active');
            var selector = jQuery(this).attr('data-filter'); 
            jQuery('#'+parentul).isotope({ filter: selector }, function(){ });
            
            return(false);
        });

        //Sticky Header
        setTimeout(function(){
            change_margin_top();
        }, 50);
        $(window).resize(function(){
            change_margin_top();
        });
        function change_margin_top() {
            if ($(window).width() > 991) {
                if ( $('.main-sticky-header').length > 0 ) {
                    var header_height = $('.main-sticky-header').outerHeight();
                    $('.main-sticky-header-wrapper').css({'height': header_height});
                }
            }
        }
        var main_sticky = $('.main-sticky-header');
        setTimeout(function(){
            if ( main_sticky.length > 0 ){
                var _menu_action = main_sticky.offset().top;

                var Apus_Menu_Fixed = function(){
                    "use strict";

                    if( $(document).scrollTop() > _menu_action ){
                        main_sticky.addClass('sticky-header');
                    }else{
                        main_sticky.removeClass('sticky-header');
                    }
                }
                if ($(window).width() > 991) {
                    $(window).scroll(function(event) {
                        Apus_Menu_Fixed();
                    });
                    Apus_Menu_Fixed();
                }
            }
        }, 50);

        //Tooltip
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })

        $('.topbar-mobile .dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });

        var back_to_top = function () {
            jQuery(window).scroll(function () {
                if (jQuery(this).scrollTop() > 400) {
                    jQuery('#back-to-top').addClass('active');
                } else {
                    jQuery('#back-to-top').removeClass('active');
                }
            });
            jQuery('#back-to-top').on('click', function () {
                jQuery('html, body').animate({scrollTop: '0px'}, 800);
                return false;
            });
        };
        back_to_top();
        
        // popup
        $(".popup-image").magnificPopup({type:'image'});
        $('.popup-video').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        
        $('.resume-manager-portfolio').each(function(){
            var tagID = $(this).attr('id');
            $('#' + tagID).magnificPopup({
                delegate: '.popup-image-gallery',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                }
            });
        });

        $('.widget-gallery').each(function(){
            var tagID = $(this).attr('id');
            $('#' + tagID).magnificPopup({
                delegate: '.popup-image-gallery',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                }
            });
        });
        

        // perfectScrollbar
        $('.main-menu-top').perfectScrollbar();
        // preload page
        if ( $('body').hasClass('apus-body-loading') ) {
            $('body').removeClass('apus-body-loading');
            $('.apus-page-loading').fadeOut(250);
        }

        // gmap 3
        $('.apus-google-map').each(function(){
            var lat = $(this).data('lat');
            var lng = $(this).data('lng');
            var zoom = $(this).data('zoom');
            var id = $(this).attr('id');
            if ( $(this).data('marker_icon') ) {
                var marker_icon = $(this).data('marker_icon');
            } else {
                var marker_icon = '';
            }
            $('#'+id).gmap3({
                map:{
                    options:{
                        "draggable": true
                        ,"mapTypeControl": true
                        ,"mapTypeId": google.maps.MapTypeId.ROADMAP
                        ,"scrollwheel": false
                        ,"panControl": true
                        ,"rotateControl": false
                        ,"scaleControl": true
                        ,"streetViewControl": true
                        ,"zoomControl": true
                        ,"center":[lat, lng]
                        ,"zoom": zoom
                        ,'styles': $(this).data('style')
                    }
                },
                marker:{
                    latLng: [lat, lng],
                    options: {
                        icon: marker_icon,
                    }
                }
            });
        });

        // popup newsletter
        setTimeout(function(){
            var hiddenmodal = getCookie('hiddenmodal');
            if (hiddenmodal == "") {
                jQuery('#popupNewsletterModal').modal('show');
            }
        }, 3000);
        $('#popupNewsletterModal').on('hidden.bs.modal', function () {
            setCookie('hiddenmodal', 1, 30);
        });
        // top-percent
        setTimeout(function(){
            if ( $('.top-percent').length > 0 ) {
                var header_height = $('.top-percent').outerHeight();
                $('.top-percent').css({'margin-top': - header_height,'overflow':'visible' });
            }
        }, 50);
        

        // mmenu
        var mobilemenu = $("#navbar-offcanvas").mmenu({
            offCanvas: true,
        }, {
            // configuration
            offCanvas: {
                pageSelector: "#wrapper-container"
            }
        });

        // sidebar mobile
        setTimeout(function(){
            if ( $("#mobile-offcanvas-sidebar .mobile-sidebar-wrapper").length > 0 ) {
                $( ".sidebar-left, .sidebar-right" ).clone().appendTo( "#mobile-offcanvas-sidebar .mobile-sidebar-wrapper" );
            }
        }, 100);

        $('.mobile-sidebar-wrapper').perfectScrollbar();

         $('body').on('click', '.mobile-sidebar-btn', function(){
            
            $('#mobile-offcanvas-sidebar').toggleClass('active');
            var overlay_left = $('#mobile-offcanvas-sidebar').width();
            
            if ( $('#mobile-offcanvas-sidebar').hasClass('active') ) {
                if ( $('#mobile-offcanvas-sidebar').hasClass('mobile-offcanvas-left') ) {
                    var translate_w_rtl = '-'+overlay_left+'px';
                    var translate_w = overlay_left+'px';
                } else {
                    var translate_w = '-'+overlay_left+'px';
                    var translate_w_rtl = overlay_left+'px';
                }
                if ( $('html').attr('dir') == 'rtl' ) {
                    $('#wrapper-container').css({
                        'transform': 'translate3d('+translate_w_rtl+', 0px, 0px)'
                    });
                } else {
                    $('#wrapper-container').css({
                        'transform': 'translate3d('+translate_w+', 0px, 0px)'
                    });
                }
            } else {
                $('#wrapper-container').attr('style', '');
            }
            $('.mobile-sidebar-panel-overlay').toggleClass('active');
        });
         $('body').on('click', '.mobile-sidebar-panel-overlay', function(){
            $('#mobile-offcanvas-sidebar').removeClass('active');
            $('.mobile-sidebar-panel-overlay').removeClass('active');
            $('#wrapper-container').attr('style', '');
        });

        $(document.body).on('click', '.nav [data-toggle="dropdown"]' ,function(){
            if(  this.href && this.href != '#'){
                window.location.href = this.href;
            }
        });
        // search header
         $('body').on('click', '.search-header .icon-search,.search-header .over-click', function(event){
            event.preventDefault();
            $('.search-header .widget-search').toggleClass('active');
            $('.search-header .icon-search').toggleClass('active');
            $('.search-header .over-click').toggleClass('active');
        });
        // resume_contact
         $('body').on('click', '.resume_contact .btn-showcontact', function(event){
            event.preventDefault();
            $('.resume_contact .resume_contact_details').toggle('show');
        });
        // find map
        var apusentaro = {
            init: function() {
                var self = this;
                self.initializeMap();

                $('.job_listings').on('updated_results', function(e, result) {
                    initProductImageLoad();

                    $('.showing_jobs .results, .listing-search-result .results, .listing-search-result-filter .results').remove();
                    
                    if (typeof result !== 'undefined' && result.showing !== '' && result.showing_links !== '') {
                        $('<div class="results">' +
                            result.showing + ' ' +
                            result.showing_links +
                            '</div>').prependTo('.listing-search-result-filter');
                    }

                    $('[data-toggle="tooltip"]').tooltip(); 
                });
                $( '.resumes' ).on( 'updated_results', function( e, result ) {
                    initProductImageLoad();
                    $('.resumes .results, .resume-search-result-filter .results').remove();
                    
                    if (typeof result !== 'undefined' && result.showing !== '' && result.showing_links !== '') {
                        $('<div class="results">' +
                            result.showing + ' ' +
                            result.showing_links +
                            '</div>').prependTo('.resume-search-result-filter');
                    }

                    $('[data-toggle="tooltip"]').tooltip(); 
                });

                var $displayMode = $('.listing-display-mode .display-mode .change-view'),
                    updateDisplayMode = function() {
                         $('body').on('click', '.listing-display-mode .display-mode .change-view', function(e){
                            e.preventDefault();
                            var value = $(this).data('mode');
                            $('.input_display_mode').val(value);
                            $displayMode.removeClass('active');
                            $(this).addClass('active');
                            

                            if ( $('.job_listings').length > 0 ) {
                                setCookie('entaro_display_mode', value, 30);
                                $('.job_listings').triggerHandler('update_results', [1, false]);
                            } else if ( $('.resumes').length > 0 ) {
                                setCookie('entaro_resume_display_mode', value, 30);
                                $('.resumes').triggerHandler('update_results', [1, false]);
                            }
                        });
                    },
                    updateOrderBy = function() {
                        $('.listing-orderby select').on('change', function(){
                            var value = $(this).val();
                            $('.input_filter_oder').val(value);

                            if ( $('.job_listings').length > 0 ) {
                                setCookie('entaro_order', value, 30);
                                $('.job_listings').triggerHandler('update_results', [1, false]);
                            } else if ( $('.resumes').length > 0 ) {
                                setCookie('entaro_resume_order', value, 30);
                                $('.resumes').triggerHandler('update_results', [1, false]);
                            }
                        });
                    };
                updateDisplayMode();
                updateOrderBy();

                $.fn.bindFirst = function(name, selector, fn) {
                    // bind as you normally would
                    // don't want to miss out on any jQuery magic
                    this.on(name, selector, fn);

                    // Thanks to a comment by @Martin, adding support for
                    // namespaced events too.
                    this.each(function() {
                        var handlers = $._data(this, 'events')[name.split('.')[0]];
                        // take out the handler we just inserted from the end
                        var handler = handlers.pop();
                        // move it at the beginning
                        handlers.splice(0, 0, handler);
                    });
                };

                $('.job_filters').bindFirst('click', '.reset', function() {

                    $('.regions-select').find(':selected').each(function(i, obj) {
                        $(obj).attr('selected', false);
                    });
                    $('.regions-select').trigger("change.select2");
                    
                    $('input[name="search_keywords"]').each(function(i, obj) {
                        $(obj).val('').trigger('change.select2');
                    });
                });
                // chosen
                if ( $.isFunction( $.fn.select2 ) ) {

                    $( 'select[name^="job_region_select"]' ).select2();
                    $( 'select[name^="job_regions"]' ).select2();
                    
                    $( 'select[name^="job_type_select"]' ).select2();
                    
                    $( 'select[name^="search_categories"]' ).select2();

                    $( 'select[name^="job_type"]' ).select2();
                }
                $('.job_filters select[name=job_region_select]').on('change', function(){
                    $('.job_listings').triggerHandler( 'update_results', [ 1, false ] );
                    
                });
            },
            initializeMap: function() {
                if ( $('.entaro-location-field').length > 0 ) {
                    var mapInstance = $('.entaro-location-field');
                    var searchInput = mapInstance.find( '.input-location-field' );
                    var latitude = mapInstance.find( '.geo_latitude' );
                    var longitude = mapInstance.find( '.geo_longitude' );

                    // Search
                    var autocomplete = new google.maps.places.Autocomplete( searchInput[0] );

                    google.maps.event.addListener( autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        if ( ! place.geometry ) {
                            return;
                        }

                        latitude.val( place.geometry.location.lat() );
                        longitude.val( place.geometry.location.lng() );

                        latitude.attr('value', place.geometry.location.lat());
                        longitude.attr('value', place.geometry.location.lng());
                    });

                    $( searchInput ).keypress( function( event ) {
                        if ( 13 === event.keyCode ) {
                            event.preventDefault();
                        }
                    });

                }
            },
        }
        apusentaro.init();

        function getLocation(position) {
            $('.geo_latitude').val(position.coords.latitude);
            $('.geo_longitude').val(position.coords.longitude);
            $('.input-location-field').val('Location');
            $('.geo_longitude').trigger('change');
            
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            if (geocoder) {
                geocoder.geocode({ 'latLng': latLng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $('.input-location-field').val(results[0].formatted_address);
                    }
                });
            }
            return $('.find-me-location').removeClass('loading');
        }
        function getErrorLocation(position) {
            return $('.find-me-location').removeClass('loading');
        }
        $('body').on('click', '.find-me-location', function() {
            $(this).addClass('loading');
            navigator.geolocation.getCurrentPosition(getLocation, getErrorLocation);
        });


        function searchFindMegetLocation(position) {
            $('#search_lat').val(position.coords.latitude);
            $('#search_lng').val(position.coords.longitude);
            $('#search_location').val('Location');

            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            if (geocoder) {
                geocoder.geocode({ 'latLng': latLng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        $('#search_location').val(results[0].formatted_address);

                        setTimeout(function(){
                            if ( $('.job_listings').length > 0 ) {
                                $('.job_listings').triggerHandler('update_results', [1, false]);
                            } else if ( $('.resumes').length > 0 ) {
                                $('.resumes').triggerHandler('update_results', [1, false]);
                            }
                        }, 50);
                    }
                });
            }
            
            return $('.find-me').removeClass('loading');
        }
        function searchFindMeGetErrorLocation(position) {
            return $('.find-me').removeClass('loading');
        }
        $('body').on('click', '.find-me', function() {
            $(this).addClass('loading');
            navigator.geolocation.getCurrentPosition(searchFindMegetLocation, searchFindMeGetErrorLocation);
        });


        // Bookmark Job
        $( "body" ).on( "click", ".apus-favorite-add", function( e ) {
            e.preventDefault();
            if ( $(this).hasClass('loading') ) {
                return false;
            }
            var self = $(this);
            self.addClass('loading');
            var post_id = self.data('id');
            var url = entaro_ajax.ajaxurl + '?action=entaro_add_favorite&post_id=' + post_id;
            
            $.ajax({
                url: url,
                type:'POST',
                dataType: 'json',
            }).done(function(reponse) {
                self.removeClass('apus-favorite-add').removeClass('loading').addClass('apus-favorite-added');
                self.find('i').removeClass('fa-heart-o').addClass('fa-heart');
            });
        });

        $( "body" ).on( "click", ".apus-favorite-not-login", function( e ) {
            e.preventDefault();
            $.magnificPopup.open({
                mainClass: 'apus-mfp-zoom-small-in',
                items    : {
                    src : '<div class="apus-favorite-need-login">' + $('.apus-favorite-login-info').html() + '</div>',
                    type: 'inline'
                }
            });
        });
        // favorite remove
        $( "body" ).on( "click", ".apus-favorite-remove", function( e ) {
            e.preventDefault();
            var self = $(this);
            self.addClass('loading');
            
            var post_id = $(this).data('id');
            var url = entaro_ajax.ajaxurl + '?action=entaro_remove_favorite&post_id=' + post_id;
            $.ajax({
                url: url,
                type:'POST',
                dataType: 'json',
            }).done(function(reponse) {
                if (reponse.status) {
                    var parent = $('#favorite-property-' + post_id).parent();
                    if ( $('.favorite-item', parent).length <= 1 ) {
                        location.reload();
                    } else {
                        $('#favorite-property-' + post_id).remove();
                    }
                } else {
                    $.magnificPopup.open({
                        mainClass: 'apus-mfp-zoom-small-in',
                        items: {
                            src : reponse.msg,
                            type: 'inline'
                        }
                    });
                }
            });
        });

        // view more for filter
        $('.widget-job-taxonomy ul').each(function(e){
            var height = $(this).outerHeight();
            if ( height > 260 ) {
                var view_more = '<a href="javascript:void(0);" class="view-more-list view-more"><span>'+entaro_ajax.view_more_text+'</span> <i class="fa fa-angle-double-right"></i></a>';
                $(this).parent().append(view_more);
                $(this).addClass('hideContent');
            }
        });

        $('body').on('click', '.view-more-list', function() {
           
            var $this = $(this); 
            var $content = $this.parent().find("ul"); 
            
            if ( $this.hasClass('view-more') ) {
                var linkText = entaro_ajax.view_less_text;
                $content.removeClass("hideContent").addClass("showContent");
                $this.removeClass("view-more").addClass("view-less");
            } else {
                var linkText = entaro_ajax.view_more_text;
                $content.removeClass("showContent").addClass("hideContent");
                $this.removeClass("view-less").addClass("view-more");
            };

            $this.find('span').text(linkText);
        });

        // search job

        $('body').on('click', '.widget-search-form .show-search', function() {
            var $this = $(this); 
            $this.parent().toggleClass('of');
            if ( $('.show-search i').hasClass('fa-angle-left') ) {
                $('.show-search i').removeClass('fa-angle-left').addClass("fa-angle-right");
            }else{
                $('.show-search i').removeClass('fa-angle-right').addClass("fa-angle-left");
            }
        });
        if ($(window).width() < 1200) {
            $('.widget-search-form.p_fix').addClass('of');
        }
    });
    
})(jQuery)

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

if (typeof google === 'object' && typeof google.maps === 'object') {
    function search_location_initialize() {
            
        var input = document.getElementById('search_location');
        if (input === null)  {
            return;
        }
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setTypes([]);

        autocomplete.addListener( 'place_changed', function () {
            var place = autocomplete.getPlace();
            place.toString();
            console.log(place);
            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }
            document.getElementById('search_lat').value = place.geometry.location.lat();
            document.getElementById('search_lng').value = place.geometry.location.lng();

            if ( jQuery('.job_listings').length > 0 ) {
                jQuery('.job_listings').triggerHandler('update_results', [1, false]);
            } else if ( jQuery('.resumes').length > 0 ) {
                jQuery('.resumes').triggerHandler('update_results', [1, false]);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', search_location_initialize);
    
}