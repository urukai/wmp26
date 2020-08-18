<?php

	// Konfiguration und Funktionen
	include '../config.php';
	include '../functions.php';

	// Neues Werk erfassen
	$sql = 'INSERT INTO werke ( id ) VALUES ( NULL )';
	$neueId = db( $sql );
	
	// Auf das Formular weiterleiten
	header( 'Location: werk-bearbeiten.php?id=' . $neueId );