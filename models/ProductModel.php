<?php
class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllTours() {
        $sql = "SELECT * FROM tour";
        return $this->conn->query($sql)->fetchAll();
    }

    public function insertTour($name, $desc, $price) {
        $sql = "INSERT INTO tour (tour_name, description, price) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $desc, $price]);
    }

    public function getTourById($id) {
        $sql = "SELECT * FROM tour WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateTour($id, $name, $desc, $price) {
        $sql = "UPDATE tour SET tour_name=?, description=?, price=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $desc, $price, $id]);
    }

    public function deleteTour($id) {
        $sql = "DELETE FROM tour WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}
