<?php
namespace SYMBASE\BIN;

class Dir {

    public function __construct($ssb_DirPath, $ssb_ReadRecursive=false) {

        // Open Directory Handler
        $this->ssb_AbsoluteDir = __DIR__ . "/../../" . $ssb_DirPath;

        if(!is_dir($this->ssb_AbsoluteDir)) {
            \SymBase::exc(SSB_LOG_FAIL, SSB_DIR_NOT_EXISTS, $this->ssb_AbsoluteDir);
        } # ~if

        $this->ssb_ReadRecursive = $ssb_ReadRecursive;

    } # ~__construct()

    public function __destruct() {

        // Close Directory Handler
        closedir($this->ssb_DirHandler);

    } # ~__destruct()

    public function search($ssb_DirSearchString) {

        return glob($this->ssb_AbsoluteDir . '/' . $ssb_DirSearchString);

    } # ~search()

    /*
     * Method to get content from file
     */
    public function getContent() {

        // Init element array
        $ssb_DirElements  = array("dirs"=>array(), "files"=>array(), "links"=>array(), "undefined"=>array());

        // Reset element counters
        $ssb_DirElementDirCounter = 0;
        $ssb_DirElementFileCounter = 0;
        $ssb_DirElementLinkCounter = 0;
        $ssb_DirElementUndefinedCounter = 0;

        // Open IO stream
        $this->ssb_DirHandler = opendir($this->ssb_AbsoluteDir);

        while(false !== ($ssb_DirEntry = readdir($this->ssb_DirHandler))) {

            if($ssb_DirEntry == '.' || $ssb_DirEntry == '..' || $ssb_DirEntry == ".{ssb}")
                continue;
            else {
                $ssb_DirElement = $this->ssb_AbsoluteDir . '/' . $ssb_DirEntry;
                if(is_dir($ssb_DirElement)) {

                    if($this->ssb_ReadRecursive) {

                        $this->getContent($ssb_DirElement, true);

                    } # ~if

                    $ssb_DirElements["dirs"][$ssb_DirElementDirCounter] = $ssb_DirElement;

                    // Increase counter
                    $ssb_DirElementDirCounter++;

                } elseif (is_file($ssb_DirElement)) {

                    $ssb_DirElements["files"][$ssb_DirElementFileCounter][] = $ssb_DirElement;

                    // Create new instance of class File and get meta data
                    $ssb_DirElementMetaInstance = new \SYMBASE\BIN\File($ssb_DirElement);
                    $ssb_DirElementMeta = $ssb_DirElementMetaInstance->getMeta();
                    $ssb_DirElements["files"][$ssb_DirElementFileCounter][] = $ssb_DirElementMeta;

                    // Increase counter
                    $ssb_DirElementFileCounter++;

                } elseif(is_link($ssb_DirElement)) {
                    $ssb_DirElements["links"][$ssb_DirElementLinkCounter][] = $ssb_DirElement;

                    // Increase counter
                    $ssb_DirElementLinkCounter++;

                } else {
                    $ssb_DirElements["undefined"][$ssb_DirElementUndefinedCounter][] = $ssb_DirElement;

                    // Increase counter
                    $ssb_DirElementUndefinedCounter++;

                } # ~else

            } # ~else

        } # ~while

        // Get file contents
        return $ssb_DirElements;

    } # ~getContent()

} # ~Dir
?>