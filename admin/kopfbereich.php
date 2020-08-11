<?php
	// Der Einfachheit halber schreiben wir den 
	// Navigations-Array direkt hier hin
	$navigation = [
		[
			'datei' => 'index.php',
			'linkText' => 'Dashboard',
			'unterMenu' => null
		],
		[
			'datei' => 'werkliste.php',
			'linkText' => 'Werkliste',
			'unterMenu' => [
				[
					'datei' => 'neues-werk.php',
					'linkText' => 'Werk hinzufügen'				
				]
			]
		]
	];

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>CMS</title>
		<link rel="stylesheet" type="text/css" href="admin.css">
	</head>

	<body>
		<header class="linke-spalte">
			<nav>
				<ul>
				<?php
					// Pro Hauptmenüpunkt ein LI schreiben
					foreach( $navigation as $hauptMenuPunkt ) {
						// LI beginnen
						echo '<li>';
						// A-Element
						echo '<a href="' . $hauptMenuPunkt[ 'datei' ] . '">';
						// Linktext
						echo $hauptMenuPunkt[ 'linkText' ];
						// Link schliessen
						echo '</a>';
						
						// Hat dieser Hauptmenüpunkt ein Untermenü?
						if ( $hauptMenuPunkt[ 'unterMenu' ] ) {
							echo '<ul class="untermenu">';
							foreach( $hauptMenuPunkt[ 'unterMenu' ] as $unterMenuPunkt ) {
								echo '<li>';
								echo '<a href="' . $unterMenuPunkt[ 'datei' ] . '">';
								echo $unterMenuPunkt[ 'linkText' ];								
								echo '</a>';
								echo '</li>';
							}
							echo '</ul>';
						}
						
						// LI schliessen
						echo '</li>';
					}
				?>
				</ul>	
			</nav>	

		</header>
		<main>






		
		
