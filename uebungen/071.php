<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>071</title>
</head>

<body>
	<?php
	
	function briefAnrede( $name, $geschlecht ) {
		if ( $geschlecht == 'm' ) {
			return 'Lieber ' . $name;
		}
		
		if ( $geschlecht == 'w' ) {
			return 'Liebe ' . $name;
		}
		
		return 'Hallo ' . $name;
		
	}
	
	
	// Lieber Simon
	echo briefAnrede( 'Simon', 'm' );
	
	// Liebe Brigitte
	echo briefAnrede( 'Brigitte', 'w' );
	
	// Hallo
	echo briefAnrede( 'Andrea', 'a' );
	
	
	
	
	
	
	
	
	
	
	
	
	?>
</body>
</html>
