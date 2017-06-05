<?php 
	include(__DIR__ . "/../core/bin/view.class.php");
	use SYMBASE\BIN;
	$crypter = new BIN\Crypter;
	
	$val = "Passwort";
	$key = "testKey";
	
	echo "Value:\t" . $val . "<br />";
	echo "Key:\t". $key . "<br />";
	
	$enc_val = $crypter->encrypt($val, $key);
	echo "Encrypted Value: " . $enc_val . "<br />";
	echo "Decrypted Value: " . $crypter->decrypt($enc_val, $key) . "<br />";
	
	if($crypter->decrypt($enc_val, $key) == $val) {
		echo "<b>En/De-Crypting successfull!</b>";
	} else {
		echo "<b>Error</b>";
	}
?>