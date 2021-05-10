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
        <title>LOVELINES</title>
    </head>

    <body>
        <header class="header">
            <h1 class="hidden-abs">Vyhledávání spojů</h1>
            <?php
            require 'php/menu.php';
            ?>
        </header>
        <main class="main main-contact">
            <div class="contact--info">
                <h3>Základní identifikační údaje</h3>
                <p> LOVELINES, akciová společnost <br>
                    Sokolovská 52/17<br>
                    Vysočany, 190 00 Praha 9<br>
                    Telefon: 608 608 608<br>
                    Datová schránka: fhodrk6<br>
                    IČ: 00005986<br>
                    Zapsán v obchodním resjtříku vedeném městským soudem v Praze, oddíl B, vložka 887</p>
                <p>Centrální podatelna <br>
                    Sokolovská 52/17<br>
                    Vysočany, 190 00, Praha 9</p>
                <p>Provozní doba <br>
                    Pondělí - Čtvrtek: 7:30 - 16:45<br>
                    Pátek: 7:30 - 15:30</p>
                <p>Informační linka</p>
                <div class="contact--tel ">
                    <a href="tel: +420 608 608 608" class="info-tel--link">+420 608 608 608</a>
                </div>
                <p>Provozní doba <br>
                    Denně: 7:00 - 20:00</p>
            </div>
            <div class="contact--message">
                <form>
                    <fieldset class="contact--fieldset">
                        <legend class="hidden-abs">Dotazovací formulář</legend>
                        <p class="contact--title">Poslat dotaz</p>
                        <label class="contact--label">* Máte návrh na zlepšení našich služeb nebo zajíma Vás informace o jízdnem?
                            Pošlete nám dotaz</label>
                        <textarea class="contact--input" rows="20"></textarea>
                        <input type="checkbox" id="gdpr" class="contact-agreement--checkbox hidden-abs">
                        <label for="gdpr" class="contact-agreement--title" tabindex="0">Souhlasím se zpracováním <a href="agreement.html" class="contact-agreement--link">osobních údajů</a></label>
                    </fieldset>
                    <button type="submit" class="contact--btn">Poslat dotaz</button>
                </form>
            </div>

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
        <script src="js/main.js"></script>
	
    </body>

</html>