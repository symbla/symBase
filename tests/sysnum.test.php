<?php

    include(__DIR__ . "/../core/bin/crypter.class.php");
    $crypter = new SYMBASE\BIN\Crypter;

    echo $crypter->sysnum();

?>