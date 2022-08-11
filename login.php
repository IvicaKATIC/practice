<?php
$site_name = "Home";
include 'includes/header.inc.php';
?>

<div class="content">
    <form action="" method="post">
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="pw" placeholder="Passwort">
        </div>
        <button type="submit" name="loginbtn" class="button">Login</button>
    </form>
    <?php
    if (isset($_POST['loginbtn'])) {
        include 'includes/user.inc.php';
        $user = new User();
        try {
            $user->login($_POST['email'], sha1($_POST['pw']));
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    ?>
</div>
<?php
include("./includes/footer.inc.php");
?>

