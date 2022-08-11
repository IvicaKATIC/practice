<?php
$site_name = "Produkt erstellen";
include 'includes/header.inc.php'; ?>

<div class="content">
    <article>
        <h3>
            <form action="" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Produktname">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="description" placeholder="Beschreibung">
                </div>
                <div class="mb-3">
                    <input type="number" step="0.01" class="form-control" name="price" placeholder="Preis">
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control" accept="image/jpg,image/jpeg,image/png" name="image"
                           placeholder="Bild hinzufügen">
                </div>
                <button type="submit" name="create" class="button">Produkt erstellen</button>
                <?php
                if (isset($_POST['create'])) {
                    include 'includes/product.inc.php';
                    $product = new Product();
                    try {
                        $product->createProduct($_POST);
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                    }
                }
                ?>
            </form>
        </h3>
    </article>
</div>


<?php
include 'includes/footer.inc.php'; ?>
