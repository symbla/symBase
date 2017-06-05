<?php

	error_reporting(E_ALL);

	class SymBase {

		public function __construct() {

			require_once(__DIR__ . "/../lib/php/include.lib.php");

			# Get encrypted value from session to select workspace
			if (!isset($_SESSION["ssb_view"])) {

				# Set session "ssb_view" with default value encrypted with generated key
				$_SESSION["ssb_view"] = SSB_VIEW_LOGIN;

			} # ~if

			# Create new view
			new \SYMBASE\View(SSB_VIEW);

		} # ~__construct()

		/*
		 * Method to refresh page via PHP
		 */
		public static function refresh($ssb_RefreshDelay = 0) {

			// Send header
			header("Refresh:" . $ssb_RefreshDelay . ";url=" . $_SERVER["PHP_SELF"]);

		} # ~refresh()

		/*
		 * Method to get date and time
		 */
		public static function today($ssb_DateTimeFormat) {

			// Get timestamp
			$ssb_TimeStamp = time();

			// Return date with given string
			return date($ssb_DateTimeFormat, $ssb_TimeStamp);

		} # ~today()

		public static function exc($ssb_ExcType, $ssb_ExcMessage, $ssb_ExcHidden=false) {

			// Call method note with same paramter values
			echo self::note($ssb_ExcType, $ssb_ExcMessage);

			// Call method log with same parameter values
			self::log($ssb_ExcType, $ssb_ExcMessage, $ssb_ExcHidden);

		} # ~exc()

		public static function log($ssb_LogType, $ssb_LogMessage, $ssb_HiddenLog=false) {

			$ssb_File = new \SYMBASE\BIN\File(__DIR__ . "/../../" . SSB_LOGDIR . "/ssb_" . self::today("d-m-Y") . ".log", "a+");
			$ssb_Timestamp = self::today("d.m.Y, H:i:s");

			$ssb_TmpLog = "[" . $ssb_Timestamp . " | ";
			$ssb_TmpLog .= SSB_USER_IP . "\t| ";

			switch ($ssb_LogType) {

				// Case for log type 'fail' (1)
				case SSB_LOG_FAIL:
					$ssb_TmpLog .= "FAILED";
					break;
				// Case for log type 'warn' (2)
				case SSB_LOG_WARN:
					$ssb_TmpLog .= "WARN";
					break;
				// Case for log type 'info' (3)
				case SSB_LOG_INFO:
					$ssb_TmpLog .= "INFO";
					break;

			} # ~switch

			$ssb_TmpLog .= "] ";

			// Check if log has hidden information
			if(isset($ssb_HiddenLog)) {
				$ssb_TmpLog .= "[" . $ssb_HiddenLog . "] ";
			}

			// Finishing the temporary log string
			$ssb_TmpLog .= " " . $ssb_LogMessage . "\n";

			// Write log into file
			$ssb_File->putContent($ssb_TmpLog);

		} # ~log()

		public static function note($ssb_NoteType, $ssb_NoteMessage) {

			$ssb_TmpNote = "<div class=\"alert alert-";

			switch ($ssb_NoteType) {
				case SSB_LOG_FAIL:
					$ssb_TmpNote .= "danger\">";
					break;
				case SSB_LOG_WARN:
					$ssb_TmpNote .= "warning\">";
					break;
				case SSB_LOG_INFO:
					$ssb_TmpNote .= "info\">";
					break;
			} # ~switch

			$ssb_TmpNote .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"><i class=\"fa fa-times-circle\"></i></a>";
			$ssb_TmpNote .= "<p>" . $ssb_NoteMessage . "</p></div>";

			return $ssb_TmpNote;

		} # ~note()

	} # ~SymBase
?>