<?php
require_once 'Model/User.php';
require_once 'ViewModel/DataBinder.php';

class UserViewModel {
    private $db;
    public $users = [];
    public $message = "";

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function loadUsers() {
        $stmt = $this->db->query("SELECT * FROM users");
        $this->users = $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public function addUser($postData) {
        $user = DataBinder::bind($postData, new User());
        $stmt = $this->db->prepare("INSERT INTO users (nama, email, role) VALUES (?, ?, ?)");
        $stmt->execute([$user->nama, $user->email, 'member']);
    }
    
    public function deleteUser($id) {
        $this->db->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
    }
}
?>