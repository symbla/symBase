<?php 
	namespace SYMBASE\BIN;
	
	class File {

		public function __construct($ssb_File, $ssb_Mode = 'r') {

			# Return file and flag for other methods
			if(sizeof($ssb_Mode) > 1) {
				\SymBase::exc(SSB_LOG_FAIL, SSB_FILE_BAD_MODE, $ssb_File);
				return false;
			} else {
				$this->ssb_File = $ssb_File;
				$this->ssb_Mode = $ssb_Mode;
			}

		} # ~__construct()

		/*
		 * Method to get content from file
		 */
		public function getContent() {

			# Get file contents
			return file_get_contents($this->ssb_File);

		} # ~getContent()

		/*
		 * Method to write content into file
		 */
		public function putContent($ssb_FilePutCContent) {

			// Open new temporary file
			$ssb_TmpFile = fopen($this->ssb_File, $this->ssb_Mode);

			// Write given content into file
			fwrite($ssb_TmpFile, $ssb_FilePutCContent);

			// Close file
			fclose($ssb_TmpFile);

		} # ~putContent()

		/*
		 * Method to get meta data from file
		 */
		public function getMeta() {

		    // Collect meta data in an array
            $ssb_FileMetaArray  = array();
		    $ssb_FileMetaArray[] = filesize($this->ssb_File);
		    $ssb_FileMetaArray[] = date(SSB_DATE_FORMAT, filemtime($this->ssb_File));

		    return $ssb_FileMetaArray;

		} # ~getMeta()

		/*
		 * Method to write meta data into file
		 */
		public function putMeta($ssb_File, $ssb_FilePutMContent) {

		} # ~putMeta()
		
	} # ~File
?>