<?php

    /*
     * trigger.lib.php
     * Calls PHP functions when buttons are clicked
     */

    // Login / Logout
    if(isset($_POST["ssbFormLPSubmit"])) new \SYMBASE\BIN\Auth(SSB_AUTH_LCL, false, false, $_POST["ssbFormLPUID"], $_POST["ssbFormLPPass"]);
    if(isset($_GET["logout"])) \SYMBASE\BIN\Auth::logout();

?>