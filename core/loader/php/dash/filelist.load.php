<?php

    session_start();

    /*
     * Dashboard loader for file explorer
     * =====================
     * Executes PHP code by GET parameter
     */

    // Include required resources
    require_once(__DIR__ . "/../../../lib/php/include.lib.php");

    if(isset($_GET["ssbFileListExpParamDirStr"]))
        ssbFileListExpReadDir($_GET["ssbFileListExpParamDirStr"], $_GET["ssbFileListExpParamRR"] = false, $_GET["ssbFileListExpParamDirOnly"] = false);
    elseif(isset($_GET["ssb_AEParamFileStr"]))
        ssbFileListExpReadMeta($_GET["ssbFileListExpParamFileStr"]);

    function ssbFileListExpReadDir($ssbFileListExpDir) {

        if(!isset($_SESSION["ssb_udata"])) {
            \SYMBASE\BIN\Auth::logout();

        } else {
            // Build base directory
            $ssb_UserID = $_SESSION["ssb_udata"]["UID"];
            $ssbFileListExpBaseDir = "./core/udirs/" . $ssb_UserID . "/files" . $ssbFileListExpDir;

            // Create new instance of directory handler and get content
            $ssbFileListExpDirReader = new \SYMBASE\BIN\Dir($ssbFileListExpBaseDir);
            $ssbFileListExpDirContent = $ssbFileListExpDirReader->getContent();

            // Give back dir content
            echo json_encode($ssbFileListExpDirContent);

        }

    } # ~ssbFileListExpReadDir()

?>