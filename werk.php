<?php

	include 'config.php';
	include 'functions.php';

	// Gelieferte ID in der Adresszeile entgegennehmen
	// Es steht z.B. drin: "https://www.irgendwas.ch/werk.php?id=42"
	$id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
	
	// entsprechendes Werk aus der DB holen
	$res = db( 'SELECT * FROM werke WHERE id=' . $id );
	$werk = mysqli_fetch_assoc( $res );
	/*
		[
			id => 42,
			titel => 'Mein Superbild',
			beschrieb => 'blablababl',
			bild => 'https://..',
			datum => '2020-08-11 12:45:03'
		]
	
	
	*/


	include 'kopfbereich.php';

	echo '<article>';

	// Titel
	echo '<h1>' . $werk[ 'titel' ] . '</h1>';

	echo '<p>';
	// änn-äll-tu-beeärr: harte Zeilenschläge in BR-Elemente umwandeln
	echo nl2br( $werk[ 'beschrieb' ] );
	echo '</p>';

	// Bild, verpackt in ein schlaues Bild-Kästchen
	echo '<figure>';
	// <img src="
	echo '<img src="';
	// <img src="https://www.example.com/mein-bild.jpg
	echo $werk[ 'bild' ];
	// <img src="https://www.example.com/mein-bild.jpg" alt="">
	echo '" alt="">';
	echo '</figure>';

	// Datum
	echo '<p>';
	// Zeitwert in Sekunden seit dem 1.1.1970 umwandeln
	$sekunden = strtotime( $werk[ 'datum' ] );
	// Diesen Zeitwert schön formatieren
	// Donnerstag, 5. März 2067
	// vgl. config.php
	echo strftime( '%A, %e. %B %Y', $sekunden );

	echo '</p>';

	



	echo '</article>';
	


	include 'fussbereich.php';