<?php
$site_name = "Logout";
include 'includes/header.inc.php';
session_destroy();
?>
<div class="content">
    <h3>Erfolgreich ausgeloggt! Du wirst in Kürze weitergeleitet!</h3>
</div>
<?php
header("Refresh:3; url=index.php");
include 'includes/footer.inc.php';
