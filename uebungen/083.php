<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Instrumente</title>
</head>

<body>
	<?php
		error_reporting( E_ALL );
	
		// Verbindung
		$v = mysqli_connect( 'localhost', 'simon', 'gugus123', 'db_wmp26_uruk' )
			or die( 'Keine Verbindung zur DB' );
		// Kodierung setzen
		mysqli_set_charset( $v, 'UTF8' );
		// Musikinstrumente holen
		$z = mysqli_query( $v, 'SELECT * FROM instrumente' );
		// HTML: UL beginnen
		echo '<ul>';
	
		// Pro Instrument ein LI schreiben. Solange ein Instrument holen, wie es möglich ist
		while( $instrument = mysqli_fetch_assoc( $z ) ) {
			
			echo '<li>';
			
			echo '<h2>';
			echo $instrument[ 'name' ];
			echo '</h2>';
			
			// printf( '<h2>%s</h2>', $instrument[ 'name' ] );
			
			echo '<p>';
			echo $instrument[ 'beschrieb' ];
			echo '</p>';
			
			echo '<figure>';
			echo '<img src="'.$instrument[ 'bild' ].'" width="200">';
			echo '</figure>';
			
			echo '<p>';
			echo '<audio src="' . $instrument[ 'klang'] . '" controls></audio>';
			echo '</p>';
			
			// Alternative Schreibweise
			// printf( '<p><audio src="%s" controls></audio></p>', 
			//	  $instrument[ 'klang' ] );
			
			echo '</li>';
			
		}
	
		echo '</ul>';
	
	
		// Verbindung schliessen
		mysqli_close( $v );
	
	
	
	?>
</body>
</html>