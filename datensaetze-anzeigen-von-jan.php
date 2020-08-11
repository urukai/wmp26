<?php
	// Konfiguration einbetten
	include 'config.php';
	// Funktionen einbetten
	include 'functions.php';

	// Eintraege aus der DB holen
	$res = db( 'SELECT * FROM sponsoren' );

	while( $eintrag = mysqli_fetch_assoc( $res ) ) {
		// TITEL ANZEIGEN
		echo '<h2>';
		echo $eintrag[ 'firma' ];
		echo '</h2>';
		// DATUM ANZEIGEN
		echo '<p>';
		echo $eintrag[ 'datum' ];
		echo '</p>';
		// LINK ANZEIGEN
		echo '<a href="';
		echo $eintrag[ 'url' ];
		echo '" target="_blank">';
		echo ' Hier der Link ';
		echo '</a>';
		// BILD ANZEIGEN
		echo '<img src="';
		echo $eintrag[ 'bild' ];
		echo '" class="detailbild" >';
		
	}


		