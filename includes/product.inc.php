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
            header("Refresh:3; url=shop.php");
        } else {
            echo '<h3>Ein Produkt mit diesem Namen existiert bereits!</h3>';
            header("Refresh:3; url=editproduct.php");
        }

    }

    public function loadAllProducts()
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while ($product = $stmt->fetch()) {
            echo "<div class='productThumb'>
                  <h4>Product ID: " . $product['id'] . "</h4>
                  <h4>Name: " . $product['name'] . "</h4>
                  <h4>Beschreibung: " . $product['description'] . "</h4>
                  <h4>€ " . $product['price'] . "</h4>
                  <img class='image' src='images/" . $product['image'] . "'>";
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {
                echo "<h4><a href='deleteproduct.php?pid=" . $product['id'] . "'>Produkt löschen</a></h4>";
            }
            echo "</div > ";
        }
    }

    public function loadProduct($pid)
    {

        $sql = "SELECT * FROM product WHERE id = '$pid'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while ($product = $stmt->fetch()) {
            echo "<div class='productThumb'>
                  <h4>Product ID: " . $product['id'] . "</h4>
                  <h4>Name: " . $product['name'] . "</h4>
                  <h4>Beschreibung: " . $product['description'] . "</h4>
                  <h4>€ " . $product['price'] . "</h4>
                  <img class='image' src='images/" . $product['image'] . "'>";
        }

    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        echo "<h4>Du hast das auserwählte Produkt erfolgreich gelöscht!";
        // nach dem löschen zurück zum Shop
        header("Refresh:3; url=shop.php");
    }

    public function addToCart($id)
    {
        $sql = "SELECT * FROM product WHERE id = $id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $product_id = $id['product_id'];
        $user_id = $id['user_id'];
        $amount = $id['amount'];

        $sql = "INSERT INSERT product (product_id, user_id, amount) VALUES (?,?,?)";
        $stmt = $this->connect()->query($sql);
        $stmt->execute([$product_id, $user_id, $amount]);
        echo '<h2>Das Produkt wurde erfolgreich hinzugefügt!</h2>';
    }
}
