<?php
require 'php/session.php';

if (!isset($_SESSION["username"])) {
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
        $passwordErr = $password2Err = "";
        $password = $password2 = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

            if (!empty($_POST["password"]) && !empty($_POST["password2"]) && $passwordErr == "" && $password2Err == "") {
                $stmt = $mysqli->prepare("UPDATE users password SET password=PASSWORD(?) WHERE username=?");
                $stmt->bind_param("ss", $password, $_SESSION["username"]);
                $stmt->execute();
                $passwordErr = $password2Err = "";
                $password = $password2 = "";
                Header("Location: ./");
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
            <h1 class="hidden-abs">Změna Hesla</h1>
            <?php
            require 'php/menu.php';
            ?>
        </header>

        <main class="main">
            <p><span class="error">* required field</span></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data" id="demo-form">
                Nové heslo: <input type="password" name="password" value="<?php /* echo $password; */ ?>">
                <span class="error">* <?php echo $passwordErr; ?></span><!-- comment -->
                <br>
                Nové heslo znovu: <input type="password" name="password2" value="<?php /* echo $password2; */ ?>">
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

