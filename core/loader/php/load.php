<?php

    // Include required resources
    require_once(__DIR__ . "/../../lib/php/include.lib.php");

    if(isset($_GET["load"])) {

        switch($_GET["load"]) {

            case "mysql":

                $ssb_QUSTR = $_GET["qustr"];

                if(isset($ssb_QUSTR)) {
                    $ssb_SQLConn = new \SYMBASE\CONNECTOR\MySQL;
                    $ssb_SQLResult = $ssb_SQLConn->execQuery($ssb_QUSTR);
                    print_r($ssb_SQLResult);

                } else \SymBase::exc(SSB_LOG_FAIL, SSB_LOADER_BAD_SQL_QUERY, SSB_USER_AGENT);

                break;

            case "session":

                $ssb_SNAME = $_GET["sname"];
                $ssb_SDATA = $_GET["sdata"];
                $ssb_SNEW = $_GET["snew"];

                if(isset($_SESSION[$ssb_SNAME])) {

                    if($ssb_SDATA == false)
                        print_r($_SESSION[$ssb_SNAME]);
                    else
                        echo $_SESSION[$ssb_SNAME][$ssb_SDATA];

                } else \SymBase::exc(SSB_LOG_FAIL, SSB_LOADER_BAD_SESSION_DATA);

                break;

            case "applist":

                $ssb_App = new \SYMBASE\BIN\App();
                echo json_encode($ssb_App->listAll());

                break;

        } # ~switch

    } # ~if
?>