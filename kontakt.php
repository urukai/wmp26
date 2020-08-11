<?php
	// Für PHPMailer
	use PHPMailer\PHPMailer\PHPMailer;



	// Konfiguration einbetten
	include 'config.php';
	// Funktionen auch, man weiss ja nie
	include 'functions.php';
	// HTML beginnen
	include 'kopfbereich.php';
	// Inhalt "Kontakt"
	echo '<h1>Kontaktformular</h1>';

	// Verschickte Werte entgegennehmen
	$verschickterVorname = filter_input( INPUT_POST, 'vorname', FILTER_SANITIZE_STRING );
	// Leerzeichen vorne und hinten entfernen
	$verschickterVorname = trim( $verschickterVorname );
	$verschickteMitteilung = filter_input( INPUT_POST, 'mitteilung', FILTER_SANITIZE_STRING );
	$verschickteAnrede = filter_input( INPUT_POST, 'anrede', FILTER_SANITIZE_STRING );
	$verschicktePLZ = filter_input( INPUT_POST, 'plz', FILTER_SANITIZE_STRING );
	$verschickteEmail = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
	

	// Wir merken uns, wann welches Feld falsch ist und wie ggf. eine 
	// Fehlermeldung lauten würde
	$fehlerDefinitionen = [
		'anrede' => [
			'istFalsch' => empty( $verschickteAnrede ),
			'meldung' => 'Bitte wähle eine Anrede'
		],
		'vorname' => [
			'istFalsch' => strlen( $verschickterVorname ) < 2,
			'meldung' => 'Bitte gib deinen Vornamen ein'
		],
		'plz' => [
			'istFalsch' => ! preg_match( '/^(([1-9])([0-9]{3}))|([0-9]{5})$/', $verschicktePLZ ),
			'meldung' => 'Bitte gib eine korrekte PLZ ein'	
		],
		'email' => [
			'istFalsch' => ! $verschickteEmail,	
			'meldung' => 'Bitte korrekte Mailadresse eingeben'
		],
		'mitteilung' => [
			'istFalsch' => strlen( $verschickteMitteilung ) < 10, // strpos( $verschickteMitteilung, '!!!' ) !== FALSE
			'meldung' => 'Willst du nicht eine Mitteilung schreiben?'
		],
		'sicherheit' => [
			'istFalsch' => $_POST[ 'antispam' ] != 9,
			'meldung' => 'Bitte Sicherheitsfrage korrekt beantworten'
		]
	];

	// Wir gehen davon aus, dass wir das Formular nicht zeigen müssen
	$formularZeigen = FALSE;

	// Behälter für alle Fehlermeldungen, die auftauchen
	$fehlerMeldungen = '';

	// Wir überprüfen das
	foreach( $fehlerDefinitionen as $feld ) {
		if ( $feld[ 'istFalsch' ] ) {
			$formularZeigen = TRUE;
			// Fehlermeldung einsammeln
			$fehlerMeldungen .= '<li>' . $feld[ 'meldung' ] . '</li>';
		}
	}

	
	// Falls wir das Formular zeigen müssen
	if ( $formularZeigen ) {
	?>
	<form method="post">
		<p>
			<label for="anrede">Anrede</label>
			<select name="anrede" id="anrede">
				<option value="">-- bitte wählen --</option>
				<?php
				foreach( $config[ 'anredeFormen' ] as $anrede ) {
					echo '<option';
					if ( $verschickteAnrede == $anrede ) {
						echo ' selected';
					}
					echo '>';
					echo $anrede;
					echo '</option>';
				}
				?>
			</select>	
		</p>	
		<p>
			<label for="vorname">Vorname</label>
			<input type="text"
				   name="vorname"
				   value="<?php echo htmlspecialchars( $verschickterVorname ); ?>"
				   placeholder="Dein Vorname"
				   id="vorname">
		</p>
		<p>
			<label for="plz">PLZ</label>
			<input type="text"
				   name="plz"
				   id="plz"
				   value="<?php echo htmlspecialchars( $verschicktePLZ ); ?>"
				   placeholder="Postleitzahl">
		</p>
		<p>
			<label for="email">E-Mail-Adresse</label>
			<input type="email"
				   name="email"
				   id="email"
				   value="<?php echo htmlspecialchars( $verschickteEmail ); ?>"
				   placeholder="E-Mail-Adresse">
		</p>
		<p>
			<label for="mitteilung">Mitteilung</label>
			<textarea name="mitteilung"
					  placeholder="Deine Mitteilung"
					  id="mitteilung"><?php echo htmlspecialchars( $verschickteMitteilung ); ?></textarea>
		</p>
		<p>
			<label for="antispam">Sicherheitsfrage</label>
			<input type="text"
				   name="antispam"
				   id="antispam"
				   placeholder="3 x 3">
		</p>	
		
		<p class="abschickbehaelter">
			<button type="submit">Absenden</button>
		</p>
		<?php
			// Fehlermeldungen in einem UL zeigen, sofern das 
			// Formular schon verschickt wurde
			if ( $_POST ) {
				echo '<ul class="fehler">' . $fehlerMeldungen . '</ul>';
			}
		?>
	</form>	
	<?php
	}	// Ende if $formularZeigen
	
	// Ansonsten (alle Angaben sind korrekt)
	else {
		// Danke sagen
		echo '<h3>Vielen Dank ' . $verschickterVorname . '</h3>';
		
		// HTML-Vorlage einlesen
		$html = file_get_contents( 'mail.html' );
		
		// eigene Platzhalter ersetzen
		$html = str_replace( '***ANREDE***', $verschickteAnrede, $html );
		$html = str_replace( '***VORNAME***', $verschickterVorname, $html );
		$html = str_replace( '***PLZ***', $verschicktePLZ, $html );
		$html = str_replace( '***EMAIL***', $verschickteEmail, $html );
		$html = str_replace( '***MITTEILUNG***', nl2br( $verschickteMitteilung ), $html );
	
		// Bilddaten einfügen
		$logo = file_get_contents( 'assets/logo.png' );
		// in base-64 umkodieren
		$logo = base64_encode( $logo );
		// Im Mailinhalt ersetzen
		$html = str_replace( '***LOGO***', $logo, $html );
		
		// Mail erzeugen und verschicken
		// PHPMailer-Klasse einbetten. Bitte beachte auch 
		// die Namensraum-Angabe ganz oben!
		require 'classes/PHPMailer.php';
		
		// Neues PHPMailer-Objekt erzeugen
		$meinMail = new PHPMailer();
		// Wer verschickt dieses Mail?
		$meinMail->setFrom( 'irgendwas@webedu.ch', 'Schorsch Gaggo' );
		// Wohin soll die Antwort gehen?
		$meinMail->addReplyTo( 'we-teacher@webedu.ch', 'Kasperli Himself' );
		// Betreffzeile?
		$meinMail->Subject = 'Neue Kontaktaufnahme via Website';
		// Zieladresse(n) angeben
		$meinMail->addAddress( 'we-teacher@webedu.ch', 'König Krambambuli' );
		$meinMail->addAddress( 'info@urukai.ch', 'König Krambambuli' );
		// Zeichensatz
		$meinMail->CharSet = 'utf-8';
		// Inhalt des Mails
		$meinMail->Body = $html;
		// Es handelt sich um ein HTML-Mail
		$meinMail->isHTML( TRUE );
		// Abschicken
		$meinMail->Send();
		// Objekt löschen
		$meinMail = NULL;
		
		
	
	}


		
		
	// HTML abschliessen
	include 'fussbereich.php';





