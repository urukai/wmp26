<?php
	// Konfiguration einbetten
	include 'config.php';

	// Funktionen einbetten
	include 'functions.php';

	// HTML-Anfang einbetten
	include 'kopfbereich.php';

		// Haupttitel
	echo '<h1>Portfolio</h1>';

	// Werke ausgeben
	echo '<ul class="portfolio">';

	// Werke aus der DB holen
	$res = db( 'SELECT * FROM werke' );

	while( $werk = mysqli_fetch_assoc( $res ) ) {
		/*
		[
			'id' => 42,
			'titel' => 'Ein schönes Bildli',
			'beschrieb' => 'Bla bla bla',
			'bild' => 'https://...',
			'datum' => '2020-06-13'
		]
		*/

		echo '<li>';
		
		// Link zur Einzelansicht
		echo '<a href="werk.php?id=' . $werk[ 'id' ] . '">';
		
		printf( '<img src="%s" alt="%s" class="werk-bild">', 
			$werk[ 'bild' ],
			$werk[ 'titel' ]
		); 	
		
		printf( '<h2>%s</h2>', 
			$werk[ 'titel' ]	  
		);
		
		echo '</a>';
		
		echo '</li>';
	}
	// UL schliessen
	echo '</ul>';

	// Fusszeile einbette
	include 'fussbereich.php';

		
	
	
	
	
	
	
	
	
	