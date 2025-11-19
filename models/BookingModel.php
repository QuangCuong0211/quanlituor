<?php
class BookingModel
{
    /** @var PDO */
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM bookings ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return [];
        }

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows ?: [];
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM bookings WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return null;
        }

        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function insert($data)
    {
        $sql = "INSERT INTO bookings 
            (booking_code, customer_name, phone, email, adult, child, total_price, start_date, end_date, note)
            VALUES
            (:booking_code, :customer_name, :phone, :email, :adult, :child, :total_price, :start_date, :end_date, :note)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        return $stmt->execute([
            ':booking_code'  => $data['booking_code'],
            ':customer_name' => $data['customer_name'],
            ':phone'         => $data['phone'],
            ':email'         => $data['email'],
            ':adult'         => $data['adult'],
            ':child'      => $data['child'],
            ':total_price'   => $data['total_price'],
            ':start_date'    => $data['start_date'],
            ':end_date'      => $data['end_date'],
            ':note'          => $data['note'] ?? null,
        ]);
    }

    public function update($data)
    {
        $sql = "UPDATE bookings SET
            customer_name = :customer_name,
            phone         = :phone,
            email         = :email,
            adult         = :adult,
            child      = :child,
            total_price   = :total_price,
            start_date    = :start_date,
            end_date      = :end_date,
            note          = :note
            WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        return $stmt->execute([
            ':id'            => $data['id'],
            ':customer_name' => $data['customer_name'],
            ':phone'         => $data['phone'],
            ':email'         => $data['email'],
            ':adult'         => $data['adult'],
            ':child'      => $data['child'],
            ':total_price'   => $data['total_price'],
            ':start_date'    => $data['start_date'],
            ':end_date'      => $data['end_date'],
            ':note'          => $data['note'] ?? null,
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM bookings WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
