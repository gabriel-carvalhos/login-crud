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

    public function findById($id)
    {
        $sql = "SELECT * FROM client AS c
                INNER JOIN address as a
                ON c.address_id = a.id
                WHERE c.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findByEmail($email, $id)
    {
        $sql = "SELECT * FROM client WHERE email = :email AND (:id IS NULL OR id != :id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findByPhone($phone, $id)
    {
        $sql = "SELECT * FROM client WHERE phone = :phone AND (:id IS NULL OR id != :id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id', $id);
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

    public function update($name, $email, $phone, $id) {
        $sql = "UPDATE client SET name = :name, email = :email, phone = :phone WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>