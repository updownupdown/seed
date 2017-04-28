jQuery(document).ready(function($){

	// Gravity Fields
	var gravityFields = $('.gfield input[type="text"], .gfield input[type="email"], .gfield input[type="password"], .gfield input[type="tel"], .gfield textarea');

	var gravityFieldsInputs = $('input[type="text"], input[type="email"], input[type="password"], input[type="tel"], textarea');


	// Check Field Values
	function checkFieldValue(gfield){
		if( gfield.val() === '' || gfield.val() == '(___) ___-____' ){
			gfield.parents('.gfield').addClass('empty').removeClass('full');
		} else {
			gfield.parents('.gfield').addClass('full').removeClass('empty');
		}
	}


	// Clone Labels
	$('.gfield_label').each(function(){

		if( $(this).parents('.gfield').find(gravityFieldsInputs).length ){

			$(this).parents('.gfield').addClass('md-field');
			$(this).clone().addClass('clone').appendTo( $(this).siblings('.ginput_container') );
			$(this).addClass('original');
			checkFieldValue( $(this).parents('.gfield').find(gravityFields) );

		}

	});


	// Inputs Focus In/Out
	gravityFields.focus(function(){
		$(this).parents('.gfield').addClass('focused');
		checkFieldValue( $(this) );
	}).focusout(function(){
		$(this).parents('.gfield').removeClass('focused');
		checkFieldValue( $(this) );
	});

});
