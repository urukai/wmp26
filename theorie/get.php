<?php
	// Werte bereinigen
	$verschickterVorname = filter_input( INPUT_GET, 'vorname', FILTER_SANITIZE_STRING );
	$verschickterJahrgang = filter_input( INPUT_GET, 'jahrgang', FILTER_VALIDATE_INT );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>GET</title>
</head>

<body>
	<form>
		<p>
			<label for="vorname">Vorname</label>
			<input type="text" 
				   id="vorname" 
				   value="<?php echo htmlspecialchars( $verschickterVorname ); ?>"
				   name="vorname">
		</p>
		<p>
			<label for="jahrgang">Jahrgang</label>
			<input type="number"
				   min="1920"
				   max="2020"
				   id="jahrgang"
				   value="<?php echo $verschickterJahrgang; ?>"
				   name="jahrgang">
		</p>	
		<p>
			<button type="submit">Absenden</button>
		</p>	
	</form>
	
	<p>
		<a href="get.php?vorname=Schorsch&kontostand=5">Link mit GET-Variablen</a>
		<!--<a href="news.php?id=123">Link mit GET-Variablen</a>-->
	</p>	
	
	
	<?php
		print_r( $_GET );
	?>
	
	
	
	
	
	
	
</body>
</html>