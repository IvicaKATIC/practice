<?php
require __DIR__ . '/dbconnection.inc.php';

class User extends Connection
{
    /**
     * @throws Exception
     */
    public function signup($data)
    {
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $pw = sha1($data['pw']);
        $pw2 = sha1($data['pw2']);
        $address = $data['address'];

        if ($pw === $pw2) {
            $sql = "SELECT * FROM user WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);

            if ($stmt->rowCount() == 0) {
                $sql = "INSERT INTO user (first_name, last_name, email, password,address) VALUES (?, ?, ?, ?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$first_name, $last_name, $email, $pw, $address]);
                // $r um zu überprüfen, ob ich überhaupt was rauskriege.
                $r = $stmt->fetch();
                print_r($r);
                echo '<h3>Erfolgreich registriert, du wirst in Kürze weitergeleitet!</h3>';
                header("Refresh:3; url=login.php");
            } else {
                throw new Exception('<h3>Email bereits vergeben!</h3>');
            }
        } else {
            throw new Exception('<h3>Passwörter stimmen nicht überein!</h3>');
        }
    }

    public function login($email, $pw)
    {
        $sql = "SELECT * FROM user WHERE email = ? AND password = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $pw]);
        $r = $stmt->fetch();
        if ($stmt->rowCount() == 1) {

            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            $_SESSION['user_role'] = $r['role'];
            if ($r['role'] == 1) {
                echo "<h3>Hallo Admin, du wirst in Kürze weitergeleitet!</h3>";
                header("Refresh:3; url=admin.php");
            } elseif ($r['role'] == 0) {
                echo "<h3>Erfolgreich eingeloggt! Du wirst in Kürze weitergeleitet!</h3>";
                header("Refresh:3; url=user.php");
            }
        }else{
            echo "<h3>Achtung, ihre Anmeldedaten sind falsch!</h3>";
        }
    }

    public function loadAllUsers()
    {
        $sql = "SELECT * FROM user";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while ($data = $stmt->fetch()) {
            echo "
            <tr>
            <td>" . $data['id'] . "</td>
            <td>" . $data['first_name'] . "</td>
            <td>" . $data['last_name'] . "</td>
            <td>" . $data['email'] . "</td>
            <td>" . $data['password'] . "</td>
            <td>" . $data['address'] . "</td>
            <td>" . $data['role'] . "</td>
            <td>" . $data['reg_since'] . "</td>
            <td><a href='userprofil.php?uid=" . $data['id'] . "'>Zum Profil</a> </td>
            <td><a href='edituser.php?uid=" . $data['id'] . "'>User bearbeiten</a> </td>
            </tr>
            ";
        }
    }
}