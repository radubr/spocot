<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Crypto by Radu Braniscan</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">
		<style>
		textarea {
		width: 90% !important;
		float: left;
		margin-right: 2% !important;
		}
		.block {
		width: 25%;
		float: left;
		}
		.container h2 {margin-top: 70px;}
		.container p {
			float: left;
		margin-right: 20px;
		}
		.container button {
		margin-top: 50px;
		}
		.container button.btn.btn-warning {
		float: left;
		margin-top: -34px;
		margin-left: 90px;
		}
		.first-color {
		color: green;
		font-size: 200%;
		}
		.second-color {
		color: red;
		font-size: 200%;
		}
		#modal-help:hover{
			cursor: pointer;
		}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">CRYPTO by Radu Brănișcan</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="encipher"><a href="#encipher">Encipher</a></li>
						<li><a href="#decipher">Decipher</a></li>
						<li><a href="#hash">Hash</a></li>
						<li><a href="#dehash">Dehash</a></li>
						<li><a id="modal-help" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
						<li><a target="_blank" href="index.txt"><span class="glyphicon glyphicon-eye-open"></span> Source code</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<span id="encipher"></span>
		<div class="container">
			<!-- Encipher -->
			<?php
			// for encrypting
			if (isset($_POST["ePlainText"])){
			$ePlainText = $_POST["ePlainText"];
			$eKey = $_POST["eKey"];
			$eCipher = $_POST["eCipher"];
			$eCipherText = openssl_encrypt($ePlainText, $eCipher, $eKey);
			// checks if the key of algoritm   is bigger than 10 chars if not
			// display error message and clear eCipherText
			if ( strlen($eKey) <= 10 ) {
			$eCipherText = "Error! Minimum key size length is 10 characters for RCx.";
			}
		}

			?>
			<h2><span class="first-color">E</span>ncipher</h2>
			<!-- http://jsfiddle.net/xp8u56eh/ -->
			<form action="index.php#encipher" method="post" accept-charset="utf-8">
				<span>Select cipher <br> (algorithm):</span>
				<select class="form-inline" name="eCipher">
				  <!-- retrieve the last used algorithm if any -->
				  <?php function is_eCipher_set(){global $eCipher;if($eCipher != "") {return $eCipher;} else {echo "nu";} } ?>
				  <?php if(is_eCipher_set()){echo '<option value="' . is_eCipher_set() . '">' . is_eCipher_set() . '</option>';} ?>
				  <option value="aes-128-cbc">aes-128-cbc</option>
					<option value="aes-128-cfb">aes-128-cfb</option>
					<option value="aes-128-cfb1">aes-128-cfb1</option>
					<option value="aes-128-cfb8">aes-128-cfb8</option>
					<option value="aes-128-ecb">aes-128-ecb</option>
					<option value="aes-128-ofb">aes-128-ofb</option>
					<option value="aes-192-cbc">aes-192-cbc</option>
					<option value="aes-192-cfb">aes-192-cfb</option>
					<option value="aes-192-cfb1">aes-192-cfb1</option>
					<option value="aes-192-cfb8">aes-192-cfb8</option>
					<option value="aes-192-ecb">aes-192-ecb</option>
					<option value="aes-192-ofb">aes-192-ofb</option>
					<option value="aes-256-cbc">aes-256-cbc</option>
					<option value="aes-256-cfb">aes-256-cfb</option>
					<option value="aes-256-cfb1">aes-256-cfb1</option>
					<option value="aes-256-cfb8">aes-256-cfb8</option>
					<option value="aes-256-ecb">aes-256-ecb</option>
					<option value="aes-256-ofb">aes-256-ofb</option>
					<option value="bf-cbc">bf-cbc</option>
					<option value="bf-cfb">bf-cfb</option>
					<option value="bf-ecb">bf-ecb</option>
					<option value="bf-ofb">bf-ofb</option>
					<option value="cast5-cbc">cast5-cbc</option>
					<option value="cast5-cfb">cast5-cfb</option>
					<option value="cast5-ecb">cast5-ecb</option>
					<option value="cast5-ofb">cast5-ofb</option>
					<option value="des-cbc">des-cbc</option>
					<option value="des-cfb">des-cfb</option>
					<option value="des-cfb1">des-cfb1</option>
					<option value="des-cfb8">des-cfb8</option>
					<option value="des-ecb">des-ecb</option>
					<option value="des-ede">des-ede</option>
					<option value="des-ede-cbc">des-ede-cbc</option>
					<option value="des-ede-cfb">des-ede-cfb</option>
					<option value="des-ede-ofb">des-ede-ofb</option>
					<option value="des-ede3">des-ede3</option>
					<option value="des-ede3-cbc">des-ede3-cbc</option>
					<option value="des-ede3-cfb">des-ede3-cfb</option>
					<option value="des-ede3-ofb">des-ede3-ofb</option>
					<option value="des-ofb">des-ofb</option>
					<option value="desx-cbc">desx-cbc</option>
					<option value="idea-cbc">idea-cbc</option>
					<option value="idea-cfb">idea-cfb</option>
					<option value="idea-ecb">idea-ecb</option>
					<option value="idea-ofb">idea-ofb</option>
					<option value="rc2-40-cbc">rc2-40-cbc</option>
					<option value="rc2-64-cbc">rc2-64-cbc</option>
					<option value="rc2-cbc">rc2-cbc</option>
					<option value="rc2-cfb">rc2-cfb</option>
					<option value="rc2-ecb">rc2-ecb</option>
					<option value="rc2-ofb">rc2-ofb</option>
					<option value="rc4">rc4</option>
					<option value="rc4-40">rc4-40</option>
				</select>
				<br>
				<br>
				<div class="block">
					<p>Plain text: </p>
					<textarea required name="ePlainText" class="form-control" rows="3" cols="1" id="ePlainText"><?php if (isset($ePlainText)) {echo htmlspecialchars($ePlainText); } ?></textarea>
					<span id="chars-ePlainText"></span> chars
				</div>
				<div class="block">
					<p>Key: </p>
					<textarea name="eKey" class="form-control" rows="3" id="eKey"><?php if (isset($eKey)) { echo htmlspecialchars($eKey); } ?></textarea>
					<span id="chars-eKey"></span> chars
				</div>
				<div class="block">
					<p>Cipher text: </p>
					<textarea readonly name="eCipherText" class="form-control" rows="3" id="eCipherText"><?php if(isset($eCipherText)) { echo htmlspecialchars($eCipherText); } ?></textarea>
					<span id="chars-eCipherText"></span> chars
				</div>
				<span id="decipher"></span>
				<button type="submit" class="btn btn-primary">Encipher</button>
			</form>
			<form action="index.php#encipher" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
			<!-- Decipher -->
			<?php
			//for decrypting
			// $dPlainText = "The text could not be decrypted.";
			if (isset($_POST["dCipherText"])){
			$dCipherText = $_POST["dCipherText"];
			$dKey = $_POST["dKey"];
			$dCipher = $_POST["dCipher"];
			$dPlainText = openssl_decrypt($dCipherText, $dCipher, $dKey);
			}
			// if ($dPlainText == ""){
					// 		$dPlainText = "The text could not be decrypted.";
			// }
			if (isset($_POST["dCipherText"]) && mb_detect_encoding($dPlainText) == "UTF-8"){
					$dPlainText = "The text could not be decrypted.";
			}
			?>
			<h2><span class="second-color">D</span>ecipher</h2>
			<form action="index.php#deciph" method="post" accept-charset="utf-8">
				<span>Select cipher <br> (algorithm):</span>
				<select class="form-inline" name="dCipher">
					<!-- retrieve the last used algorithm if any -->
				  <?php function is_dCipher_set(){global $dCipher;if($dCipher != "") {return $dCipher;} else {echo "nu";} } ?>
				  <?php if(is_dCipher_set()){echo '<option value="' . is_dCipher_set() . '">' . is_dCipher_set() . '</option>';} ?>
					<option value="aes-128-cbc">aes-128-cbc</option>
					<option value="aes-128-cfb">aes-128-cfb</option>
					<option value="aes-128-cfb1">aes-128-cfb1</option>
					<option value="aes-128-cfb8">aes-128-cfb8</option>
					<option value="aes-128-ecb">aes-128-ecb</option>
					<option value="aes-128-ofb">aes-128-ofb</option>
					<option value="aes-192-cbc">aes-192-cbc</option>
					<option value="aes-192-cfb">aes-192-cfb</option>
					<option value="aes-192-cfb1">aes-192-cfb1</option>
					<option value="aes-192-cfb8">aes-192-cfb8</option>
					<option value="aes-192-ecb">aes-192-ecb</option>
					<option value="aes-192-ofb">aes-192-ofb</option>
					<option value="aes-256-cbc">aes-256-cbc</option>
					<option value="aes-256-cfb">aes-256-cfb</option>
					<option value="aes-256-cfb1">aes-256-cfb1</option>
					<option value="aes-256-cfb8">aes-256-cfb8</option>
					<option value="aes-256-ecb">aes-256-ecb</option>
					<option value="aes-256-ofb">aes-256-ofb</option>
					<option value="bf-cbc">bf-cbc</option>
					<option value="bf-cfb">bf-cfb</option>
					<option value="bf-ecb">bf-ecb</option>
					<option value="bf-ofb">bf-ofb</option>
					<option value="cast5-cbc">cast5-cbc</option>
					<option value="cast5-cfb">cast5-cfb</option>
					<option value="cast5-ecb">cast5-ecb</option>
					<option value="cast5-ofb">cast5-ofb</option>
					<option value="des-cbc">des-cbc</option>
					<option value="des-cfb">des-cfb</option>
					<option value="des-cfb1">des-cfb1</option>
					<option value="des-cfb8">des-cfb8</option>
					<option value="des-ecb">des-ecb</option>
					<option value="des-ede">des-ede</option>
					<option value="des-ede-cbc">des-ede-cbc</option>
					<option value="des-ede-cfb">des-ede-cfb</option>
					<option value="des-ede-ofb">des-ede-ofb</option>
					<option value="des-ede3">des-ede3</option>
					<option value="des-ede3-cbc">des-ede3-cbc</option>
					<option value="des-ede3-cfb">des-ede3-cfb</option>
					<option value="des-ede3-ofb">des-ede3-ofb</option>
					<option value="des-ofb">des-ofb</option>
					<option value="desx-cbc">desx-cbc</option>
					<option value="idea-cbc">idea-cbc</option>
					<option value="idea-cfb">idea-cfb</option>
					<option value="idea-ecb">idea-ecb</option>
					<option value="idea-ofb">idea-ofb</option>
					<option value="rc2-40-cbc">rc2-40-cbc</option>
					<option value="rc2-64-cbc">rc2-64-cbc</option>
					<option value="rc2-cbc">rc2-cbc</option>
					<option value="rc2-cfb">rc2-cfb</option>
					<option value="rc2-ecb">rc2-ecb</option>
					<option value="rc2-ofb">rc2-ofb</option>
					<option value="rc4">rc4</option>
					<option value="rc4-40">rc4-40</option>
				</select>
				<br>
				<br>
				<div class="block">
					<p>Cipher text</p>
					<textarea required name="dCipherText" class="form-control" rows="3"><?php if (isset($dCipherText)) { echo htmlspecialchars($dCipherText); } ?></textarea>
				</div>
				<div class="block">
					<p>Key</p>
					<textarea name="dKey" class="form-control" rows="3"><?php if (isset($dKey)) { echo htmlspecialchars($dKey); } ?></textarea>
				</div>
				<div class="block">
					<p>Plain text</p>
					<textarea readonly name="dPlainText" class="form-control" rows="3" cols="1"><?php if(isset($dPlainText)) { echo htmlspecialchars($dPlainText); } ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Decipher</button>
			</form>
			<form action="index.php#decipher" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
			<!-- Hash -->
			<?php
			if (isset($_POST["hPText"])){
			$hPText = $_POST["hPText"];
			$hAlgo = $_POST["hAlgo"];
			$hHText = hash($hAlgo, $hPText);
			}
			?>
			<h2 id="hash"><span class="first-color">H</span>ash</h2>
			<form action="index.php#hash" method="post" accept-charset="utf-8">
				<span>Select hashing algorithm:</span>
				<select class="form-inline" name="hAlgo">
				  <!-- retrieve the last used algorithm if any -->
				  <?php function is_hAlgo_set(){global $hAlgo;if($hAlgo != "") {return $hAlgo;} else {echo "nu";} } ?>
				  <?php if(is_hAlgo_set()){echo '<option value="' . is_hAlgo_set() . '">' . is_hAlgo_set() . '</option>';} ?>
				  <option value="md2">md2</option>
					<option value="md4">md4</option>
					<option value="md5">md5</option>
					<option value="sha1">sha1</option>
					<option value="sha224">sha224</option>
					<option value="sha256">sha256</option>
					<option value="sha384">sha384</option>
					<option value="sha512">sha512</option>
					<option value="ripemd128">ripemd128</option>
					<option value="ripemd160">ripemd160</option>
					<option value="ripemd256">ripemd256</option>
					<option value="ripemd320">ripemd320</option>
					<option value="whirlpool">whirlpool</option>
					<option value="tiger128,3">tiger128,3</option>
					<option value="tiger160,3">tiger160,3</option>
					<option value="tiger192,3">tiger192,3</option>
					<option value="tiger128,4">tiger128,4</option>
					<option value="tiger160,4">tiger160,4</option>
					<option value="tiger192,4">tiger192,4</option>
					<option value="snefru">snefru</option>
					<option value="snefru256">snefru256</option>
					<option value="gost">gost</option>
					<option value="gost-crypto">gost-crypto</option>
					<option value="adler32">adler32</option>
					<option value="crc32">crc32</option>
					<option value="crc32b">crc32b</option>
					<option value="fnv132">fnv132</option>
					<option value="fnv1a32">fnv1a32</option>
					<option value="fnv164">fnv164</option>
					<option value="fnv1a64">fnv1a64</option>
					<option value="joaat">joaat</option>
					<option value="haval128,3">haval128,3</option>
					<option value="haval160,3">haval160,3</option>
					<option value="haval192,3">haval192,3</option>
					<option value="haval224,3">haval224,3</option>
					<option value="haval256,3">haval256,3</option>
					<option value="haval128,4">haval128,4</option>
					<option value="haval160,4">haval160,4</option>
					<option value="haval192,4">haval192,4</option>
					<option value="haval224,4">haval224,4</option>
					<option value="haval256,4">haval256,4</option>
					<option value="haval128,5">haval128,5</option>
					<option value="haval160,5">haval160,5</option>
					<option value="haval192,5">haval192,5</option>
					<option value="haval224,5">haval224,5</option>
					<option value="haval256,5">haval256,5</option>
				</select>
				<br>
				<br>
				<div class="block">
					<p>Plain text</p>
					<textarea required name="hPText" class="form-control" rows="3"><?php if (isset($hPText)) { echo htmlspecialchars($hPText); } ?></textarea>
				</div>
				<div class="block">
					<p>Hashed text</p>
					<textarea readonly name="hHText" class="form-control" rows="3" cols="1"><?php if(isset($hHText)) { echo htmlspecialchars($hHText); } ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Hash</button>
			</form>
			<form action="index.php#hash" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
			<!-- Dehash -->
			<?php
			if (isset($_POST["dhPText"])){
			$dhPText = $_POST["dhPText"];
			switch ($dhPText) {
			case "19cb29c236b55893fd1f234253f567a17e393048fbfb0c2a664fd68f824d3917":
			$dhHText = "radu1234";
			break;
			case "0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e":
			$dhHText = "password1";
			break;
			default:
			$dhHText = "There is no hash in the rainbow table yet.";
			}
			}
			?>
			<h2 id="dehash"><span class="second-color">D</span>ehash</h2>
			<form action="index.php#dehash" method="post" accept-charset="utf-8">
				<span>Dehashing using sha256</span>
				<br>
				<br>
				<div class="block">
					<p>Hashed text</p>
					<textarea required name="dhPText" class="form-control" rows="3"><?php if (isset($dhPText)) { echo htmlspecialchars($dhPText); } ?></textarea>
				</div>
				<div class="block">
					<p>Plain text</p>
					<textarea readonly name="dhHText" class="form-control" rows="3" cols="1"><?php if(isset($dhHText)) { echo htmlspecialchars($dhHText); } ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Dehash</button>
			</form>
			<form action="index.php#dehash" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>


		<!-- Asymmetric Encryption -->
		<!-- Generate  private & public key -->
<?php
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);

// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

$data = 'plaintext data goes here';


// Encrypt the data to $encrypted using the public key
openssl_public_encrypt($data, $encrypted, $pubKey);

// Decrypt the data using the private key and store the results in $decrypted
openssl_private_decrypt($encrypted, $decrypted, $privKey);

?>


			<h2><span class="first-color">A</span>symmetric Encryption</h2>
			<h3 id="ppKeys">Generate private &amp; public key</h3>
			<form action="index.php#ppKeys" method="post" accept-charset="utf-8">
				<div class="block">
					<p>Private key</p>
					<textarea readonly name="pphPText" class="form-control" rows="3"><?php  echo $privKey;   ?></textarea>
				</div>
				<div class="block">
					<p>Pass phrase (optional)</p>
					<textarea name="pphPText" class="form-control" rows="3"><?php  echo $passphrase;   ?></textarea>
				</div>
				<div class="block">
					<p>Public key</p>
					<textarea readonly name="pphHText" class="form-control" rows="3" cols="1"><?php echo $pubKey; ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Generate</button>
			</form>
			<form action="index.php#ppKeys" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
		<br>
		<br>
					<h3 id="ppKeys2">Encrypt</h3>
<form action="index.php#ppKeys2" method="post" accept-charset="utf-8">

				<div class="block">
					<p>Plain text: </p>
					<textarea required name="ppePlainText" class="form-control" rows="3" cols="1" id="ePlainText"><?php if (isset($ppePlainText)) {echo htmlspecialchars($ePlainText); } ?></textarea>

				</div>
				<div class="block">
					<p>Public Key: </p>
					<textarea name="ppeKey" class="form-control" rows="3" id="eKey"><?php if (isset($ppeKey)) { echo htmlspecialchars($eKey); } ?></textarea>

				</div>
				<div class="block">
					<p>Cipher text: </p>
					<textarea readonly name="ppeCipherText" class="form-control" rows="3" id="eCipherText"><?php if(isset($ppeCipherText)) { echo htmlspecialchars($eCipherText); } ?></textarea>

				</div>
				<span id="decipher"></span>
				<button type="submit" class="btn btn-primary">Encipher</button>
			</form>
			<form action="index.php#ppKeys2" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>

<br>
<br>
			<h3 id="ppKeys3">Decrypt</h3>
			<form action="index.php#ppKeys3" method="post" accept-charset="utf-8">

				<div class="block">
					<p>Cipher text</p>
					<textarea required name="ppdCipherText" class="form-control" rows="3"><?php if (isset($ppdCipherText)) { echo htmlspecialchars($dCipherText); } ?></textarea>
				</div>
				<div class="block">
					<p>Private Key</p>
					<textarea name="ppdKey" class="form-control" rows="3"><?php if (isset($ppdKey)) { echo htmlspecialchars($dKey); } ?></textarea>
				</div>
				<div class="block">
					<p>Plain text</p>
					<textarea readonly name="ppdPlainText" class="form-control" rows="3" cols="1"><?php if(isset($ppdPlainText)) { echo htmlspecialchars($dPlainText); } ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Decipher</button>
			</form>
			<form action="index.php#decipher" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
						<br>
						<br>
		</div>
		<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Help</h4>
      </div>
      <div class="modal-body">
        <p>Crypto is a free online cryptographic service. It uses the OpenSSL cryptography extension for PHP. <sup><a href="http://php.net/manual/en/book.openssl.php">documentation</a></sup><br>
        Update: <br>
				18/05/2015 - displays the last used algorithm where is the case
        06/05/2015 - added asymmetric encryption and decryption
        28/04/2015 - added 44 hashing algorithms Hash cryptography extension for PHP <sup><a href="http://php.net/manual/en/book.hash.php">documentation</a></sup>
        21/04/2015 - current project version 1.2 tested successfully on Apache/2.4.3 (Win32) OpenSSL/1.0.1c PHP/5.4.7.</p>
        <ul><strong>TO DO</strong>: two more operations:
        	<li>In the beginning you need to create a key pair</li>
        	<li>Asymmetric encryption/decryption</li>
        	<li>Asymmetric signature/verification</li>
        </ul>
				<a target="_blank" href="index.txt"><span class="glyphicon glyphicon-eye-open"></span> Source code of the project is avaiable here</a></li>
      	<p>Contact me: radu [at] proappsoft.com</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<script src="Countable.js"></script>
		<script>
			var ePlainText = document.getElementById('ePlainText');
			var eKey = document.getElementById('eKey');
			var eCipherText = document.getElementById('eCipherText');
		Countable.live(ePlainText, function (counter) {
		var allchars = counter.all;
		document.getElementById("chars-ePlainText").innerHTML = allchars;
		});
		Countable.live(eKey, function (counter) {
		var allchars = counter.all;
		document.getElementById("chars-eKey").innerHTML = allchars;
		});
		Countable.live(eCipherText, function (counter) {
		var allchars = counter.all;
		document.getElementById("chars-eCipherText").innerHTML = allchars;
		});

		$("textarea").on("click", function (e) {
    $(this).tooltip("show");
});


$(".form-control").click(function() {
    var $this = $(this);
    $this.select();

    // Work around Chrome's little problem
    $this.mouseup(function() {
        // Prevent further mouseup intervention
        $this.unbind("mouseup");
        return false;
    });
});

		</script>
	</body>
</html>
