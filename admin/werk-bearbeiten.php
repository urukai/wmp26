<?php

	// Konfiguration und Funktionen
	include '../config.php';
	include '../functions.php';

	include 'kopfbereich.php';

	// id in der Adresszeile entgegennehmen
	$id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
	$res = db( 'SELECT * FROM werke WHERE id=' . $id );
	$werk = mysqli_fetch_assoc( $res );

	// Gibt es Korrekturen? Wurde das Formular verschickt?
	if ( $_POST ) {
		// Werte bereinigen
		$neuerTitel = filter_input( INPUT_POST, 
								   'titel', 
								   FILTER_SANITIZE_STRING, 
								   FILTER_FLAG_NO_ENCODE_QUOTES );
		$neuerBeschrieb = filter_input( INPUT_POST, 
									   'beschrieb', 
									   FILTER_SANITIZE_STRING, 
									   FILTER_FLAG_NO_ENCODE_QUOTES );
		
		// SQL-Statement zusammenstellen
		$sql = sprintf( 'UPDATE
							werke
						SET
							titel="%s", 
							beschrieb="%s"
						WHERE
							id=%d', 
					   $neuerTitel, 
					   $neuerBeschrieb, 
					   $id );
		// an die DB schicken
		db( $sql );
		
		// Im Array $werk die entsprechenden Angaben aktualisieren,
		// damit wir die Korrekturen im Formular auch sehen
		$werk[ 'titel' ] = $neuerTitel;
		$werk[ 'beschrieb' ] = $neuerBeschrieb;
		
	
	}



	// Werk "Titel des Werks" bearbeiten
	// « -> ALT + 0171, auf Mac: ALT + ,
	// » -> ALT + 0187, auf Mac: ALT + Shift + ,
	echo '<h1>Werk «' . $werk[ 'titel' ] . '» bearbeiten</h1>'; 

	// Formular, das die Werte des Werkes enthält
	?>
	<form method="post" enctype="multipart/form-data">
		<p>
			<label>Titel<br>
				<input type="text" 
					   name="titel"
					   value="<?php echo htmlspecialchars( $werk[ 'titel' ] ); ?>">
			</label>
		</p>	
		<p>
			<label>Beschrieb<br>
				<textarea name="beschrieb"><?php echo htmlspecialchars( $werk[ 'beschrieb' ] ); ?></textarea>
			</label>	
		</p>
		<p>
			<button type="submit">Speichern</button>
		</p>	
	</form>
	<?php
	

	include 'fussbereich.php';