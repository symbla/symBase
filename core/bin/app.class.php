<?php
    namespace SYMBASE\BIN;

    class App {

        public function __construct($ssb_ShowSystemApp = false) {

            // Check if app is a system app
            // and change path if true
            if($ssb_ShowSystemApp)
                $this->ssb_AppPath = "./core/apps/.{ssb}";
            else
                $this->ssb_AppPath = "./core/apps";

        } # ~__construct()

        public function run($ssb_AppIdentifier) {

            // Reset "AppExists"-value
            $ssb_AppExists = false;
            // Get array of app list
            $ssb_AppListArray = $this->listAll();
            // Go through app list array and search for given identifier
            for($xapp = 0; $xapp <= (sizeof($ssb_AppListArray)-1); $xapp++) {

                // Check if temporary app title is the same
                // as the given parameter value
                if($ssb_AppListArray[$xapp]["title"] == $ssb_AppIdentifier) {

                    // App found! give back true
                    $ssb_AppExists = true;

                    // Set app landing file
                    $ssb_AppLandingFile = __DIR__ . "/../../" . $this->ssb_AppPath . '/' . $ssb_AppIdentifier . '/' . $ssb_AppListArray[$xapp]["landing"];

                    // Try to include app landing page
                    try {

                        @require_once($ssb_AppLandingFile);

                    } catch(Exception $ssb_IncExc) {

                        \SymBase::exc(SSB_LOG_FAIL, SSB_APP_LANDING_NOT_EXISTS, $ssb_IncExc->getMessage());

                    } # ~catch

                } else continue;

                if(!$ssb_AppExists)
                    \SymBase::exc(SSB_LOG_FAIL, SSB_APP_NOT_EXISTS, "User: " . $_SESSION["ssb_udata"]["UID"] . ";App: " . $ssb_AppIdentifier);

            } # ~for

        } # ~run()

        public function listAll() {

            // Read apps directory
            $ssb_AppsDir = new \SYMBASE\BIN\Dir($this->ssb_AppPath);
            $ssb_AppListArray = $ssb_AppsDir->getContent();

            // Create new array for app meta data
            $ssb_AppListMetaArray = array();

            // Go into each app folder
            foreach($ssb_AppListArray["dirs"] as $ssb_TmpAppFolder) {

                // Get XML from meta file
                $ssb_AppMetaFile = new \SYMBASE\BIN\File($ssb_TmpAppFolder . "/app.meta.xml", "r");
                // Get object from xml
                $ssb_AppMetaObject = new \SimpleXMLElement($ssb_AppMetaFile->getContent());
                // Convert object to array and append it
                $ssb_AppListMetaArray[] = (array) $ssb_AppMetaObject;

            } # ~foreach

            return $ssb_AppListMetaArray;
            
        } # ~listAll()

        public function remove() {



        } # ~remove()

    } # ~App
?>