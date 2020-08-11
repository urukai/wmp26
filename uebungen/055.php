<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>055</title>
</head>

<body>
	<form>
		<select name="alter">
			<?php
			
			// Welches Alter wurde verschickt?
			$verschicktesAlter = filter_input( INPUT_GET, 'alter', FILTER_VALIDATE_INT );
			
			
			for( $zaehler = 1; $zaehler <= 100; $zaehler++ ) {
				echo '<option';
				if ( $zaehler == $verschicktesAlter ) {
					echo ' selected';
				}
				echo '>';
				echo $zaehler;
				echo '</option>';
			}
			?>
		</select>
		<button type="submit">Abschicken</button>
	</form>	
</body>
</html>





