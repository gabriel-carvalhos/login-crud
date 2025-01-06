<?php 

class Address extends Database
{
    public function insert($street, $district, $city, $state, $cep) {
        $sql = "INSERT INTO address (street, district, city, state, cep) VALUES (:street, :district, :city, :state, :cep)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':district', $district);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':cep', $cep);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function delete($id) {
        $sql = "DELETE FROM address WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>