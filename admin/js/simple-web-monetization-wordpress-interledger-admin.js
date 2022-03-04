(function( $ ) {
	'use strict';

	/**
	 * Show/hide the custom payment pointer input setting 
	 * depending on user selection of the radio option
	 */

	$( window ).load(function() {
		$('#enter_your_own_custom_payment_pointer_1').parents().eq(1).hide();

		var i = $('input[type=radio][name="simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name[pick_a_payment_pointer_0]"]:checked').val();
    	console.log(i);

		if (i === 'custom') {
			$('#enter_your_own_custom_payment_pointer_1').parents().eq(1).show();
		}

	    $('input[type=radio][name="simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name[pick_a_payment_pointer_0]"]').change(function() {
	    	console.log(this.value);
	        if (this.value === 'custom') {        
	            $('#enter_your_own_custom_payment_pointer_1').parents().eq(1).show();                    
	        } else {        
	            $('#enter_your_own_custom_payment_pointer_1').parents().eq(1).hide();    
	        }
	    });
	});

})( jQuery );
