!function($) {
	$( "body" ).on( "click", ".apus-checkbox", function() {
		
			jQuery('.'+this.id).toggle();
		
    });
    $('.apus-wpcolorpicker').each(function(){
    	$(this).wpColorPicker();
    });

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
}(window.jQuery);
