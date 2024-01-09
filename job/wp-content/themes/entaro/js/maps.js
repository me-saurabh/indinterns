(function($) {
    "use strict";
    if (!$.apusThemeExtensions)
        $.apusThemeExtensions = {};

    function ApusThemeCore() {
        var self = this;
        self.init();
    };

    var map, markers, CustomHtmlIcon;

    ApusThemeCore.prototype = {
        /**
         *  Initialize scripts
         */
        init: function() {
            var self = this;

            if ($('#apus-listing-map').length) {
                L.Icon.Default.imagePath = 'wp-content/themes/entaro/images/';
            }
            
            setTimeout(function(){
                self.mapInit();    
            }, 50);

        },
        mapInit: function() {
            var self = this;

            var $window = $(window);

            if (!$('#apus-listing-map').length) {
                return;
            }

            map = L.map('apus-listing-map', {
                scrollWheelZoom: false
            });

            markers = new L.MarkerClusterGroup({
                showCoverageOnHover: false
            });

            CustomHtmlIcon = L.HtmlIcon.extend({
                options: {
                    html: "<div class='map-popup'></div>",
                    iconSize: [48, 59],
                    iconAnchor: [24, 59],
                    popupAnchor: [0, -59]
                }
            });

            $window.on('pxg:refreshmap', function() {
                map._onResize();
                setTimeout(function() {
                    map.fitBounds(markers, {
                        padding: [50, 50]
                    });
                }, 100);
            });

            $window.on('pxg:simplerefreshmap', function() {
                map._onResize();
            });

            
            if ( entaro_listing_opts.custom_style != '' ) {
                try {
                   var custom_style = $.parseJSON(entaro_listing_opts.custom_style);
                   var tileLayer = new L.Google('ROADMAP', {}, custom_style );
                } catch(err) {
                    var tileLayer = new L.Google('ROADMAP');
                }
            } else {
                var tileLayer = new L.Google('ROADMAP');
            }
            $('#apus-listing-map').addClass('map--google');


            map.addLayer(tileLayer);

            self.updateMakerCards();
        },
        updateMakerCards: function($total_found, $result) {
            var self = this;
            var $items = $('.job_listings_cards .jobs-listing-card');
            
            if (!$items.length) {
                return;
            }

            if ($('#apus-listing-map').length && typeof map !== "undefined") {
                map.removeLayer(markers);
                markers = new L.MarkerClusterGroup({
                    showCoverageOnHover: false
                });
                $items.each(function(i, obj) {
                    self.addMakerToMap($(obj), true);
                });
                map.fitBounds(markers, {
                    padding: [50, 50]
                });

                map.addLayer(markers);
            }
        },
        addMakerToMap: function($item, archive) {
            var self = this;
            var marker;

            if ( $item.data('latitude') == "" || $item.data('longitude') == "") {
                return;
            }
            
            var mapPinHTML = "<div class='map-popup'><div class='icon-cat'><img src='" + entaro_listing_opts.pin_img + "' alt=''></div></div>";

            marker = L.marker([$item.data('latitude'), $item.data('longitude')], {
                icon: new CustomHtmlIcon({ html: mapPinHTML })
            });

            if (typeof archive !== "undefined") {

                $item.hover(function() {
                    $(marker._icon).find('.map-popup').addClass('map-popup-selected');
                }, function() {
                    $(marker._icon).find('.map-popup').removeClass('map-popup-selected');
                });

                var title_html = '';
                if ( $item.find('.listing-title').length ) {
                    title_html = "<div class='listing-title'>" + $item.find('.listing-title').html() + "</div>";
                }
                var address_html = '';
                if ( $item.find('.listing-address').length ) {
                    address_html = "<div class='listing-address'>" + $item.find('.listing-address').html() + "</div>";
                }
                marker.bindPopup(
                    "<div class='job-grid-style job_listing'>" +
                        "<div class='listing-title-wrapper'>" + title_html + address_html + "</div>" +
                    "</div>").openPopup();
            }

            markers.addLayer(marker);

            self.layzyLoadImage();
        },
        layzyLoadImage: function() {
            $(window).off('scroll.unveil resize.unveil lookup.unveil');
            var $images = $('.image-wrapper:not(.image-loaded) .unveil-image'); // Get un-loaded images only
            if ($images.length) {
                $images.unveil(1, function() {
                    $(this).load(function() {
                        $(this).parents('.image-wrapper').first().addClass('image-loaded');
                        $(this).removeAttr('data-src');
                        $(this).removeAttr('data-srcset');
                        $(this).removeAttr('data-sizes');
                    });
                });
            }
        }
    };

    $.apusThemeCore = ApusThemeCore.prototype;
    
    $(document).ready(function() {
        // Initialize script
        new ApusThemeCore();

    });

})(jQuery);
