<?php
$site_name = "Registrierung";
include 'includes/header.inc.php'; ?>

<div class="content">
    <form action="" method="post">
        <div class="mb-3">
            <input type="text" class="form-control" name="first_name" placeholder="Vorname">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="last_name" placeholder="Nachname">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="pw" placeholder="Passwort">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="pw2" placeholder="Passwort bestätigen">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" placeholder="Adresse">
        </div>
        <button type="submit" name="regbtn" class="button">Registrieren</button>
        <?php
        if (isset($_POST['regbtn'])) {
            include 'includes/user.inc.php';
            $user = new User();
            try {
                $user->signup($_POST);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
        ?>
    </form>
</div>


<?php
include 'includes/footer.inc.php'
?>

