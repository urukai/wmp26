<?php
	// Array mit Hobbys
	$hobbys = [
		'Essen',
		'Lesen',
		'Velofahren'
	];

	// Wert der verschickten Dropdown-Wahl
	$gewaehlt = filter_input( INPUT_GET, 'hobby', FILTER_SANITIZE_STRING );

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>052</title>
</head>

<body>
	<form>
		
		<select name="hobby">
			<option>-- bitte wählen --</option>
			<?php
			// Pro Hobby im Array ein OPTION-Element schreiben
			foreach( $hobbys as $hobby ) {
				// <option>Essen</option>
				// <option selected>Lesen</option>
				echo '<option';
				if ( $hobby == $gewaehlt ) {
					echo ' selected';
				}
				echo '>' . $hobby . '</option>';
				
				/*
				printf( '<option%s>%s</option>', 
					  $gewaehlt == $hobby ? ' selected' : '',
					   $hobby
					  );
				*/
				
				
			}
			?>
		</select>
		
		<button type="submit">Los!</button>
		
	</form>	
	
	
	
</body>
</html>