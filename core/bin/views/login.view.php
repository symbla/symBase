<?php 
	namespace SYMBASE\VIEW;
	
	class Login {
		public function __construct()
		{

			/*
			 * View "login" requires:
			 *
			 *  - Login JS library
			 *
			 * 	- Login panel
			 * 	- Login library
			 */
            echo "<script type=\"text/javascript\" src=\"./core/lib/js/ui/login.ui.js\"></script>";

			require_once(__DIR__ . "/include/content/lpanel.cont.php");
			require_once(__DIR__ . "/../auth.class.php");
			#require_once(__DIR__ . "/include/content/test.cont.php");

		} # ~__construct()

	} # ~Login
?>