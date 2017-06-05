<?php 
	namespace SYMBASE\VIEW;
	
	class App {
		public function __construct() {
			
			/*
			 * Workspace "info" requires:
			 * 
			 * 	- Header
			 */
			require_once(__DIR__ . "/include/content/app.cont.php");

		} # ~__construct()

	} # ~App
?>