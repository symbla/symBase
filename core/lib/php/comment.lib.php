<?php

    /*
     * comment.lib.php
     * Creates comment with information about
     * this website and its user on top of the html document
     */

    echo "
<!--
                         _     _       \n     ___ _   _ _ __ ___ | |__ | | __ _ \n    / __| | | | '_ ` _ \\| '_ \\| |/ _` |\n    \\__ \\ |_| | | | | | | |_) | | (_| |\n    |___/\\__, |_| |_| |_|_.__/|_|\\__,_|\n         |___/         symBase      \n\n
    /USER_AGENT:    " . SSB_USER_AGENT . "
    /REQUEST_TIME:  " . SSB_REQUEST_TIME . "
    /DATE_TIME:     " . \SymBase::today(SSB_DATE_FORMAT . ", h:i:s") . "

-->\n
    ";

?>