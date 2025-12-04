<?php
class Booking {
    public $id;
    public $user_id;
    public $field_id;
    public $tanggal;
    public $durasi;
    public $total_harga;
    // Property tambahan untuk join view
    public $user_name;
    public $nama_lapangan;
}
?>