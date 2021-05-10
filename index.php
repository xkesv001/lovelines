
<!DOCTYPE html>
<?php
require 'php/session.php';
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
        <?php
        require('php/parser.php');
        ?>        
        <header class="header">
            <h1 class="hidden-abs">Vyhledávání spojů</h1>
            <?php
            require 'php/menu.php';
            ?>
        </header>
        <main class="main">
            <section class="search">
                <h2 class="hidden">Vyhledávání</h2>
                <form method="post">
                    <fieldset class="search--fieldset">
                        <legend class="hidden">Vyhledávání</legend>
                        <div class="search--form">
                            <div class="search--input-group">
                                <label class="hidden">Odkud</label>
                                <input class="search--input search--item" name="from" type="text" placeholder="Odkud">
                                <label class="hidden">Kam</label>
                                <input class="search--input search--item" name="to" type="text" placeholder="Kam">
                            </div>
                            <div class="search--datetime-group">
                                <label class="hidden">Datum</label>
                                <input class="search--date search--item" type="date" name="date">
                                <label class="hidden">Čas</label>
                                <input class="search--time search--item" type="time" name="time">
                            </div>
                            <input class="search--btn" type="submit" name="link_search" value="Hledej">
                        </div>

                    </fieldset>
                </form>
            </section>
            <section class="results">
                <h3 class="hidden-abs">Výsledky hledání</h3>
                <?php
                if (!empty($objs)) {
                    foreach ($objs as $obj) {
                        echo '<div class="result">
            <div class="result--flex">
              <p class="result--line">' . $obj['links'] . '</p>
              <div class="result--time">
                <p class="t_from">Čas odjezdu <b class="t_from">' . $obj['time_start'] . '</b></p>
                <p class="t_to">Čas příjezdu <b class="t_to">' . $obj['time_end'] . '</b></p>
              </div>
              <a href="#" class="result--comments">kommentářé</a>
              <div class = "comments">
              
              </div>
            </div>
            <div class="result--bottom">
              <p class="result--direction"> Směr: <span>' . $obj['source_station'] . ' - ' . $obj['target_station'] . '</span></p>
              <button class="heart hidden" title="Přidat do oblíbených" type="button">Přidat do oblíbených</button>
            </div>
          </div>';
                    }
                }
                ?>
            </section>
        </main>
        <footer class="footer">
            <a href="index.php" class="hidden footer--logo logo"><img src="img/logo.png" alt="logotype" width="100"
                                                                      height="100">logotype</a>
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