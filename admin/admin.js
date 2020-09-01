// Bei den Löschlinks eine Bestätigung verlangen
const loeschLinks = Array.from( document.getElementsByClassName( 'warnen' ) );

loeschLinks.forEach( ( aElement ) => {
	aElement.addEventListener( 'click', ( ereignis ) => {
		// Bestätigung verlangen, Benutzer klickt auf OK oder ABBRECHEN
		const ok = confirm( 'Ja Oi! Willst du das wirklich?' );
		// in der Variable ok steht nun TRUE (OK geklickt) 
		// oder FALSE (ABBRECHEN geklickt)
		if ( ! ok ) {
			// Das Klicken unterbrechen
			ereignis.preventDefault();
		}
	} );
})


/*
const machKaffee = ( anzahlTassen ) => {
	console.log( 'Bitte mach ' + anzahlTassen + ' Tassen Kaffee.' );
};

function machKafee( anzahlTassen ) {
	console.log( 'Bitte mach ' + anzahlTassen + ' Tassen Kaffee.' );
}

machKaffee( 5 );
*/