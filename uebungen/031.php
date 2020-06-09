<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>031</title>
</head>

<body>
	<?php
		// Array defineren
		$lieblingsEssen = [
			'Pizza',
			'Spaghetti',
			'Broccoli'
		];
	
		// Elemente zählen
		$anzahl = count( $lieblingsEssen );
		// Letzter Index berechnen: immer eins kleiner als die Anzahl
		$letzterIndex = $anzahl - 1;
	
		foreach( $lieblingsEssen as $nr => $speise ) {
			echo $speise;
			// Schreiben wir NICHT die letzte Speise?
			// Dann ein Komma schreiben
			if ( $nr < $letzterIndex ) {
				echo ', ';
			}
		}
	
	
		// Alternative
		implode( ', ', $lieblingsEssen );
	
	
	
	
	
	
	
	
	?>
</body>
</html>
