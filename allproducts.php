<?php
$site_name = "Produktübersicht";
include 'includes/header.inc.php'; ?>

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
