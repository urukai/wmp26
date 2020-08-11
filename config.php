<?php

	/**
	 * Konfigurationsdatei
	 * --------------------------------
	 * Enthält wichtige Einstellungen für 
	 * die ganze Website
	 *
	 */

	// sprachlich-regionale Einstellung auf deutsch/ch einstellen
	setlocale( LC_ALL, 'de_DE.UTF-8' );



	$config = [
		'seitenTitel' => 'Meine Super-Website',
		'version' 	  => '1.0.0',
		'navigation'  => [
			'index' 	 => 'Starseite',
			'ueber-mich' => 'Über mich',
			'kontakt' 	 => 'Kontakt'
		],
		'anredeFormen' => [
			'Frau', 'Herr', 'anderes'
		]
	];


	// Datenbankzugang als Konstanten definieren
	define( 'DB_HOST', 'localhost' );
	define( 'DB_USER', 'simon' );
	define( 'DB_PASSWORD', 'gugus123' );
	define( 'DB_NAME', 'db_wmp26_uruk' );












