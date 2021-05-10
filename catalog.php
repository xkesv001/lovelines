<!DOCTYPE html>
<?php
require 'php/session.php';
require 'php/load_history.php';
?>
<html lang="cs">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="css/normalize.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <title>LOVELINES</title>
    </head>

    <body>
        <header class="header">
            <h1 class="hidden-abs">Vyhledávání spojů</h1>
            <?php
            require 'php/menu.php';
            ?>
        </header>
        <main class="main">
            <h3 class="catalog--title">Seznam linek</h3>
            <section class="catalog--results">
                <h4 class="hidden-abs">Seznam linek</h4>
                <?php
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="catalog--item">
                                <div class="catalog--flex">
                                    <p class="catalog--line">'.$row['line_name'].'</p>
                                    <p class="catalog--direction"> Směr: <span>'.$row['source_station'].' - '.$row['target_station'].'</span></p>
                                    
                                </div>
                            </div>';
                    }
                }else{
                    echo '<br><p>Nejdřiv musíte se přihlásit.</p>';
                }


                ?>
            </section>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	   <script src="js/main.js"></script>
       
	
    </body>

</html>

