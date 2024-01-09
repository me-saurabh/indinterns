(function($) {
	"use strict";
    
    

    var entaroWoo = {
        init: function(){
            var self = this;
            // login register
            self.loginRegister();
            // quickview
            self.quickviewInit();
            //detail
            self.productDetail();
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                self.loadImages();
            });
            
            // load image
            setTimeout(function(){
                self.loadImages();
            }, 300);
            
            
        },
        loginRegister: function(){
            // login/register
            $('body').on( 'click', '.register-login-action', function(e){
                e.preventDefault();
                var href = $(this).attr('href');
                setCookie('entaro_login_register', href, 0.5);
                $('.register_login_wrapper').removeClass('active');
                $(href).addClass('active');
            } );
            $('.login-topbar .login').on('click', function(){
                setCookie('entaro_login_register', '#customer_login', 0.5);
            });
            $('.login-topbar .register').on('click', function(){
                setCookie('entaro_login_register', '#customer_register', 0.5);
            });
        },
        productDetail: function(){
            
            // review click link
            $('.woocommerce-review-link').on('click', function(){
                $('html, body').animate({
                    scrollTop: $("#reviews").offset().top
                }, 1000);
                return false;
            });
        },
        quickviewInit: function(){
            $('a.quickview').on('click', function (e) {
                e.preventDefault();
                var self = $(this);
                self.parent().parent().parent().addClass('loading');
                var product_id = $(this).data('product_id');
                var url = entaro_woo_options.ajaxurl + '?action=entaro_quickview_product&product_id=' + product_id;
                
                $.get(url,function(data,status){
                    $.magnificPopup.open({
                        mainClass: 'apus-mfp-zoom-in apus-quickview',
                        items : {
                            src : data,
                            type: 'inline'
                        }
                    });
                    // variation
                    if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
                        $( '.variations_form' ).each( function() {
                            $( this ).wc_variation_form().find('.variations select:eq(0)').trigger('change');
                        });
                    }

                    var config = {
                        infinite: true,
                        arrows: true,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    };
                    $(".quickview-slick").slick( config );

                    self.parent().parent().parent().removeClass('loading');
                });
            });
        },
        loadImages: function() {
            var self = this;
            $(window).off('scroll.unveil resize.unveil lookup.unveil');
            var $images = $('body').find('.product-image:not(.image-loaded) .unveil-image');
            
            if ($images.length) {
                $images.unveil(1, function() {
                    $(this).load(function() {
                        $(this).parents('.product-image').first().addClass('image-loaded');
                    });
                });
            }
        }
    };

    entaroWoo.init();

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