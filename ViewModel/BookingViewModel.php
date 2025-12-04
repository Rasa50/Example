<?php
require_once 'Model/Booking.php';
require_once 'ViewModel/DataBinder.php';

class BookingViewModel {
    private $db;
    public $bookings = [];
    public $usersList = [];
    public $fieldsList = [];

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function loadData() {
        // Join table
        $sql = "SELECT b.*, u.nama as user_name, f.nama_lapangan 
                FROM bookings b 
                JOIN users u ON b.user_id = u.id 
                JOIN fields f ON b.field_id = f.id";
        $stmt = $this->db->query($sql);
        $this->bookings = $stmt->fetchAll(PDO::FETCH_CLASS, 'Booking');

        // Dropdown data
        $this->usersList = $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_CLASS, 'User');
        $this->fieldsList = $this->db->query("SELECT * FROM fields")->fetchAll(PDO::FETCH_CLASS, 'Field');
    }

    public function getBookingById($id) {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject('Booking');
    }

    public function saveBooking($postData) {
        $booking = DataBinder::bind($postData, new Booking());
        
        // Hitung ulang harga berdasarkan lapangan yang dipilih
        $stmt = $this->db->prepare("SELECT harga_per_jam FROM fields WHERE id = ?");
        $stmt->execute([$booking->field_id]);
        $field = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($field) {
            $total = $field->harga_per_jam * $booking->durasi;
            
            if (!empty($booking->id)) { // UPDATE
                $sql = "UPDATE bookings SET user_id=?, field_id=?, tanggal=?, durasi=?, total_harga=? WHERE id=?";
                $this->db->prepare($sql)->execute([$booking->user_id, $booking->field_id, $booking->tanggal, $booking->durasi, $total, $booking->id]);
            } else { // INSERT
                $sql = "INSERT INTO bookings (user_id, field_id, tanggal, durasi, total_harga) VALUES (?, ?, ?, ?, ?)";
                $this->db->prepare($sql)->execute([$booking->user_id, $booking->field_id, $booking->tanggal, $booking->durasi, $total]);
            }
        }
    }

    public function createBooking($postData) {
        $booking = DataBinder::bind($postData, new Booking());
        // Hitung harga
        $stmt = $this->db->prepare("SELECT harga_per_jam FROM fields WHERE id = ?");
        $stmt->execute([$booking->field_id]);
        $field = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($field) {
            $total = $field->harga_per_jam * $booking->durasi;
            $sql = "INSERT INTO bookings (user_id, field_id, tanggal, durasi, total_harga) VALUES (?, ?, ?, ?, ?)";
            $this->db->prepare($sql)->execute([$booking->user_id, $booking->field_id, $booking->tanggal, $booking->durasi, $total]);
        }
    }

    public function deleteBooking($id) {
        $this->db->prepare("DELETE FROM bookings WHERE id=?")->execute([$id]);
    }
}
?>