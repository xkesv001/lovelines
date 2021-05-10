<?php
require 'php/session.php';

if (isset($_SESSION["username"])) {
    Header("Location: ./");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0px; padding: 0px }
            #map_canvas { height: 100% }
            .error {color: #FF0000;}
        </style>
        <meta charset="UTF-8" />
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="css/normalize.css" />
        <link rel="stylesheet" href="css/style.css" />
        <title>LOVELINES</title>
    </head>
    <body>
        <?php
        require './php/reCaptcha.php';
        $jmenoErr = $prijmeniErr = $usernameErr = $passwordErr = $password2Err = "";
        $jmeno = $prijmeni = $username = $password = $password2 = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["jmeno"])) {
                /* $jmenoErr = "Jméno je povinné"; */
            } else {
                $jmeno = test_input($_POST["jmeno"]);
                if (!preg_match("/^[a-zA-ZěščřžýáíéůúňďťĚŠČŘŽÝÁÍÉŮÚŇĎŤ]+-?[a-zA-ZěščřžýáíéůúňďťĚŠČŘŽÝÁÍÉŮÚŇĎŤ]+$/", $jmeno)) {
                    $jmenoErr = "Jméno je ve špatném formátu";
                }
            }

            if (empty($_POST["prijmeni"])) {
                /* $prijmeniErr = "Příjmení je povinné";* */
            } else {
                $prijmeni = test_input($_POST["prijmeni"]);
                if (!preg_match("/^[a-zA-ZěščřžýáíéůúňďťĚŠČŘŽÝÁÍÉŮÚŇĎŤ]+-?[a-zA-ZěščřžýáíéůúňďťĚŠČŘŽÝÁÍÉŮÚŇĎŤ]+$/", $prijmeni)) {
                    $prijmeniErr = "Příjmení je ve špatném formátu";
                }
            }

            if (empty($_POST["username"])) {
                $usernameErr = "Uživatelské je povinné";
            } else {
                $username = test_input($_POST["username"]);
                if (!preg_match("/^[a-z]+$/", $username)) {
                    $usernameErr = "Uživatelské jméno může obsahovat jen malá písmena anglické abecedy";
                }
                $stmt = $mysqli->prepare("SELECT username FROM users WHERE username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows != 0) {
                    $usernameErr = "Uživatelské jméno již existuje";
                }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Heslo je prázdné";
            } else {
                $password = test_input($_POST["password"]);
                if (!preg_match("/^[a-zA-ZěščřžýáíéůúňďťĚŠČŘŽÝÁÍÉŮÚŇĎŤ_?!@]+$/", $password)) {
                    $passwordErr = "Heslo obsahuje nepovolené znaky";
                }
            }

            if (empty($_POST["password2"])) {
                $password2Err = "Heslo je prázdné";
            } else {
                $password2 = test_input($_POST["password2"]);
                if (!preg_match("/^[a-zA-ZěščřžýáíéůúňďťĚŠČŘŽÝÁÍÉŮÚŇĎŤ_?!@]+$/", $password2)) {
                    $password2Err = "Heslo obsahuje nepovolené znaky";
                } else if ($password != $password2) {
                    $password2Err = "Hesla nejsou shodná";
                }
            }

            if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $jmenoErr == "" && $prijmeniErr == "" && $usernameErr == "" && $passwordErr == "" && $password2Err == "") {
                $stmt = $mysqli->prepare("INSERT INTO users (name, surname, username, password) VALUES (?, ?, ?, PASSWORD(?))");
                $stmt->bind_param("ssss", $jmeno, $prijmeni, $username, $password);
                $stmt->execute();
                $jmenoErr = $prijmeniErr = $usernameErr = $passwordErr = $password2Err = "";
                $jmeno = $prijmeni = $username = $password = $password2 = "";
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <header class="header">
            <h1 class="hidden-abs">Registrace</h1>
            <?php
            require 'php/menu.php';
            ?>
        </header>

        <main class="main">
            <p><span class="error">* required field</span></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data" id="demo-form">
                Jméno: <input type="text" name="jmeno" value="<?php echo $jmeno; ?>">
                <span class="error"> <?php echo $jmenoErr; ?></span>
                <br>
                Příjmení: <input type="text" name="prijmeni" value="<?php echo $prijmeni; ?>">
                <span class="error"> <?php echo $prijmeniErr; ?></span>
                <br>
                Uživatelské jméno: <input type="text" name="username" value="<?php echo $username; ?>">
                <span class="error">* <?php echo $usernameErr; ?></span>
                <br>
                Heslo: <input type="password" name="password" value="<?php /* echo $password; */ ?>">
                <span class="error">* <?php echo $passwordErr; ?></span><!-- comment -->
                <br>
                Heslo znovu: <input type="password" name="password2" value="<?php /* echo $password2; */ ?>">
                <span class="error">* <?php echo $password2Err; ?></span><!-- comment -->
                <br>
                <button type="submit" class="g-recaptcha" 
                        data-sitekey="<?php echo $sitekey; ?>"
                        data-callback='onSubmit' 
                        data-action='submit'>Odeslat</button>
            </form>
        </main>

        <footer class="footer">
            <a href="index.php" class="hidden footer--logo logo"><img src="img/logo.png" alt="logotype" width="100" height="100">logotype</a>
            <div class="footer--info">
                <div class="footer-info--text">
                    <p>Informační linka</p>
                    <p>Denně: 7:00 - 21:00</p>
                </div>
                <div class="footer--tel">
                    <a href="tel: +420 608 608 608" class="footer-tel--link">+420 608 608 608</a>
                </div>
            </div>
            <div class="footer--creater">
                <p>Internetové technologie - client side</p>
                <p>Semestrální projekt 2020</p>
            </div>
        </footer>

        <section class="popup hidden-abs" id="login">
            <div class="overlay"></div>
            <?php
            if (!isset($_SESSION["username"])) {
                require 'html/prihlaseni.html';
            } else {
                require 'html/odhlaseni.html';
            }
            ?>
        </section>

        <section class="popup hidden-abs" id="logout">
            <?php
            echo "<a href=\"?logout\">logout</a>";
            ?>
        </section>

        <script src="js/main.js"></script>
    </body>
</html>