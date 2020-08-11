<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>032</title>
</head>

<body>
	<?php
		// Liste mit den Hobbys definieren
		$hobbys = [
			'Essen',
			'Lesen',
			'Velofahren',
			'comics'
		];
		
		// Sortieren
		natcasesort( $hobbys );
	
	?>
	<select>
		<option>-- bitte wählen --</option>
		<?php
			
			// Pro Hobby im Array schreiben wir ein 
			// OPTION-Element
			foreach( $hobbys as $hobby ) {
				// OPTION beginnen
				echo '<option>';
				// Sichtbarer Wert
				echo $hobby;
				// OPTION schliessen
				echo '</option>';
			}
		?>
	</select>	
	
	
	
	
	
	
	
	
	
	
</body>
</html>