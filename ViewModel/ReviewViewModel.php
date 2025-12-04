<?php
require_once 'Model/Review.php';
require_once 'ViewModel/DataBinder.php';

class ReviewViewModel {
    private $db;
    public $reviews = [];

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function loadReviews() {
        // Kita JOIN 4 tabel: reviews -> bookings -> users & fields
        // Agar tahu siapa yang review dan review lapangan apa
        $sql = "SELECT r.*, u.nama as user_name, f.nama_lapangan, b.tanggal as tanggal_booking
                FROM reviews r
                JOIN bookings b ON r.booking_id = b.id
                JOIN users u ON b.user_id = u.id
                JOIN fields f ON b.field_id = f.id
                ORDER BY r.id DESC";
        
        $stmt = $this->db->query($sql);
        $this->reviews = $stmt->fetchAll(PDO::FETCH_CLASS, 'Review');
    }
    
    public function getReviewById($id) {
    $stmt = $this->db->prepare("SELECT * FROM reviews WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchObject('Review');
    }

    public function saveReview($postData) {
        $review = DataBinder::bind($postData, new Review());
        if (!empty($review->id)) { // UPDATE
            $stmt = $this->db->prepare("UPDATE reviews SET rating=?, komentar=? WHERE id=?");
            $stmt->execute([$review->rating, $review->komentar, $review->id]);
        } else { // INSERT
            $stmt = $this->db->prepare("INSERT INTO reviews (booking_id, rating, komentar) VALUES (?, ?, ?)");
            $stmt->execute([$review->booking_id, $review->rating, $review->komentar]);
        }
    }

    public function deleteReview($id) {
        $this->db->prepare("DELETE FROM reviews WHERE id=?")->execute([$id]);
    }
}
?>