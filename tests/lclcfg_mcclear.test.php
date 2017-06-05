<?php

    include(__DIR__ . "/../core/thirdparty/php-sha3/src/Sha3.php");
    include(__DIR__ . "/../core/bin/crypter.class.php");

    // create new instances
    $crypter = new SYMBASE\BIN\Crypter;
    $hasher = new bb\Sha3\Sha3;

    // calculate age from date of birth
    $clearSeprtr = new DateTime("1996-03-11");
    $clearToday = new DateTime(date("Y-m-d"));
    $clearDateDiff = $clearSeprtr->diff($clearToday);

    // read lclcfg file and seperate content
    $sysPrefix = $hasher->hash("1996-03-11", 512);
    $ssbcfg = file_get_contents("/var/lib/symbla/lclcfg.ssc");
    $ssbcfg_arr = explode($sysPrefix, $ssbcfg);

    // generate unique key for encrypting
    $uniqKey = $ssbcfg_arr[1];

    // decrypt sql data with unique key (generated above)
    $deSqlHost = $crypter->decrypt($ssbcfg_arr[0], $uniqKey);
    $deSqlPort = $crypter->decrypt($ssbcfg_arr[2], $uniqKey);
    $deSqlUser = $crypter->decrypt($ssbcfg_arr[3], $uniqKey);
    $deSqlPass = $crypter->decrypt($ssbcfg_arr[4], $uniqKey);

    // get through loop ~age~ times (1996-03-11)
    for($x=0;$x<=$clearDateDiff->format("%y");$x++) {
        $deSqlHost = $crypter->decrypt($deSqlHost, $uniqKey);
        $deSqlPort = $crypter->decrypt($deSqlPort, $uniqKey);
        $deSqlUser = $crypter->decrypt($deSqlUser, $uniqKey);
        $deSqlPass = $crypter->decrypt($deSqlPass, $uniqKey);
    }

    // give out decrypted sql data
    echo $deSqlHost ."<br />". $uniqKey ."<br />". $deSqlPort ."<br />". $deSqlUser ."<br />". $deSqlPass;

?>