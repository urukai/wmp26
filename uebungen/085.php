<?php
	include '../config.php';
	include '../functions.php';

	// Werte entgegennehmen
	$verschickterVorname = filter_input( INPUT_POST, 
										'vorname', 
										FILTER_SANITIZE_STRING );
	$verschicktesGeschlecht = filter_input( INPUT_POST, 
										'geschlecht', 
										FILTER_SANITIZE_STRING );


	if ( $verschickterVorname ) {
		// INSERT INTO personen ( vorname, geschlecht ) VALUES ( "Simon", "m" )
		$sql  = 'INSERT INTO personen (vorname, geschlecht) VALUES ( "';
		$sql .= $verschickterVorname;
		$sql .= '", "';
		$sql .= $verschicktesGeschlecht;
		$sql .= '")';
		
		// Alternative Zwo
		$sql = 'INSERT INTO 
					personen (vorname, geschlecht) 
				VALUES ( 
					"' . $verschickterVorname . '", 
					"' . $verschicktesGeschlecht . '"
				)';
		
		// Alternative Drei
		$sql = sprintf( 'INSERT INTO personen (
							vorname, 
							geschlecht 
						) VALUES ( 
							"%s", 
							"%s"
						)', 
					  $verschickterVorname, 
					  $verschicktesGeschlecht );
		
		// An die DB schicken
		db( $sql );
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Vornamen</title>
</head>

<body>
	<form method="post">
		
		<label for="meinVornamensFeld">
			<input type="text"
				   id="meinVornamensFeld"
				   placeholder="Bitte gib einen Vornamen ein"
				   name="vorname">
		</label>
		
		<label>
			<select name="geschlecht">
				<option value="f">weiblich</option>
				<option value="m">männlich</option>
			</select>	
		</label>	
		</form>	
		
		<button type="submit">Speichern</button>
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>