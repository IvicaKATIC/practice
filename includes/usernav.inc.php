<nav>
    <?php

    if (!isset($_SESSION['user_role'])) {
        echo '
        <ul>
            <h3 style = "text-align: center" >
                <li class="li" ><a href = "register.php" >Registrierung</a ></li >
                <li class="li" ><a href = "login.php" >Login</a ></li >
            </h3 >
        </ul >';
    } elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 0) {
        echo '
            <ul>
            <h3 style = "text-align: center" >
                <li class="li"><a href="allproducts.php">Alle Produkte</a></li>
                <li class="li" ><a href = "logout.php" >Logout</a ></li >
            </h3 >
            </ul >';
    } elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
        echo '
            <ul>
            <h3 style = "text-align: center" >
                <li class="li"><a href="editproduct.php">Produkt erstellen</a></li>
                <li class="li"><a href="allproducts.php">Alle Produkte</a></li>
                <li class="li"><a href="userlist.php">Userliste</a></li>
                <li class="li"><a href="edituser.php">User bearbeiten</a></li>
                <li class="li" ><a href = "logout.php">Logout</a ></li >
            </h3 >
            </ul >';
    }
    ?>
</nav>
