<?php
$site_name = "Shop";
include 'includes/header.inc.php'; ?>

<div class="content">
    <article>
        <h2>Herzlich willkommen!<br><br>
        </h2>
    </article>
</div>
<div class="productcontent">
    <?php
    include 'includes/product.inc.php';
    $product = new Product();
    $product->loadAllProducts();
    ?>
</div>


<?php
include 'includes/footer.inc.php';
?>

