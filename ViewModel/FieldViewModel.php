<?php
require_once 'Model/Field.php';
require_once 'ViewModel/DataBinder.php';

class FieldViewModel {
    private $db;
    public $fields = [];

    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function loadFields() {
        $stmt = $this->db->query("SELECT * FROM fields");
        $this->fields = $stmt->fetchAll(PDO::FETCH_CLASS, 'Field');
    }
    
    public function getFieldById($id) {
        $stmt = $this->db->prepare("SELECT * FROM fields WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchObject('Field');
    }

    public function saveField($postData) {
        $field = DataBinder::bind($postData, new Field());
        if (!empty($field->id)) { // Update
            $sql = "UPDATE fields SET nama_lapangan=?, jenis=?, harga_per_jam=? WHERE id=?";
            $this->db->prepare($sql)->execute([$field->nama_lapangan, $field->jenis, $field->harga_per_jam, $field->id]);
        } else { // Insert
            $sql = "INSERT INTO fields (nama_lapangan, jenis, harga_per_jam) VALUES (?, ?, ?)";
            $this->db->prepare($sql)->execute([$field->nama_lapangan, $field->jenis, $field->harga_per_jam]);
        }
    }

    public function deleteField($id) {
        $this->db->prepare("DELETE FROM fields WHERE id=?")->execute([$id]);
    }
}
?>