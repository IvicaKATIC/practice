<?php
$site_name = "Userlist";
include 'includes/header.inc.php';
include 'includes/user.inc.php';
?>
<div class="content">
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Passwort</th>
            <th>Rolle</th>
            <th>Registriert seit</th>
            <th>Profil</th>
            <th>Bearbeiten</th>
        </tr>
        <?php
        $user = new User();
        $user->loadAllUsers();
        ?>
    </table>
</div>

<?php include 'includes/footer.inc.php'; ?>
