<?php
	$hobbys = [
		'Essen',
		'Lesen',
		'Velofahren'
	];


	$verschickterVorname = filter_input( INPUT_POST, 'vorname', FILTER_SANITIZE_STRING );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>POST</title>
</head>

<body>
	
	<form method="post">
		<input type="text"
			   value="<?php echo htmlspecialchars( $verschickterVorname ); ?>"
			   name="vorname">
		
		<p>
			<?php
			// Pro Hobby eine Checkbox bauen
			foreach( $hobbys as $hobby ){
				echo '<input type="checkbox" 
				             value="' . $hobby . '" 
							 name="hobbys[]"';
				
				if ( $_POST && in_array( $hobby, $_POST[ 'hobbys' ] ) ) {
					echo ' checked';
				}
				
				
				echo '> ' . $hobby;
				
				echo '<br>';
			}
			?>
		</p>	
		
		<button type="submit">Los!</button>
	</form>	
	<?php
	
		print_r( $_POST[ 'hobbys' ] );
	?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</body>
</html>