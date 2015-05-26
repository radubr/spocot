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
.se {
  border: 5px solid rgba(232, 232, 232, 1);
  background-color: rgba(232, 232, 232, 0.34);
}
.ae {
  border: 5px solid rgba(77, 77, 77, 0.27);
  background-color: rgba(232, 232, 232, 1);
}
.fix-fc {
	  width: 15%;
  display: inline-block;
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
		.third-color {
		color: purple;
		font-size: 200%;
		}
		#modal-help:hover{
			cursor: pointer;
		}
		.no-js #loader { display: none;  }
		.js #loader { display: block; position: absolute; left: 100px; top: 0; }
		.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(preloader-atom.gif) center no-repeat #fff;
		/*background: url(preloader-atom.gif) center no-repeat rgba(255, 255, 255, 0.56);*/
		}
		</style>
	</head>
	<body>
		<div class="se-pre-con"></div>
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
						<!-- <li class="encipher"><a href="#encipher">Encipher</a></li> -->
						<!-- <li><a href="#decipher">Decipher</a></li> -->
						<!-- <li><a href="#hash">Hash</a></li> -->
						<!-- <li><a href="#dehash">Dehash</a></li> -->
						<li><a id="modal-help" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-sign"></span> Help</a></li>
						<li><a target="_blank" href="index.txt"><span class="glyphicon glyphicon-eye-open"></span> Source code</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<span id="encipher"></span>
		<div class="container se">
			<!-- Encipher -->
			<!-- useful doc about openssl_encrypt http://thefsb.tumblr.com/post/110749271235/using-openssl-en-decrypt-in-php-instead-of -->
			<?php
			$eIV = mt_rand(10000001, 99999999);
			// for encrypting
			if (isset($_POST["ePlainText"])){
			$ePlainText = $_POST["ePlainText"];
			$eKey = $_POST["eKey"];
			// $eKey2 = bin2hex($_POST["eKey"]);
			$eCipher = $_POST["eCipher"];
			// if ($_POST["eIV"] == ""){
								// 	$_POST["eIV"] = $eIV;
			// }
			if (substr( $eCipher, 0, 3 ) === "aes"){
				$eIV = mt_rand(1000000000000001, 9999999999999999);
			} else if (substr( $eCipher, 0, 3 ) != "aes"){
				$eIV = mt_rand(10000001, 99999999);
			} else {$eIV = $_POST["eIV"];}

		 	if (substr( $eCipher, -3 ) === "ecb" || substr( $eCipher, 0, 3 ) === "rc4" || substr( $eCipher, -3 ) === "ede" || substr( $eCipher, -3 ) === "de3"){
			 	$eIV = "";
			 	$eCipherText = openssl_encrypt($ePlainText, $eCipher, $eKey, false, $eIV);
			 } else {
			 	$eCipherText = openssl_encrypt($ePlainText, $eCipher, $eKey, false, $eIV);
			 }
			// checks if the key of algoritm   is bigger than 10 chars if not
			// display error message and clear eCipherText
			// if ( strlen($eKey) <= 10 ) {
			// $eCipherText = "Error! Minimum key size length is 10 characters for RCx.";
			// }
			}
			?>
			<h2><span class="third-color">S</span>ymmetric Encryption</h2>
			<h2 style="margin-top: 0;"><span class="first-color">E</span>ncipher</h2>
			<!-- generates dropdown list of ciphers -->
			<!-- http://jsfiddle.net/xp8u56eh/ -->
			<form action="index.php#encipher" method="post" accept-charset="utf-8">
				<span>Select cipher (algorithm):</span>
				<select class="form-inline form-control fix-fc" name="eCipher">
					<!-- retrieve the last used algorithm if any -->
					<?php function checkECipher($vECipher){global $eCipher; if($eCipher == $vECipher) {echo 'selected';} } ?>
					<option <?php checkECipher("aes-128-cbc") ?> value="aes-128-cbc">aes-128-cbc</option>
					<option <?php checkECipher("aes-128-cfb") ?> value="aes-128-cfb">aes-128-cfb</option>
					<option <?php checkECipher("aes-128-cfb1") ?> value="aes-128-cfb1">aes-128-cfb1</option>
					<option <?php checkECipher("aes-128-cfb8") ?> value="aes-128-cfb8">aes-128-cfb8</option>
					<option <?php checkECipher("aes-128-ecb") ?> value="aes-128-ecb">aes-128-ecb</option>
					<option <?php checkECipher("aes-128-ofb") ?> value="aes-128-ofb">aes-128-ofb</option>
					<option <?php checkECipher("aes-192-cbc") ?> value="aes-192-cbc">aes-192-cbc</option>
					<option <?php checkECipher("aes-192-cfb") ?> value="aes-192-cfb">aes-192-cfb</option>
					<option <?php checkECipher("aes-192-cfb1") ?> value="aes-192-cfb1">aes-192-cfb1</option>
					<option <?php checkECipher("aes-192-cfb8") ?> value="aes-192-cfb8">aes-192-cfb8</option>
					<option <?php checkECipher("aes-192-ecb") ?> value="aes-192-ecb">aes-192-ecb</option>
					<option <?php checkECipher("aes-192-ofb") ?> value="aes-192-ofb">aes-192-ofb</option>
					<option <?php checkECipher("aes-256-cbc") ?> value="aes-256-cbc">aes-256-cbc</option>
					<option <?php checkECipher("aes-256-cfb") ?> value="aes-256-cfb">aes-256-cfb</option>
					<option <?php checkECipher("aes-256-cfb1") ?> value="aes-256-cfb1">aes-256-cfb1</option>
					<option <?php checkECipher("aes-256-cfb8") ?> value="aes-256-cfb8">aes-256-cfb8</option>
					<option <?php checkECipher("aes-256-ecb") ?> value="aes-256-ecb">aes-256-ecb</option>
					<option <?php checkECipher("aes-256-ofb") ?> value="aes-256-ofb">aes-256-ofb</option>
					<option <?php checkECipher("bf-cbc") ?> value="bf-cbc">bf-cbc</option>
					<option <?php checkECipher("bf-cfb") ?> value="bf-cfb">bf-cfb</option>
					<option <?php checkECipher("bf-ecb") ?> value="bf-ecb">bf-ecb</option>
					<option <?php checkECipher("bf-ofb") ?> value="bf-ofb">bf-ofb</option>
					<option <?php checkECipher("cast5-cbc") ?> value="cast5-cbc">cast5-cbc</option>
					<option <?php checkECipher("cast5-cfb") ?> value="cast5-cfb">cast5-cfb</option>
					<option <?php checkECipher("cast5-ecb") ?> value="cast5-ecb">cast5-ecb</option>
					<option <?php checkECipher("cast5-ofb") ?> value="cast5-ofb">cast5-ofb</option>
					<option <?php checkECipher("des-cbc") ?> value="des-cbc">des-cbc</option>
					<option <?php checkECipher("des-cfb") ?> value="des-cfb">des-cfb</option>
					<option <?php checkECipher("des-cfb1") ?> value="des-cfb1">des-cfb1</option>
					<option <?php checkECipher("des-cfb8") ?> value="des-cfb8">des-cfb8</option>
					<option <?php checkECipher("des-ecb") ?> value="des-ecb">des-ecb</option>
					<option <?php checkECipher("des-ede") ?> value="des-ede">des-ede</option>
					<option <?php checkECipher("des-ede-cbc") ?> value="des-ede-cbc">des-ede-cbc</option>
					<option <?php checkECipher("des-ede-cfb") ?> value="des-ede-cfb">des-ede-cfb</option>
					<option <?php checkECipher("des-ede-ofb") ?> value="des-ede-ofb">des-ede-ofb</option>
					<option <?php checkECipher("des-ede3") ?> value="des-ede3">des-ede3</option>
					<option <?php checkECipher("des-ede3-cbc") ?> value="des-ede3-cbc">des-ede3-cbc</option>
					<option <?php checkECipher("des-ede3-cfb") ?> value="des-ede3-cfb">des-ede3-cfb</option>
					<option <?php checkECipher("des-ede3-ofb") ?> value="des-ede3-ofb">des-ede3-ofb</option>
					<option <?php checkECipher("des-ofb") ?> value="des-ofb">des-ofb</option>
					<option <?php checkECipher("desx-cbc") ?> value="desx-cbc">desx-cbc</option>
					<option <?php checkECipher("idea-cbc") ?> value="idea-cbc">idea-cbc</option>
					<option <?php checkECipher("idea-cfb") ?> value="idea-cfb">idea-cfb</option>
					<option <?php checkECipher("idea-ecb") ?> value="idea-ecb">idea-ecb</option>
					<option <?php checkECipher("idea-ofb") ?> value="idea-ofb">idea-ofb</option>
					<option <?php checkECipher("rc2-40-cbc") ?> value="rc2-40-cbc">rc2-40-cbc</option>
					<option <?php checkECipher("rc2-64-cbc") ?> value="rc2-64-cbc">rc2-64-cbc</option>
					<option <?php checkECipher("rc2-cbc") ?> value="rc2-cbc">rc2-cbc</option>
					<option <?php checkECipher("rc2-cfb") ?> value="rc2-cfb">rc2-cfb</option>
					<option <?php checkECipher("rc2-ecb") ?> value="rc2-ecb">rc2-ecb</option>
					<option <?php checkECipher("rc2-ofb") ?> value="rc2-ofb">rc2-ofb</option>
					<option <?php checkECipher("rc4") ?> value="rc4">rc4</option>
					<option <?php checkECipher("rc4-40") ?> value="rc4-40">rc4-40</option>
				</select>
				<span>IV (initialization vector): <input type="text" name="eIV" id="eIV" class="form-control fix-fc" value="<?php if (isset($eIV)) {echo htmlspecialchars($eIV); } else if (substr( $eCipher, -3 ) === "ecb") {echo ""; } ?>" disabled> <span id="chars-eIV"></span> chars</span>

				<br>
				<br>
				<?php
				// lets assume you just called an openssl function that failed
				while ($msg = openssl_error_string())
				echo $msg . "<br />\n";
				?>
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
					<textarea readonly name="eCipherText" class="form-control res" rows="3" id="eCipherText"><?php if(isset($eCipherText)) { echo htmlspecialchars($eCipherText); } ?></textarea>
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
			$dIV = $_POST["dIV"];
			$dPlainText = openssl_decrypt($dCipherText, $dCipher, $dKey, false, $dIV);
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
				<span>Select cipher (algorithm):</span>
				<select class="form-inline form-control fix-fc" name="dCipher">
					<!-- retrieve the last used algorithm if any -->
					<?php function checkDCipher($vDCipher){global $dCipher; if($dCipher == $vDCipher) {echo 'selected';} } ?>
					<option <?php checkDCipher("aes-128-cbc") ?> value="aes-128-cbc">aes-128-cbc</option>
					<option <?php checkDCipher("aes-128-cfb") ?> value="aes-128-cfb">aes-128-cfb</option>
					<option <?php checkDCipher("aes-128-cfb1") ?> value="aes-128-cfb1">aes-128-cfb1</option>
					<option <?php checkDCipher("aes-128-cfb8") ?> value="aes-128-cfb8">aes-128-cfb8</option>
					<option <?php checkDCipher("aes-128-ecb") ?> value="aes-128-ecb">aes-128-ecb</option>
					<option <?php checkDCipher("aes-128-ofb") ?> value="aes-128-ofb">aes-128-ofb</option>
					<option <?php checkDCipher("aes-192-cbc") ?> value="aes-192-cbc">aes-192-cbc</option>
					<option <?php checkDCipher("aes-192-cfb") ?> value="aes-192-cfb">aes-192-cfb</option>
					<option <?php checkDCipher("aes-192-cfb1") ?> value="aes-192-cfb1">aes-192-cfb1</option>
					<option <?php checkDCipher("aes-192-cfb8") ?> value="aes-192-cfb8">aes-192-cfb8</option>
					<option <?php checkDCipher("aes-192-ecb") ?> value="aes-192-ecb">aes-192-ecb</option>
					<option <?php checkDCipher("aes-192-ofb") ?> value="aes-192-ofb">aes-192-ofb</option>
					<option <?php checkDCipher("aes-256-cbc") ?> value="aes-256-cbc">aes-256-cbc</option>
					<option <?php checkDCipher("aes-256-cfb") ?> value="aes-256-cfb">aes-256-cfb</option>
					<option <?php checkDCipher("aes-256-cfb1") ?> value="aes-256-cfb1">aes-256-cfb1</option>
					<option <?php checkDCipher("aes-256-cfb8") ?> value="aes-256-cfb8">aes-256-cfb8</option>
					<option <?php checkDCipher("aes-256-ecb") ?> value="aes-256-ecb">aes-256-ecb</option>
					<option <?php checkDCipher("aes-256-ofb") ?> value="aes-256-ofb">aes-256-ofb</option>
					<option <?php checkDCipher("bf-cbc") ?> value="bf-cbc">bf-cbc</option>
					<option <?php checkDCipher("bf-cfb") ?> value="bf-cfb">bf-cfb</option>
					<option <?php checkDCipher("bf-ecb") ?> value="bf-ecb">bf-ecb</option>
					<option <?php checkDCipher("bf-ofb") ?> value="bf-ofb">bf-ofb</option>
					<option <?php checkDCipher("cast5-cbc") ?> value="cast5-cbc">cast5-cbc</option>
					<option <?php checkDCipher("cast5-cfb") ?> value="cast5-cfb">cast5-cfb</option>
					<option <?php checkDCipher("cast5-ecb") ?> value="cast5-ecb">cast5-ecb</option>
					<option <?php checkDCipher("cast5-ofb") ?> value="cast5-ofb">cast5-ofb</option>
					<option <?php checkDCipher("des-cbc") ?> value="des-cbc">des-cbc</option>
					<option <?php checkDCipher("des-cfb") ?> value="des-cfb">des-cfb</option>
					<option <?php checkDCipher("des-cfb1") ?> value="des-cfb1">des-cfb1</option>
					<option <?php checkDCipher("des-cfb8") ?> value="des-cfb8">des-cfb8</option>
					<option <?php checkDCipher("des-ecb") ?> value="des-ecb">des-ecb</option>
					<option <?php checkDCipher("des-ede") ?> value="des-ede">des-ede</option>
					<option <?php checkDCipher("des-ede-cbc") ?> value="des-ede-cbc">des-ede-cbc</option>
					<option <?php checkDCipher("des-ede-cfb") ?> value="des-ede-cfb">des-ede-cfb</option>
					<option <?php checkDCipher("des-ede-ofb") ?> value="des-ede-ofb">des-ede-ofb</option>
					<option <?php checkDCipher("des-ede3") ?> value="des-ede3">des-ede3</option>
					<option <?php checkDCipher("des-ede3-cbc") ?> value="des-ede3-cbc">des-ede3-cbc</option>
					<option <?php checkDCipher("des-ede3-cfb") ?> value="des-ede3-cfb">des-ede3-cfb</option>
					<option <?php checkDCipher("des-ede3-ofb") ?> value="des-ede3-ofb">des-ede3-ofb</option>
					<option <?php checkDCipher("des-ofb") ?> value="des-ofb">des-ofb</option>
					<option <?php checkDCipher("desx-cbc") ?> value="desx-cbc">desx-cbc</option>
					<option <?php checkDCipher("idea-cbc") ?> value="idea-cbc">idea-cbc</option>
					<option <?php checkDCipher("idea-cfb") ?> value="idea-cfb">idea-cfb</option>
					<option <?php checkDCipher("idea-ecb") ?> value="idea-ecb">idea-ecb</option>
					<option <?php checkDCipher("idea-ofb") ?> value="idea-ofb">idea-ofb</option>
					<option <?php checkDCipher("rc2-40-cbc") ?> value="rc2-40-cbc">rc2-40-cbc</option>
					<option <?php checkDCipher("rc2-64-cbc") ?> value="rc2-64-cbc">rc2-64-cbc</option>
					<option <?php checkDCipher("rc2-cbc") ?> value="rc2-cbc">rc2-cbc</option>
					<option <?php checkDCipher("rc2-cfb") ?> value="rc2-cfb">rc2-cfb</option>
					<option <?php checkDCipher("rc2-ecb") ?> value="rc2-ecb">rc2-ecb</option>
					<option <?php checkDCipher("rc2-ofb") ?> value="rc2-ofb">rc2-ofb</option>
					<option <?php checkDCipher("rc4") ?> value="rc4">rc4</option>
					<option <?php checkDCipher("rc4-40") ?> value="rc4-40">rc4-40</option>
				</select>
				<span>IV (initialization vector): <input type="text" name="dIV" id="dIV" class="form-control fix-fc" value="<?php if (isset($dIV)) {echo htmlspecialchars($dIV); } ?>"></span>
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
					<textarea readonly name="dPlainText" class="form-control res" rows="3" cols="1"><?php if(isset($dPlainText)) { echo htmlspecialchars($dPlainText); } ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Decipher</button>
			</form>
			<form action="index.php#decipher" method="post" accept-charset="utf-8">
				<span id="hash"></span>
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
			<h2><span class="first-color">H</span>ash</h2>
			<form action="index.php#hash" method="post" accept-charset="utf-8">
				<span>Select hashing algorithm:</span>
				<select class="form-inline form-control fix-fc" name="hAlgo">
					<!-- retrieve the last used algorithm if any -->
					<?php function checkHAlgo($vCHAlgo){global $hAlgo; if($hAlgo == $vCHAlgo) {echo 'selected';} } ?>
					<option <?php checkHAlgo("md2") ?> value="md2">md2</option>
					<option <?php checkHAlgo("md4") ?> value="md4">md4</option>
					<option <?php checkHAlgo("md5") ?> value="md5">md5</option>
					<option <?php checkHAlgo("sha1") ?> value="sha1">sha1</option>
					<option <?php checkHAlgo("sha224") ?> value="sha224">sha224</option>
					<option <?php checkHAlgo("sha256") ?> value="sha256">sha256</option>
					<option <?php checkHAlgo("sha384") ?> value="sha384">sha384</option>
					<option <?php checkHAlgo("sha512") ?> value="sha512">sha512</option>
					<option <?php checkHAlgo("ripemd128") ?> value="ripemd128">ripemd128</option>
					<option <?php checkHAlgo("ripemd160") ?> value="ripemd160">ripemd160</option>
					<option <?php checkHAlgo("ripemd256") ?> value="ripemd256">ripemd256</option>
					<option <?php checkHAlgo("ripemd320") ?> value="ripemd320">ripemd320</option>
					<option <?php checkHAlgo("whirlpool") ?> value="whirlpool">whirlpool</option>
					<option <?php checkHAlgo("tiger128,3") ?> value="tiger128,3">tiger128,3</option>
					<option <?php checkHAlgo("tiger160,3") ?> value="tiger160,3">tiger160,3</option>
					<option <?php checkHAlgo("tiger192,3") ?> value="tiger192,3">tiger192,3</option>
					<option <?php checkHAlgo("tiger128,4") ?> value="tiger128,4">tiger128,4</option>
					<option <?php checkHAlgo("tiger160,4") ?> value="tiger160,4">tiger160,4</option>
					<option <?php checkHAlgo("tiger192,4") ?> value="tiger192,4">tiger192,4</option>
					<option <?php checkHAlgo("snefru") ?> value="snefru">snefru</option>
					<option <?php checkHAlgo("snefru256") ?> value="snefru256">snefru256</option>
					<option <?php checkHAlgo("gost") ?> value="gost">gost</option>
					<!-- <option <?php checkHAlgo("gost-crypto") ?> value="gost-crypto">gost-crypto</option> -->
					<option <?php checkHAlgo("adler32") ?> value="adler32">adler32</option>
					<option <?php checkHAlgo("crc32") ?> value="crc32">crc32</option>
					<option <?php checkHAlgo("crc32b") ?> value="crc32b">crc32b</option>
					<option <?php checkHAlgo("fnv132") ?> value="fnv132">fnv132</option>
					<!-- <option <?php checkHAlgo("fnv1a32") ?> value="fnv1a32">fnv1a32</option> -->
					<option <?php checkHAlgo("fnv164") ?> value="fnv164">fnv164</option>
					<!-- <option <?php checkHAlgo("fnv1a64") ?> value="fnv1a64">fnv1a64</option> -->
					<option <?php checkHAlgo("joaat") ?> value="joaat">joaat</option>
					<option <?php checkHAlgo("haval128,3") ?> value="haval128,3">haval128,3</option>
					<option <?php checkHAlgo("haval160,3") ?> value="haval160,3">haval160,3</option>
					<option <?php checkHAlgo("haval192,3") ?> value="haval192,3">haval192,3</option>
					<option <?php checkHAlgo("haval224,3") ?> value="haval224,3">haval224,3</option>
					<option <?php checkHAlgo("haval256,3") ?> value="haval256,3">haval256,3</option>
					<option <?php checkHAlgo("haval128,4") ?> value="haval128,4">haval128,4</option>
					<option <?php checkHAlgo("haval160,4") ?> value="haval160,4">haval160,4</option>
					<option <?php checkHAlgo("haval192,4") ?> value="haval192,4">haval192,4</option>
					<option <?php checkHAlgo("haval224,4") ?> value="haval224,4">haval224,4</option>
					<option <?php checkHAlgo("haval256,4") ?> value="haval256,4">haval256,4</option>
					<option <?php checkHAlgo("haval128,5") ?> value="haval128,5">haval128,5</option>
					<option <?php checkHAlgo("haval160,5") ?> value="haval160,5">haval160,5</option>
					<option <?php checkHAlgo("haval192,5") ?> value="haval192,5">haval192,5</option>
					<option <?php checkHAlgo("haval224,5") ?> value="haval224,5">haval224,5</option>
					<option <?php checkHAlgo("haval256,5") ?> value="haval256,5">haval256,5</option>
				</select>
				<br>
				<br>
				<div class="block">
					<p>Plain text</p>
					<textarea required name="hPText" class="form-control" rows="3"><?php if (isset($hPText)) { echo htmlspecialchars($hPText); } ?></textarea>
				</div>
				<div class="block">
					<p>Hashed text</p>
					<textarea readonly name="hHText" class="form-control res" rows="3" cols="1"><?php if(isset($hHText)) { echo htmlspecialchars($hHText); } ?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Hash</button>
			</form>
			<form action="index.php#hash" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
			<!-- Dehash -->
			<?php
			// if (isset($_POST["dhPText"])){
			// $dhPText = $_POST["dhPText"];
			// switch ($dhPText) {
			// case "19cb29c236b55893fd1f234253f567a17e393048fbfb0c2a664fd68f824d3917":
			// $dhHText = "radu1234";
			// break;
			// case "0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e":
			// $dhHText = "password1";
			// break;
			// default:
			// $dhHText = "There is no hash in the rainbow table yet.";
			// }
			// }
			?>
			<!-- 			<h2 id="dehash"><span class="second-color">D</span>ehash</h2>
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
			</form> -->

			<!-- Asymmetric Encryption -->
			<!-- Generate  private & public key -->
			<?php
if (isset($_POST["generateKeys"])){
	$generateKeys = $_POST["generateKeys"];
$digest_alg = $_POST["digestAlg"];
$config = array(
"digest_alg" => "sha512",
"private_key_bits" => 4096,
"private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// Create the private and public key
$res = openssl_pkey_new($config);
// $res = openssl_pkey_new();

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);


// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

			// generate unique filename to save the keys
			$filePrivKey = uniqid(rand(), true);
			$filePubKey = uniqid(rand(), true);
			// save the keys in the unique files
			file_put_contents("privKey$filePrivKey.txt",$privKey);
			file_put_contents("pubKey$filePubKey.txt",$pubKey);
}


if (isset($_POST["aePlainData"])){
$aePlainData = $_POST["aePlainData"];
$data = $aePlainData;
$pubKeyE = $_POST["pubKeyE"];
$pubKey = $_POST["pubKeyE"];
// Encrypt the data to $encrypted using the public key
openssl_public_encrypt($data, $encrypted, $pubKey);
}

if (isset($_POST["ppdCipherText"])){
$ppdCipherText = $_POST["ppdCipherText"];
$encrypted = base64_decode($ppdCipherText);

$ppdKey = $_POST["ppdKey"];
$privKey = $ppdKey;

openssl_private_decrypt($encrypted, $decrypted, $privKey);
}

?>
<br>
<br>
<br>
</div>
<span id="AsymEncr"></span>
					<div class="container ae">
			<h2><span class="third-color">A</span>symmetric Encryption</h2>
			<form action="index.php#AsymEncr" method="post" accept-charset="utf-8">
				<input type="hidden" name="generateKeys" id="generateKeys" value="yes">
					<!-- <span>Select digest algorithm (method):</span> -->
					<span>Using private key of 4096 bits, key type: OPENSSL_KEYTYPE_RSA and digest algorithm (method)::</span>
			<?php function checkDigest_Alg($vDigest_Alg){global $digest_alg; if($digest_alg == $vDigest_Alg) {echo 'selected';} } ?>
				<select class="form-inline form-control fix-fc" name="digestAlg">
					<option <?php checkDigest_Alg("sha512") ?> value="sha512">sha512</option>
					<option <?php checkDigest_Alg("sha384") ?> value="sha384">sha384</option>
					<option <?php checkDigest_Alg("sha256") ?> value="sha256">sha256</option>
					<option <?php checkDigest_Alg("sha224") ?> value="sha224">sha224</option>
					<option <?php checkDigest_Alg("md2") ?> value="md2">md2</option>
					<option <?php checkDigest_Alg("md5") ?> value="md5">md5</option>
					<option <?php checkDigest_Alg("sha1") ?> value="sha1">sha1</option>
					<option <?php checkDigest_Alg("dss1") ?> value="dss1">dss1</option>
					<option <?php checkDigest_Alg("mdc2") ?> value="mdc2">mdc2</option>
					<option <?php checkDigest_Alg("ripemd160") ?> value="ripemd160">ripemd160</option>
					</select>
					<br>
					<br>
				<div class="block">
					<p>Private key</p>
					<textarea readonly name="pphPText" class="form-control" rows="3"><?php if (isset($generateKeys)) { echo $privKey; } ?></textarea>
					<a href="<?php echo "privKey$filePrivKey.txt"; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt"></span></a>
				</div>
				<div class="block">
					<p>Public key</p>
					<textarea readonly name="pphHText" class="form-control" rows="3" cols="1"><?php if (isset($generateKeys)) { echo $pubKey; } ?></textarea>
					<a href="<?php echo "pubKey$filePubKey.txt"; ?>" target="_blank"><span class="glyphicon glyphicon-download-alt"></span></a>
				</div>
				<button type="submit" class="btn btn-primary">Generate</button>
			</form>
			<form action="index.php#AsymEncr" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
			<br>
			<br>
			<h3 id="ppKeys2"><span class="first-color">E</span>ncrypt</h3>
			<form action="index.php#AsymEncr" method="post" accept-charset="utf-8">
				<div class="block">
					<p>Plain text: </p>
					<textarea required name="aePlainData" class="form-control" rows="3" cols="1" id="aePlainData"><?php if (isset($aePlainData)) {echo htmlspecialchars($aePlainData); } ?></textarea>
				</div>
				<div class="block">
					<p>Public key: </p>
					<textarea name="pubKeyE" class="form-control" rows="3" id="pubKeyE"><?php if (isset($pubKeyE)) {echo htmlspecialchars($pubKeyE); } ?></textarea>
				</div>
				<div class="block">
					<p>Cipher text: </p>
					<textarea readonly name="ppeCipherText" class="form-control" rows="3" id="ppeCipherText"><?php if (isset($aePlainData)) {echo base64_encode($encrypted); } ?></textarea>
				</div>
				<span id="adecipher"></span>
				<button type="submit" class="btn btn-primary">Encrypt</button>
			</form>
			<form action="index.php#AsymEncr" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
			<br>
			<br>
			<h3 id="ppKeys3" style="clear: both;"><span class="second-color">D</span>ecrypt</h3>
			<form action="index.php#ppKeys3" method="post" accept-charset="utf-8">
				<div class="block">
					<p>Cipher text</p>
					<textarea required name="ppdCipherText" class="form-control" rows="3" id="ppdCipherText"><?php if (isset($ppdCipherText)) {echo htmlspecialchars($ppdCipherText); }?></textarea>
				</div>
				<div class="block">
					<p>Private key</p>
					<textarea name="ppdKey" class="form-control" rows="3" id="ppdKey"><?php if (isset($ppdCipherText)){ echo htmlspecialchars($ppdKey); }?></textarea>
				</div>
				<div class="block">
					<p>Plain text</p>
					<textarea readonly name="ppdPlainText" class="form-control" rows="3" cols="1" id="ppdPlainText"><?php if (isset($ppdCipherText)) {echo $decrypted; }?></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Decrypt</button>
			</form>
			<form action="index.php#ppKeys3" method="post" accept-charset="utf-8">
				<button type="submit" class="btn btn-warning">Reset</button>
			</form>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>

		</div>
<?php
// lets assume you just called an openssl function that failed
while ($msg = openssl_error_string())
    echo $msg . "<br />\n";
?>
		<?php
		$path = dirname(__FILE__);
		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {
				if ((time()-filectime($path.'/'.$file)) > 60) {  // the keys stay on the server for only 60 seconds after they are deleted
					if (strripos($file, '.txt') !== false) {
					unlink($path.'/'.$file);
					}
				}
			}
		}
		?>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Help</h4>
					</div>
					<div class="modal-body">
						<p>Crypto is a free online cryptographic service. It uses the OpenSSL cryptography extension for PHP. (<a href="http://php.net/manual/en/book.openssl.php">documentation</a> and <a href="https://github.com/php/php-src/tree/master/ext/openssl">source code</a>)<br>
						<strong>Update:</strong><br>
						18/05/2015 - displays the last used algorithm if is the case<br>
						18/05/2015 - displays the last used algorithm if is the case<br>
						06/05/2015 - added asymmetric encryption and decryption<br>
						28/04/2015 - added 44 hashing algorithms from Hash cryptography extension for PHP (<a href="http://php.net/manual/en/book.hash.php">documentation</a>)<br>
						21/04/2015 - released version 1.2 tested successfully on Apache/2.4.3 (Win32) OpenSSL/1.0.1c PHP/5.4.7.</p><br>
						<!-- <p>Asymmetric signature/verification</p> -->
					<strong>Possible updates:</strong><br>
					use also the Mcrypt extension for PHP (slower than OpenSSL)
					<a target="_blank" href="index.txt"><span class="glyphicon glyphicon-eye-open"></span> Source code of the project is avaiable here</a>
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
	$(window).load(function() {
	// Animate loader off screen
	$(".se-pre-con").fadeOut("fast");
	$(".btn").click(function() {
		/* Act on the event */
		$(".se-pre-con").fadeIn("fast");
	});
	});
		var ePlainText = document.getElementById('ePlainText');
		var eKey = document.getElementById('eKey');
		var eCipherText = document.getElementById('eCipherText');
		var eIV = document.getElementById('eIV');
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
	Countable.live(eIV, function (counter) {
	var allchars = counter.all;
	document.getElementById("chars-eIV").innerHTML = allchars;
	});
	$("textarea").on("click", function (e) {
	$(this).tooltip("show");
	});
	$(".res").click(function() {
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
