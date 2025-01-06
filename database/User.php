<?php

class User extends Database
{

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>
