<?php

    /*
     * generate lclcfg.ssb
     * tests included
     */

    require_once(__DIR__ . "/../../../../lib/php/include.lib.php");

    // create instance of Crypter
        #$crypter = new \SYMBASE\BIN\Crypter();
    // create instance of File (/var/lib/lclcfg.ssb)
        #$lclcfg = new \SYMBASE\BIN\File(__DIR__ . "/../../../../../config/lclcfg.ssb", "r");

    // encode lclcfg.ssb
        #echo $crypter->enclclcfg("localhost", "root", "r00+@MySQL/v.2016!");
    // get content of lclcfg.ssb
        #echo $lclcfg->getContent();
    // decode lclcfg.ssb
        #print_r($crypter->declclcfg());

        # require_once("./core/thirdparty/php-sha3/src/Sha3.php");
        # echo bb\Sha3\Sha3::hash("Test123!", 512);

    # echo \SymBase::note(SSB_LOG_FAIL, "Test Fail");
    # echo \SymBase::note(SSB_LOG_WARN, "Test Warn");
    # echo \SymBase::note(SSB_LOG_INFO, "Test Info");

?>

<div style="background:#CCC;">
    <p>TestApp</p>
</div>
<script>
    //ssbMySQLExecQuery("SELECT * FROM ssb_users");
    //ssbGetSessionData("session", "ssb_udata");
    //ssbGetAppList();
</script>

<?php

    //$ssb_App = new \SYMBASE\BIN\App();
    //echo json_encode($ssb_App->listAll());
?>                                                                