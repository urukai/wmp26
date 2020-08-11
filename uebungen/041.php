<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>041</title>
</head>

<body>
	<form>
		<select>
			<?php
			for( $zaehler = 1; $zaehler <= 100; $zaehler++ ) {
				echo '<option';
				if ( $zaehler == 45 ) {
					echo ' selected';
				}
				echo '>';
				echo $zaehler;
				echo '</option>';
			}
			?>
		</select>	
	</form>	
</body>
</html>





