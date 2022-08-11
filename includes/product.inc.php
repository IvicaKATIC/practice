<?php
require __DIR__ . '/dbconnection.inc.php';

class Product extends Connection
{
    public function createProduct($product_data)
    {
        $name = $product_data['name'];
        $description = $product_data['description'];
        $price = $product_data['price'];
        $image = $product_data['image'];

        $sql = "SELECT * FROM product WHERE name = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name]);

        if ($stmt->rowCount() == 0) {
            $sql = "INSERT INTO product (name, description, price, image) VALUES (?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $description, $price, $image]);
            // $r um zu überprüfen, ob ich überhaupt was rauskriege.
            $r = $stmt->fetch();
            print_r($r);
            echo '<h3>Das Produkt wurde erfolgreich erstellt, du wirst in Kürze weitergeleitet!</h3>';
            header("Refresh:3; url=allproducts.php");
        } else {
            throw new Exception('<h3>Ein Produkt mit diesem Namen existiert bereits!</h3>');
        }

    }

    public function loadAllProducts()
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while ($product = $stmt->fetch())
        {
            // zwecks Kontrolle --> print_r($product);
            echo "<div class='productThumb'>
                  <h4>Product ID: " . $product['id'] . "</h4>
                  <h4>Name: " . $product['name'] . "</h4>
                  <h4>Beschreibung: " . $product['description'] . "</h4>
                  <h4>€ " . $product['price'] . "</h4>
                  <img class='image' src='images/" . $product['image'] . "'>";
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1)
            {
                echo "<h4><a href='productprofil.php?uid=" . $product['id'] . "'>Produkt löschen</a></h4>";
            } echo "</div > ";
        }
    }
}
