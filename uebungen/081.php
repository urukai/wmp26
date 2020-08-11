<?php
	include '../config.php';
	include '../functions.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Früchte</title>
</head>

<body>
	<?php
	
		// Früchte holen
		$z = db( 'SELECT * FROM fruechte' );
		// HTML: UL beginnen
		echo '<ul>';
	
		// Pro Frucht ein LI schreiben. Solange eine Frucht holen, wie es hat
		while( $frucht = mysqli_fetch_assoc( $z ) ) {
			
			/*
			[
				'id' => 123,
				'name' => 'Apfel',
				'ist_lieblingsfrucht' => 0
			]
			*/
			
			
			echo '<li';
			if ( $frucht[ 'ist_lieblingsfrucht' ] ) {
				echo ' class="rot"';
			}
			echo '>';
			
			if ( $frucht[ 'ist_lieblingsfrucht' ] ) {
				echo '<strong>';
			}
			printf( '%s (Nr. %d)', 
				 $frucht[ 'name' ], 
				 $frucht[ 'id' ] );
			
			if ( $frucht[ 'ist_lieblingsfrucht' ] ) {
				echo '</strong>';
			}
			
			echo '</li>';
			
		}
	
		// HTML: UL schliessen
		echo '</ul>';
	
	
	?>
</body>
</html>