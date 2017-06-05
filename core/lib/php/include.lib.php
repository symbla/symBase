<?php

    $ssb_CoreDir = __DIR__ . "/../..";

    /*
    * Include required resources
    */

        // System variables
        require_once($ssb_CoreDir . "/lib/php/sysvars.lib.php");

        /*
        * Detect accept language and include language sources
        */
            // Detect...
            $ssb_Lang = explode(',', SSB_ACCEPT_LANGUAGE);
            $ssb_Lang = strtolower($ssb_Lang[0]);

            // Switch between languages
            unset($_COOKIE["ssb_lang"]);
            if (strstr($ssb_Lang, "de")) {
                require_once($ssb_CoreDir . "/lang/de.lang.php");
                if(!isset($_COOKIE["ssb_lang"]))
                    setcookie("ssb_lang", "de");
            } # ~if
            else {
                require_once($ssb_CoreDir . "/lang/en.lang.php");
                if(!isset($_COOKIE["ssb_lang"]))
                    setcookie("ssb_lang", "en");
            } # ~else
        /*
        * END
        */

        // Classes
        require_once($ssb_CoreDir . "/bin/app.class.php");
        require_once($ssb_CoreDir . "/bin/auth.class.php");
        require_once($ssb_CoreDir . "/bin/crypter.class.php");
        require_once($ssb_CoreDir . "/bin/dash.class.php");
        require_once($ssb_CoreDir . "/bin/dir.class.php");
        require_once($ssb_CoreDir . "/bin/file.class.php");
        require_once($ssb_CoreDir . "/bin/symbase.class.php");
        require_once($ssb_CoreDir . "/bin/view.class.php");

        // Other libraries
        require_once($ssb_CoreDir . "/lib/php/trigger.lib.php");

        // Loader
        require_once($ssb_CoreDir . "/loader/php/load.php");
        require_once($ssb_CoreDir . "/loader/php/dash/filelist.load.php");
    /*
    * END
    */

?>