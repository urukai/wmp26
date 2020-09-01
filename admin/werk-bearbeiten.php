<?php

	// Konfiguration und Funktionen
	include '../config.php';
	include '../functions.php';

	include 'kopfbereich.php';

	// id in der Adresszeile entgegennehmen
	$id = filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
	$res = db( 'SELECT * FROM werke WHERE id=' . $id );
	$werk = mysqli_fetch_assoc( $res );
	/*
		[
			id => 4,
			titel => 'Frosties',
			beschrieb => 'Bla bla bla',
			datum => '2020-08-12 10:45:20',
			bild => 'werk-5c123456.78945.jpg'
		]
	
	*/
	

	// Gibt es Korrekturen? Wurde das Formular verschickt?
	if ( $_POST ) {
		
		
		// Bisheriger Bildname als Zielname verwenden, damit
		// das Update-Statement korrekt bleibt
		$zielName = $werk[ 'bild' ];
		// Wurde die Checkbox markiert?
		$bildMussWeg = isset( $_POST[ 'altes-bild-weg' ] );
		// Bild löschen? Wenn ja, dies speichern
		if ( $bildMussWeg ) {
			$zielName = '';
		}
		
		// $_FILES ist ein verschachtelter Array
		// print_r( $_FILES );
		
		
		// Ist die hochgeladene Datei wirklich ein JPG-Bild?
		if ( $_FILES[ 'bild' ][ 'type' ] == 'image/jpeg' ) {
			// Nach dem Hochladen wird die Datei an einem 
			// temporären Ort gespeichert
			$tempOrt = $_FILES[ 'bild' ][ 'tmp_name' ];
			// Zielname der Datei: etwas Zufälliges, mit "werk-"
			// vorne dran und mit der Endung "jpg"
			$zielName = uniqid( 'werk-', TRUE ) . '.jpg';
			// Zielort definieren: im uploads-Ordner
			$zielOrt = '../uploads/' . $zielName;
			// dorthin verschieben
			move_uploaded_file( $tempOrt, $zielOrt );
			// Wir haben ein neues Bild, das alte muss gelöscht werden
			$bildMussWeg = TRUE;
			
		}
		
		// altes Bild löschen, sofern vorhanden und sofern gewünscht
		if ( $werk[ 'bild' ] && file_exists( '../uploads/' . $werk[ 'bild' ] ) && $bildMussWeg ) {
			// Bild löschen
			unlink( '../uploads/' . $werk[ 'bild' ] );
		}
		
		// Werte bereinigen
		$neuerTitel = filter_input( INPUT_POST, 
								   'titel', 
								   FILTER_SANITIZE_STRING, 
								   FILTER_FLAG_NO_ENCODE_QUOTES );
		$neuerBeschrieb = filter_input( INPUT_POST, 
									   'beschrieb', 
									   FILTER_SANITIZE_STRING, 
									   FILTER_FLAG_NO_ENCODE_QUOTES );
		$neuesDatum = filter_input( INPUT_POST, 'datum', FILTER_SANITIZE_STRING );
		
		
		// SQL-Statement zusammenstellen
		// UPDATE tabelle SET feld1="wert1", feld2="wert2", feld3="wert3" WHERE id = 42
		$sql = sprintf( 'UPDATE
							werke
						SET
							titel="%s", 
							beschrieb="%s",
							datum="%s",
							bild="%s"
						WHERE
							id=%d', 
					   $neuerTitel, 
					   $neuerBeschrieb, 
					   $neuesDatum,
					   $zielName,
					   $id );
		// an die DB schicken
		db( $sql );
		
		// Im Array $werk die entsprechenden Angaben aktualisieren,
		// damit wir die Korrekturen im Formular auch sehen
		$werk[ 'titel' ] = $neuerTitel;
		$werk[ 'beschrieb' ] = $neuerBeschrieb;
		$werk[ 'datum' ] = $neuesDatum;
		$werk[ 'bild' ] = $zielName;
		
		// Kategorie-Zuordnungen speichern
		// Erst mal alle Zuordnungen löschen
		db( 'DELETE FROM zuordnungen WHERE werk_id=' . $id );
		// Pro neue Zuordnung einen neuen Datensatz generieren
		// ("Pro markierter Checkbox eine neue Zuordnung speichern")
		foreach( $_POST[ 'kategorien' ] as $kategorieId ) {
			$sql = sprintf( 'INSERT INTO 
					 zuordnungen ( 
					 	werk_id, 
						kategorie_id 
					 ) VALUES (
					 	%d,
						%d
					 )', $id, $kategorieId );
			db( $sql );
		}
		
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
			<!-- der Datumswert aus der Datenbank ist z.B. "2020-08-18 12:11:32" -->
			<?php
				// Falls beim Datum auf die Zeit vorhanden ist
				$wertDatumsFeld = substr( $werk[ 'datum' ], 0, 10 );
			?>
			<label>Datum<br>
				<input type="date"
					   name="datum"
					   value="<?php echo $wertDatumsFeld; ?>">
			</label>	
		</p>
		
		<p>
			<label>Bild<br>
				<input type="file"
					   name="bild"
					   accept="image/jpeg">
			</label>
		</p>
		
		<?php
			// Gibt es ein brauchbares Bild?
			if ( $werk[ 'bild' ] && file_exists( '../uploads/' . $werk[ 'bild' ] ) ) {
				// ja, einbetten
				printf( '<p><img src="../uploads/%s" alt="" class="vorschau"></p>', 
					$werk[ 'bild' ] );
				// Checkbox, um das Bild löschen zu lassen
				echo '<p>
						<label class="neben-checkbox">
							<input type="checkbox" name="altes-bild-weg">
							Dieses Bild brauche ich nicht mehr, bitte löschen
						</label>
					 </p>';
			}
		?>	
		
		<h4>Kategorien</h4>
		<p>
			<?php
				// Alle für dieses Werk zugeordneten Kategorie-IDs
				// ermitteln und in einen brauchbaren Array übertragen
				$res = db( 'SELECT kategorie_id FROM zuordnungen WHERE werk_id = ' . $id );
				$zugeordnet = [];
				while( $zuordnung = mysqli_fetch_assoc( $res ) ) {
					$zugeordnet[] = $zuordnung[ 'kategorie_id' ];
				}
			
			
				// Pro Kategorie, die man wählen kann, 
				// eine Checkbox hinsetzen. Wir holen alle 
				// Kategorien aus der DB
				$res = db( 'SELECT * FROM kategorien ORDER BY name' );
				while( $kategorie = mysqli_fetch_assoc( $res ) ) {
					echo '<label class="neben-checkbox untereinander">';
					echo '<input type="checkbox" 
								 name="kategorien[]" ';
					// Ist diese Kategorie dem Werk zugeordnet?
					if ( in_array( $kategorie[ 'id' ], $zugeordnet ) ) {
						echo 'checked ';
					}
					
					echo 'value="' . $kategorie[ 'id' ] . '">';
					echo $kategorie[ 'name' ];
					echo '</label>';
				}
			?>
			
		</p>	
		
		
		
		
		
		
		
		<p>
			<button type="submit">Speichern</button>
		</p>	
	</form>
	<?php
	

	include 'fussbereich.php';