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

    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject('User');
    }

    public function saveUser($postData) {
        $user = DataBinder::bind($postData, new User());
        if (!empty($user->id)) { // UPDATE
            $stmt = $this->db->prepare("UPDATE users SET nama=?, email=? WHERE id=?");
            $stmt->execute([$user->nama, $user->email, $user->id]);
        } else { // INSERT
            $stmt = $this->db->prepare("INSERT INTO users (nama, email, role) VALUES (?, ?, ?)");
            $stmt->execute([$user->nama, $user->email, 'member']);
        }
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