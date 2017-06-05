<?php
	namespace SYMBASE\BIN;
	
	class Crypter {

		/*
		 * Method to encrypt data
		 */
		public function encrypt($ssb_DecStr, $ssb_KeyStr=NULL) {

			// encrypt from plain text ($dec_str)
			$ssb_EncryptedString = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ssb_KeyStr), $ssb_DecStr, MCRYPT_MODE_ECB)));

			// return encrypted string
			return $ssb_EncryptedString;
			
		} # ~encrypt()
		
		/*
		 * Method to decrypt data
		 */
		public function decrypt($ssb_EncStr, $ssb_KeyStr=NULL) {

			// decrypt to plain text ($enc_str)
			$ssb_DecryptedString = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ssb_KeyStr), base64_decode($ssb_EncStr), MCRYPT_MODE_ECB));

			// deturn decrypted string
			return $ssb_DecryptedString;

		} # ~decrypt()

		/*
		 * Method to get special system number
		 */
		public function sysnum() {

			// get sysnum
			$clearSeprtr = new \DateTime($this->decrypt("ZpeIPXgH9Rk6njbAGPD7yFlEAZJlktT+FMWciVaVUTs="));
			$clearToday = new \DateTime(date("Y-m-d"));
			$clearDateDiff = $clearSeprtr->diff($clearToday);

			return $clearDateDiff->format("%y");
		} # ~sysnum()

		/*
		 * Method to encrypt local config file
		 */
		public function enclclcfg($ssb_encLCLCFGInput0, $ssb_encLCLCFGInput1, $ssb_encLCLCFGInput2, $ssb_encLCLCFGInput3="3306") {

			require_once(__DIR__ . "/../thirdparty/php-sha3/src/Sha3.php");
			$ssb_Hasher = new \bb\Sha3\Sha3();

			// generate unique key for encrypting
			$ssb_uniqKey = $ssb_Hasher->hash(uniqid(), 512);
			$ssb_sysPrefix = $ssb_Hasher->hash($this->sysnum(), 512);

			// encrypt sql data with unique key (generated above)
			$ssb_encLCLCFGData0 = $this->encrypt($ssb_encLCLCFGInput0, $ssb_uniqKey);
			$ssb_encLCLCFGData1 = $this->encrypt($ssb_encLCLCFGInput1, $ssb_uniqKey);
			$ssb_encLCLCFGData2 = $this->encrypt($ssb_encLCLCFGInput2, $ssb_uniqKey);
			$ssb_encLCLCFGData3 = $this->encrypt($ssb_encLCLCFGInput3, $ssb_uniqKey);

			// get through loop x times
			for($x=0;$x<=$this->sysnum();$x++) {
				$ssb_encLCLCFGData0 = $this->encrypt($ssb_encLCLCFGData0, $ssb_uniqKey);
				$ssb_encLCLCFGData1 = $this->encrypt($ssb_encLCLCFGData1, $ssb_uniqKey);
				$ssb_encLCLCFGData2 = $this->encrypt($ssb_encLCLCFGData2, $ssb_uniqKey);
				$ssb_encLCLCFGData3 = $this->encrypt($ssb_encLCLCFGData3, $ssb_uniqKey);
			} # ~for

			// return encrypted data
			return $ssb_encLCLCFGData0 . $ssb_sysPrefix . $ssb_uniqKey . $ssb_sysPrefix . $ssb_encLCLCFGData1 . $ssb_sysPrefix . $ssb_encLCLCFGData2 . $ssb_sysPrefix . $ssb_encLCLCFGData3;

		} # ~enclclcfg()

		/*
		 * Method to decrypt local config file
		 */
		public function declclcfg() {

			// create new instance of secure hash 3 class
			require_once(__DIR__ . "/../thirdparty/php-sha3/src/Sha3.php");
			$ssb_Hasher = new \bb\Sha3\Sha3();

			// get content of local config file
			$ssb_decFile = new \SYMBASE\BIN\File(SSB_CFGDIR . SSB_CFGFILE, "r");
			$ssb_decLCLCFGContent = $ssb_decFile->getContent();

			// read lclcfg file and seperate content
			$ssb_sysPrefix = $ssb_Hasher->hash($this->sysnum(), 512);
			$ssb_CFGArr = explode($ssb_sysPrefix, $ssb_decLCLCFGContent);

			// generate unique key for encrypting
			$ssb_uniqKey = $ssb_CFGArr[1];

			// decrypt sql data with unique key (generated above)
			$ssb_decLCLCFGData0 = $this->decrypt($ssb_CFGArr[0], $ssb_uniqKey);
			$ssb_decLCLCFGData1 = $this->decrypt($ssb_CFGArr[2], $ssb_uniqKey);
			$ssb_decLCLCFGData2 = $this->decrypt($ssb_CFGArr[3], $ssb_uniqKey);
			$ssb_decLCLCFGData3 = $this->decrypt($ssb_CFGArr[4], $ssb_uniqKey);

			// get through loop x times
			for($x=0;$x<=$this->sysnum();$x++) {
				$ssb_decLCLCFGData0 = $this->decrypt($ssb_decLCLCFGData0, $ssb_uniqKey);
				$ssb_decLCLCFGData1 = $this->decrypt($ssb_decLCLCFGData1, $ssb_uniqKey);
				$ssb_decLCLCFGData2 = $this->decrypt($ssb_decLCLCFGData2, $ssb_uniqKey);
				$ssb_decLCLCFGData3 = $this->decrypt($ssb_decLCLCFGData3, $ssb_uniqKey);
			} # ~for

			// give out decrypted sql data
			return array($ssb_decLCLCFGData0, $ssb_uniqKey, $ssb_decLCLCFGData1, $ssb_decLCLCFGData2, $ssb_decLCLCFGData3);

		} # ~declclcfg()

	} # ~Crypter
?> 