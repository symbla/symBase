<?php

	// Include necessary libraries
	require_once(__DIR__ . "/core/bin/symbase.class.php");

	// Activate output buffering
	ob_start();

		// Start session
		session_start();

		// Create new symBase instance
		new SymBase;

	// Send and turn off output buffer
	ob_end_flush();

?>