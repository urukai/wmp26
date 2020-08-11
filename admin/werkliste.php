<?php

	// Konfiguration und Funktionen
	include '../config.php';
	include '../functions.php';

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
				echo '<a class="wmp26-icon-bin" href="#"></a>';
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
				
				// Datum
				echo '<td>';
				$sekunden = strtotime( $datensatz[ 'datum' ] );
				echo strftime( '%a, %d.%m.%Y', $sekunden );
				echo '</td>';
				
				
				echo '</tr>';
			}
			
		
		// Table schliessen
		echo '</table>';
			
			
			
			
			
			



	include 'fussbereich.php';