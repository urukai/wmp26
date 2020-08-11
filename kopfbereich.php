<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<title>Portfolio | PHP-Kurs in der Webedu | Webedu AG</title>
	<meta name="description" content="Der super-duper-PHP-Kurs in der Webedu">
	<meta name="keywords" content="PHP, Bern, Webedu, super-duper">
	<link rel="stylesheet" type="text/css" href="assets/stil.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>

<body>
	<header class="header">
		<a href="index.php" class="logo-link">Hier das Logo</a>
		<nav class="hauptnavigation">
			<ul class="hauptmenu">
				<?php
				// Pro Menüpunkt im $config erzeugen wir 
				// ein LI-Element mit einem entsprechenden
				// A-Element
			
				foreach( $config[ 'navigation' ] as $dateiNameOhneEndung => $linkText ) {
					// LI-Element beginnen
					echo '<li class="hauptmenu-element">';
					// A-Element beginnen
					echo '<a href="' . $dateiNameOhneEndung . '.php" title="' . $linkText . '">';
					// Linktext
					echo $linkText;
					// Link beenden
					echo '</a>';
					
					// LI-Element schliessen
					echo '</li>';
				}
				?>
			</ul>	
		</nav>
		<a class="hamburger" 
		   href="javascript:;" 
		   title="Navigation öffnen oder schliessen">
			<span class="balken oberer-balken"></span>
			<span class="balken unterer-balken"></span>
		</a>
	</header>
	<main>
		
		
		
		
		
		