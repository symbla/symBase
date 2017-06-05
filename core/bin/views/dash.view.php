<?php 
	namespace SYMBASE\VIEW;
	
	class Dash {
		public function __construct() {

			/*
			 * Workspace "dash" requires:
			 *
			 *  - Dashboard stylesheet
			 *  - Dash JS library
			 *  - App JS library
			 *  
			 * 	- Header
			 * 	- Dashboard
			 */
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./core/lib/css/ui/dash.lib.css\" />";
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./core/thirdparty/nprogress/nprogress.css\" />";
			echo "<script type=\"text/javascript\" src=\"./core/lib/js/ui/dash.ui.js\"></script>";
			echo "<script type=\"text/javascript\" src=\"./core/lib/js/ui/filelist.ui.js\"></script>";
            echo "<script type=\"text/javascript\" src=\"./core/lib/js/ui/app.ui.js\"></script>";
			
			require_once(__DIR__ . "/include/content/header.cont.php");
			require_once(__DIR__ . "/include/content/dash.cont.php");

		} # ~__construct()

	} # ~Dash
?>