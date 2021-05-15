/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
	
	Modified on 15/5/21 by EncryptEx
*/

'use strict';

;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 9 && this.files.length < 11) {
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
				label.querySelector( 'span' ).innerHTML = fileName;
				label.classList.remove("error");
				label.classList.add("correct");
			} else {
				label.querySelector( 'span' ).innerHTML = "Please select 10 images.";
				label.classList.add("error");
			}
		});

		// Firefox bug fix
		input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
		input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
	});
}( document, window, 0 ));