<?php 
class Client extends Database 
{

    public function findAll()
    {
        $sql = "SELECT * FROM client AS c
                INNER JOIN address as a
                ON c.address_id = a.id
                ORDER BY c.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT email FROM client WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findByPhone($phone)
    {
        $sql = "SELECT phone FROM client WHERE phone = :phone";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insert($name, $email, $phone, $address_id) {
        $sql = "INSERT INTO client (name, email, phone, address_id) VALUES (:name, :email, :phone, :address_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address_id', $address_id);
        $stmt->execute();
    }
}
?>