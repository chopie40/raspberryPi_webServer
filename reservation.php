<!DOCTYPE html>
<html lang="fr-ca">
<head>
    <title>GatineauÉlectro | Réservation</title>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="images/tape_32x32.ico">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .w3-bar .w3-button {
        padding: 16px;
    }
    </style>
</head>

<body>
    <button onclick="topFunction()" id="topBtn" title="Haut de page">Haut</button>
	<div class="w3-top">
        <div class="w3-bar w3-black">
            <a href="index.html" class="w3-bar-item">
                <img src="images/LogoTape_32x32.png" alt="Logo du site web représentant une cassette audio.">
            </a>
            <div class="w3-right w3-hide-small">
                <a href="about.html" class="w3-bar-item">À propos</a>
                <a href="work.html" class="w3-bar-item">Les projets</a>
                <a href="video.html" class="w3-bar-item">Vidéothèque</a>
                <a href="reservation.php" class="w3-bar-item">Réservation</a>
            </div>
            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>

    <nav class="w3-sidebar w3-bar-block w3-black w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-padding-16">X</a>
        <a href="about.html" onclick="w3_close()" class="w3-bar-item w3-button">À propos</a>
        <a href="work.html" onclick="w3_close()" class="w3-bar-item w3-button">Les projets</a>
        <a href="video.html" onclick="w3_close()" class="w3-bar-item w3-button">Vidéothèque</a>
        <a href="reservation.php" onclick="w3_close()" class="w3-bar-item w3-button">Prise de rendez-vous</a>
    </nav>

    <?php
	// define variables and set to empty values
	$fname = $lname = $email = $tel = $comment = "";
	$fnameErr = $lnameErr = $emailErr = $telErr = "";

	if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
		if ( empty( $_POST["fname"] ) ) {
			$fnameErr = "Prénom requit";
		} else {
			$fname = test_input( $_POST["fname"] );
			/* check if fname only contains letters ans whitespaces */
			if ( ! preg_match( "/^[A-Za-z-' ]*$/", $fname ) ) {
				$fnameErr = "Caractères incompatibles entrés";
			}
		}
		if ( empty( $_POST["lname"] ) ) {
			$lnameErr = "Nom requis.";
		} else {
			$lname = test_input( $_POST["lname"] );
			if ( ! preg_match( "/^[A-Za-z-' ]*$/", $lname ) ) {
				$lnameErr = "Caractères incompatibles entrés";
			}
		}
		if ( empty( $_POST["email"] ) ) {
			$emailErr = "Le courriel est requis";
		} else {
			$email = test_input( $_POST["email"] );
			/* Check the email format */
			if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
				$emailErr = "Format invalide!";
			}
		}
		if ( empty( $_POST["tel"] ) ) {
			$tel = "";
		} else {
			$tel = test_input( $_POST["tel"] );
			if ( ! preg_match( "/[0-9]{3}-[0-9]{3}-[0-9]{4}/", $tel ) ) {
				$telErr = "Format invalide!";
			}
		}
		if ( empty( $_POST["comment"] ) ) {
			$comment = "";
		} else {
			$comment = test_input( $_POST["comment"] );
		}
	}

	/* Parser */
	function test_input( $data ) {
		$data = trim( $data );
		$data = stripslashes( $data );
		$data = htmlspecialchars( $data );
		return $data;
	}

	?>

    <!-- Section réservation -->
    <section class="w3-container w3-text-sand w3-margin-bottom w3-padding-top-32" id="reservation">
        <h1 class="w3-center w3-margin-bottom w3-padding-16">Prendre un rendez-vous</h1>
        <article class="w3-margin-bottom w3-padding-16">
            <p><span class="error">* Champs obligatoires *</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="fname">Prénom: *</label><br>
                <input type="text" id="fname" required name="fname" class="w3-gray" value="<?php echo $fname;?>">
                <span class="error">* <?php echo $fnameErr;?></span><br>
                <label for="lname">Nom: *</label><br>
                <input type="text" id="lname" required name="lname" class="w3-gray" value="<?php echo $lname;?>">
                <span class="error">* <?php echo $lnameErr;?></span><br>
                <label for="email">Courriel: *</label><br>
                <input type="email" id="email" required name="email" class="w3-gray" placeholder="xxx123@xxx.xxx" value="<?php echo $email;?>">
                <span class="error">* <?php echo $emailErr;?></span><br>
                <label for="phone">Téléphone:</label><br>
                <input type="tel" id="phone" name="phone" class="w3-gray" placeholder="123-456-7890" value="<?php echo $tel;?>">
                <span class="error"><?php echo $telErr;?></span><br>
                <label for="message">Message:</label><br>
                <textarea id="message" name="message" rows="5" cols="25" class="w3-gray"><?php echo $comment;?></textarea><br>
                <input type="submit" value="Soumettre" class="w3-dark-gray">
                <input type="reset" value="Recommencer" class="w3-dark-gray">
            </form>
        </article>
    </section>

	<?php
	echo "<h2>Your Input:</h2>";
	echo "<br>";
	echo $fname;
	echo "<br>";
	echo $lname;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $tel;
	echo "<br>";
	echo $comment;
	?>

    <!-- Footer -->
    <footer class="w3-container w3-center w3-black w3-padding-top-24">
        <div>
            <a class="fa fa-facebook" href="https://www.facebook.com/profile.php?id=723906274141004" target="_blank"></a>
            <a class="fa fa-whatsapp" href="https://wa.me/message/SKTYI5LDWAADL1" target="_blank"></a>
        </div>
        <p>2025<br>Développé par DentedDiamond et Nympha</p>
    </footer>
    <script src="sideBar.js"></script>
    <script src="topBtn.js"></script>
</body>
</html>
