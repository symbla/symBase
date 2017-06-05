<?php
    require_once(__DIR__ . "/../core/bin/symbase.class.php");

    echo \SymBase::today("H:i:s");
    echo \SymBase::today("d. M Y");
?>