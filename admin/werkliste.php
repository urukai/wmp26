<?php

	// Konfiguration und Funktionen
	include '../config.php';
	include '../functions.php';

	// Datensatz löschen, sofern gewünscht
	$loeschenId = filter_input( INPUT_GET, 'loeschen', FILTER_VALIDATE_INT );
	if ( $loeschenId ) {
		// Vielleicht hat dieser Datensatz ein Bild zugeordnet.
		$res = db( 'SELECT bild FROM werke WHERE id = ' . $loeschenId );
		$zuLoeschenderDatensatz = mysqli_fetch_assoc( $res );
		/*
			[
				'bild' => 'werk-5cd123.456789.jpg'
			]
		*/
		// Wenn ein Bildname gespeichert ist und wenn das Bild vorhanden ist
		if ( $zuLoeschenderDatensatz[ 'bild' ] && 
			 file_exists( '../uploads/' . $zuLoeschenderDatensatz[ 'bild' ] ) ) {
			
			// Das Bild löschen
			unlink( '../uploads/' . $zuLoeschenderDatensatz[ 'bild' ] );
		}
		
		// jetzt eigentlichen Datensatz löschen
		// DELETE FROM werke WHERE id=42 LIMIT 1
		db( 'DELETE FROM werke WHERE id = ' . $loeschenId . ' LIMIT 1' );
		
	}

	include 'kopfbereich.php';

	echo '<h1>Gespeicherte Werke</h1>';

	// alle Werke holen, Sortierung nach Bedarf anpassen
	$res = db( 'SELECT * FROM werke ORDER by titel' );
	
	// Tabellarische Darstellung vorbereiten
	?>
	<table>
		<tr>
			<td></td>
			<td></td>
			<td>Titel</td>
			<td>Datum</td>
		</tr>
		<?php
			// alle Werke als TR zeigen
			while( $datensatz = mysqli_fetch_assoc( $res )) {
				// Jeder Datensatz wird in ein TR mit TD-Elementen verpackt
				echo '<tr>';
				
				// Zelle mit den Lösch-Link
				echo '<td>';
				echo '<a class="wmp26-icon-bin warnen" href="werkliste.php?loeschen=' . $datensatz[ 'id' ] . '" title="löschen"></a>';
				echo '</td>';
				
				// Zelle mit dem Bearbeiten-Link
				echo '<td>';
				echo '<a class="wmp26-icon-pencil" 
						 title="Werk bearbeiten"
						 href="werk-bearbeiten.php?id=' . $datensatz[ 'id' ] . '">';
				echo '</a>';
				echo '</td>';
				
				// Zelle für den Titel
				echo '<td>';
				echo $datensatz[ 'titel' ];
				echo '</td>';
				
				// Datum, z.B. "2020-08-18 10:08:54"
				echo '<td>';
				$sekunden = strtotime( $datensatz[ 'datum' ] );
				echo strftime( '%a, %d.%m.%Y', $sekunden );
				echo '</td>';
				
				
				echo '</tr>';
			}
			
		
		// Table schliessen
		echo '</table>';
			
			
			
			
			
			



	include 'fussbereich.php';