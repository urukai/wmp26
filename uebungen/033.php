<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>033</title>
</head>

<body>
	<?php
		// Schuldenliste
		$schulden = [
			'jan' => 1230,
			'chrigu' => 82340.95,
			'rud' => -100.50
		];
	
		/*
		$schulden = [
			'jan' => [
				'betrag' => 123,
				'werwem' => 'ermir'
			],
			'chrigu' => [
				'betrag' => 789,
				'werwem' => 'ermir'
			],
			'rud' => [
				'betrag' => 78987,
				'werwem' => 'ichihm'
			]
		];
		*/
	
		foreach( $schulden as $person => $betrag ) {
			echo ucfirst( $person );
			if ( $betrag > 0 ) {
				echo ' schulde ich ';
			}
			else {
				echo ' schuldet mir ';
			}
			$betragPositiv = abs( $betrag );
			echo number_format( $betragPositiv, 2, '.', "'" );
			echo ' CHF<br>';
		}
	
	
	
	?>
	
	
	
</body>
</html>