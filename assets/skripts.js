/**
 * Javascript für unsere Website
 * 
 * Referenzen auf den Hamburger und die Hauptnavigation
 */
const hamburger = document.querySelector( '.hamburger' );
const navigation = document.querySelector( '.hauptnavigation' );

// Auf dem Hamburger das Klick-Ereignis abfangen
hamburger.addEventListener( 'click', () => {
	// der Hauptnavigation und dem Hamburger CSS-Klassen hinzufügen
	// oder entfernen
	navigation.classList.toggle( 'sichtbar' );
	hamburger.classList.toggle( 'navigation-offen' );
});