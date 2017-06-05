<?php

    include(__DIR__ . "/../core/bin/crypter.class.php");

    // create instance of Crypter
    $crypter = new \SYMBASE\BIN\Crypter();
    // create instance of File (/var/lib/lclcfg.ssb)
    #$lclcfg = new \SYMBASE\BIN\File("/var/lib/symbla/lclcfg.ssb");


    // encode lclcfg.ssb
    #echo $crypter->enclclcfg("localhost", "localspecial", "LocSpec/56JB09\I16!");

?>