<?php
    namespace SYMBASE\BIN;

    class Auth {

        public function __construct($ssb_AuthType, $ssb_AuthHost=false, $ssb_AuthPort=false, $ssb_AuthUser=false, $ssb_AuthPass=false) {
		
			if(empty($ssb_AuthUser) || empty($ssb_AuthPass))
				\SymBase::exc(SSB_LOG_WARN, SSB_LPANEL_EMPTY_FIELD, SSB_USER_AGENT);
			else {

				// Switch between authentication types
				switch($ssb_AuthType) {

					// Case for local authentication
					case SSB_AUTH_LCL:

						require_once("./core/lib/php/connector/mysql.conn.php");
						require_once("./core/thirdparty/php-sha3/src/Sha3.php");

						// Execute query on DB-Server
						$ssb_SQLConn = new \SYMBASE\CONNECTOR\MySQL();
						$ssb_SQLResult = $ssb_SQLConn->execQuery("SELECT UID, upass FROM ssb_users");
						
						for($sqli=0; $sqli<=(sizeof($ssb_SQLResult)-1); $sqli++) {
							if($ssb_SQLResult[$sqli]["UID"] == $ssb_AuthUser) {
								$ssb_AuthUserExists = true;

								if($ssb_SQLResult[$sqli]["upass"] == \bb\Sha3\Sha3::hash($ssb_AuthPass, 512)) {
									$ssb_SQLResult = $ssb_SQLConn->execQuery("SELECT * FROM ssb_users WHERE UID = '" . $ssb_AuthUser . "'");
									$this->login($ssb_SQLResult[0]);
								} else
									\SymBase::exc(SSB_LOG_FAIL, SSB_LPANEL_WRONG_PASS);

							} else continue;

						} # ~for

						if(!isset($ssb_AuthUserExists))
							\SymBase::exc(SSB_LOG_FAIL, SSB_LPANEL_USER_NOT_EXISTS . " (" . $ssb_AuthUser . ")");

						break;

				} # ~switch
				
			} # ~else

        } # ~__construct()

        /*
         * Method to log into system
         */
        private function login($ssb_AuthUserData) {

            $_SESSION["ssb_udata"] = $ssb_AuthUserData;
            $_SESSION["ssb_view"] = SSB_VIEW_DASH;

            #\SymBase::exc(SSB_LOG_INFO, SSB_LPANEL_LOGIN_GOOD, SSB_USER_AGENT);
            \SymBase::refresh();

        } # ~login()

        /*
         * Method to log out from the system
         */
        public static function logout() {

            // Destroy session
            session_destroy();

            // Show note and refresh after 3 seconds
            #\SymBase::exc(SSB_LOG_INFO, SSB_LPANEL_LOGOUT_GOOD);
            \SymBase::refresh();

        } # ~logout()

    } # ~Auth
?>