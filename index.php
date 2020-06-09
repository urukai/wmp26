<?php
	// Konfiguration einbetten
	include 'config.php';

	// HTML-Anfang einbetten
	include 'kopfbereich.php';


	// Fake-Datensätze
	$werke = [
		[
			'titel' => 'Regen',
			'jahr'	=> 2012,
			'bild'  => 'https://picsum.photos/300/200?grayscale'
		],
		[
			'titel' => 'Cornflakes',
			'jahr' => 1996,
			'bild' => 'https://picsum.photos/300/200?grayscale'
		],
		[
			'titel' => 'Sonnenblumen',
			'jahr' => 2001,
			'bild' => 'https://picsum.photos/300/200?grayscale'
		],
		[
			'titel' => 'Thermaldetonator',
			'jahr' => 2008,
			'bild' => 'https://picsum.photos/300/200?grayscale'
		],
		[
			'titel' => 'Würgeschlange',
			'jahr' => 1985,
			'bild' => 'https://picsum.photos/300/200?grayscale'
		],
		[
			'titel' => 'Champagner',
			'jahr' => 2019,
			'bild' => 'https://picsum.photos/300/200?grayscale'
		]
	];

	// Werke ausgeben
	echo '<ul class="portfolio">';

	foreach( $werke as $nr => $werk ){
		echo '<li>';
		// <img src="https://picsum.photos/300/200?random=123" alt="Irgendwas" class="werk-bild">
		
		printf( '<img src="%s&random=%d" alt="%s" class="werk-bild">', 
			$werk[ 'bild' ],
			$nr,
			$werk[ 'titel' ]
		); 	
		
		printf( '<h2>%s</h2>', 
			$werk[ 'titel' ]	  
		);
		
		/*
		// alternative Schreibweise
		echo '<img src="' . $werk[ 'bild' ] . '&random=' . $nr . '" ';
		echo 'alt="' . $werk[ 'titel' ] . '" class="werk-bild">';
		*/
		
		/*
		// nochmals eine alternative Schreibweise
		echo '<img src="';
		echo $werk[ 'bild' ];
		echo '" alt="';
		echo $werk[ 'titel' ];
		echo '" class="werk-bild">';
		*/
		
		echo '</li>';
	}


	// UL schliessen
	echo '</ul>';
	






	// Fusszeile einbette
	include 'fussbereich.php';

		
	
	
	
	
	
	
	
	
	