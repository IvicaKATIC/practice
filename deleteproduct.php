<?php
$site_name = "Produkt löschen";
include 'includes/header.inc.php';
?>
    <div class="productcontent">
        <?php
        include 'includes/product.inc.php';
        $id = $_GET['pid'];
        $product = new Product();
        $product->loadProduct($id);
        ?>
        <br>
        <h4>Bist du sicher dass das Auserwählte Produkt löschen willst?</h4>
        <button type="submit" name="deletebtn" class="button">Löschen</button>
        <?php
        if (isset($_POST['deletebtn'])) {
            include 'includes/product.inc.php';
            $product = new Product();
            try {
                $product->deleteProduct($_POST);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
        ?>
    </div>
<?php
include 'includes/footer.inc.php';
