<?php
$site_name = "Userliste";
include 'includes/header.inc.php';
?>
<div class="content">
    <table>
        <tr>
            <th>User ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Email</th>
            <th>Passwort</th>
            <th>Adresse</th>
            <th>Role<br>Admin=1<br>User=0</th>
            <th>Registriert seit</th>
            <th>Profil</th>
            <th>Bearbeiten</th>
        </tr>
        <?php
        include 'includes/user.inc.php';
        $user = new User();
        $user->loadAllUsers();
        ?>
    </table>
</div>

<?php
include 'includes/footer.inc.php';
?>
