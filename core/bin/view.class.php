<?php
	namespace SYMBASE;
	
	class View {

		public function __construct($ssb_UWS) {

			// Include header comment
			include("./core/lib/php/comment.lib.php");
			
			// Include basic HTML elements
			require_once(__DIR__ . "/views/include/html.elem.php");
			
			// Create new instance of view
			$this->createView($ssb_UWS);
			
		} # ~__construct()

		public function __destruct() {
			
			# Close basic HTML tags
			echo "</body></html>";
			
		} # ~__destruct()
		
		private function createView($ssb_UWS) {

			/*
			 * Switch decrypted value from cookie ssb_uws
			 */
			switch($ssb_UWS) {
				
				/*
				 * View: Dashboard
				 */
				case SSB_VIEW_DASH:
					require_once(__DIR__ . "/views/dash.view.php");
					
					# Create new instance of dashboard
					new VIEW\Dash;
					break;
				
				/*
				 * View: App-Workspace
				 */
				case SSB_VIEW_APP:
					require_once(__DIR__ . "/views/app.view.php");
					
					# Create new instance of info workspace
					new VIEW\App;
					break;
				
				/*
				 * View: Login panel
				 */
				case SSB_VIEW_LOGIN:
					require_once(__DIR__ . "/views/login.view.php");
					require_once(__DIR__ . "/auth.class.php");
					
					# Create new instance of login panel
					new VIEW\Login;
					break;
				
			} # ~switch
			
		} # ~createView()
		
	} # ~View
?>