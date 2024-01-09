(function () {
	jQuery(document).ready(function($) {
		$('body').delegate(".input_datetime", 'mouseenter', function(e){
            e.preventDefault();
            $(this).datepicker({
	               defaultDate: "",
	               dateFormat: "yy-mm-dd",
	               numberOfMonths: 1,
	               showButtonPanel: true,
            });
        });
	});	
} )( jQuery );