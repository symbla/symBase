<?php

    // Include required resources
    require_once(__DIR__ . "/../lib/php/include.lib.php");

    if(isset($_GET["apptype"]) && isset($_GET["appid"])) {

        switch($_GET["apptype"]) {

            default:
            case "default":
                $ssb_InternalAppInstance = false;
                break;

            case "intern":
                $ssb_InternalAppInstance = true;
                break;

        } # ~switch

        // Run app...
        $ssb_AppInstance = new \SYMBASE\BIN\App($ssb_InternalAppInstance);
        $ssb_AppInstance->run($_GET["appid"]);
        
    } else {
    	
    	\SymBase::exc(SSB_LOG_FAIL, SSB_APP_BAD_PARAM, $_GET["apptype"].'/'.$_GET["appid"]);
    			
    } # ~else

?>