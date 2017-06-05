<?php 
	namespace SYMBASE\CONNECTOR;
	
	class MySQL {

		public function __construct($ssb_MySQLInitLocal=true, $ssb_MySQLHost=NULL, $ssb_MySQLPort=NULL, $ssb_MySQLDB="symbla", $ssb_MySQLUser=NULL, $ssb_MySQLPass=NULL)  {

			// Check if 'InitLocal'-Flag is set
			if($ssb_MySQLInitLocal) {

				// Get local config
				$ssb_Crypter = new \SYMBASE\BIN\Crypter;
				$ssb_LCLCFG = $ssb_Crypter->declclcfg();

				// Write data into variables
				$ssb_MySQLHost = $ssb_LCLCFG[0];
				$ssb_MySQLUser = $ssb_LCLCFG[2];
				$ssb_MySQLPass = $ssb_LCLCFG[3];
				$ssb_MySQLPort = $ssb_LCLCFG[4];

			} # ~if

			// Call method to init connection
			$this->initConnection($ssb_MySQLHost, $ssb_MySQLPort, $ssb_MySQLDB, $ssb_MySQLUser, $ssb_MySQLPass);

		} # ~__construct()

		public function __destruct() {

			// Close connection
			$this->ssb_MySQLConn = null;

		} # ~__destruct()

		public function execQuery($ssb_MySQLQuery) {

			// Execute sql statement on server
			$ssb_MySQLPrepare = $this->ssb_MySQLConn->prepare($ssb_MySQLQuery);
			$ssb_MySQLPrepare->execute();

			// Fetch data and give back array
			$ssb_MySQLResult = $ssb_MySQLPrepare->fetchAll();
			return $ssb_MySQLResult;

		} # ~execQuery()

		private function initConnection($ssb_MySQLHost, $ssb_MySQLPort, $ssb_MySQLDB, $ssb_MySQLUser, $ssb_MySQLPass) {

			// Try init MySQL connection
			try {

				$this->ssb_MySQLConn = new \PDO("mysql:host=" . $ssb_MySQLHost . ";port=" . $ssb_MySQLPort . ";dbname=" . $ssb_MySQLDB . ";charset=utf8", $ssb_MySQLUser, $ssb_MySQLPass, array(
					\PDO::ATTR_PERSISTENT => true
				));

				return true;

			} catch(PDOException $ssb_PDOExc) {

				\SymBase::exc(SSB_LOG_FAIL, "MySQL Error: " . $ssb_PDOExc->getMessage());
				die();

				return false;

			} # ~catch

		} # ~__initConnection()

	} # ~MySQL
?>