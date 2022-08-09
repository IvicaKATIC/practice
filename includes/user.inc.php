<?php
require __DIR__ . '/dbconnection.inc.php';

class User extends Connection
{
    public function signup($data)
    {
        $uname = $data['uname'];
        $email = $data['email'];
        $pw = sha1($data['pw']);
        $pw2 = sha1($data['pw2']);

        if ($pw === $pw2) {
            $sql = "SELECT * FROM user WHERE username = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$uname]);

            if ($stmt->rowCount() == 0) {
                $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$uname, $email, $pw]);
                echo '<h2>Erfolgreich registriert, du wirst in Kürze weitergeleitet!</h2>';
                header("Refresh:3; url=login.php");
            } else {
                throw new Exception('Username bereits vergeben!');
            }
        } else {
            throw new Exception('Passwörter stimmen nicht überein!');
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
                echo "Erfolgreich eingeloggt";
                header("Refresh: 3; url=admin.php");
            } else {
                echo "Erfolgreich eingeloggt";
                header("Refresh: 3; url=user.php");
            }
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
            <td>" . $data['username'] . "</td>
            <td>" . $data['email'] . "</td>
            <td>" . $data['password'] . "</td>
            <td>" . $data['role'] . "</td>
            <td>" . $data['reg_since'] . "</td>
            <td><a href='userprofil.php?uid=" . $data['id'] . "'>Zum Profil</a> </td>
            <td><a href='edituser.php?uid=" . $data['id'] . "'>User bearbeiten</a> </td>
            </tr>
            ";
        }
    }
}