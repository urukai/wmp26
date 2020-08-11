<?php

	/**
	 * Eigene Funktion, die ein SQL-Statement an die DB schickt und uns den Zeiger
	 * auf das Resultat zurückliefert. Die Zugangsdaten sind im config.php als 
	 * konstante Werte definiert.
	 */

	function db( $sqlStatement ) {
		// Verbindung zur DB herstellen
		$verbindung = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ) 
			or die( 'Keine Verbindung zur DB' );
		// Zeichenkodierung der Datenübertragung einstellen
		mysqli_set_charset( $verbindung, 'UTF8' );
		// Anfrage schicken
		$zeiger = mysqli_query( $verbindung, $sqlStatement );
		// Verbindung schliessen
		mysqli_close( $verbindung );
		// Zeiger zurückliefern
		return $zeiger;
	}




	/*

	function machTee( $anzahl, $mitMilch = TRUE ) {
		echo 'Bitte ' . $anzahl . ' Tassen Tee';
		if( $mitMilch ) {
			echo ' mit Milch';
		}
	}



	machTee( 2 );
	machTee( 42, FALSE );


	function addieren( $zahl1, $zahl2 ) {
		$summe = $zahl1 + $zahl2;

		return $summe;
	}



	$x = addieren( 5, 3 );
	
	$summe;



	function sagWas( $irgendwas ) {
		echo $irgendwas;
	}
	
	sagWas( 'Hallo Jan' );
	sagWas( 'Bakteriophagen' );
	sagWas( 'Sechskantschlüssel' );
	
	
	briefAnrede( 'Simon', 'm')
	
	



*/











