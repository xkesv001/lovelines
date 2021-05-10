<button class="menu__close menu--btn hidden">ZAVŘÍT menu</button>
<a href="index.php" class="hidden logo menu--logo"><img src="img/logo.png" alt="logotype" width="100"
                                                        height="100">logotype</a>
<nav class="nav">
    <ul class="menu">
        <li class="menu--item"><a href="index.php" class="menu-item--link menu--item__active">Hlavní stránka</a></li>
        <li class="menu--item"><a href="favorite.php" class="menu-item--link">Oblíbené trasy</a></li>
        <li class="menu--item"><a href="catalog.php" class="menu-item--link">Seznam linek</a></li>
        <li class="menu--item"><a href="contact.php" class="menu-item--link">Kontakty</a></li>
            <?php
            if (!isset($_SESSION["username"])) {

                echo "<li class = \"menu--item\"><a href = \"#login\" class = \"menu-item--link menu--popup-link\">Přihlášení</a></li>";
            } else {
                echo "<li class = \"menu--item\"><a href = \"#logout\" class = \"menu-item--link menu--popup-link\">uživatel přihlášen - {$_SESSION["username"]}</a></li>";
                /* echo "user logged in - username {$_SESSION["username"]}<br>"; */
                /* echo "<a href=\"?logout\">logout</a>"; */
            }
            ?>
    </ul>
</nav>

