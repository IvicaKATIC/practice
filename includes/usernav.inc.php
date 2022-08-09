<nav>
    <?php if (!isset($_SESSION['user_role'])) {
        ?>
        <ul>
            <h3 style="text-align: center">
                <li class="li"><a href="index.php">Home</a></li>
                <li class="li"><a href="register.php">Registrierung</a></li>
                <li class="li"><a href="login.php">Login</a></li>

            </h3>
        </ul>
    <?php } elseif (isset($_SESSION['user_role'])) {
        ?>
        <ul>
            <h3 style="text-align: center">
                <li class="li"><a href="overview.php">Unsere Produkte</a></li>
            </h3>
        </ul>
    <?php } elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
        ?>
        <ul>
            <h3 style="text-align: center">
                <li class="li"><a href="overview.php">Unsere Produkte</a></li>
                <li class="li"><a href="allusers.php">Alle Benutzer</a></li>
            </h3>
        </ul>
    <?php } ?>
</nav>
