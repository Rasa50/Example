<?php
session_start();

// ==========================================
// 1. IMPORT DEPENDENCIES
// ==========================================
// Memanggil konfigurasi database dan ViewModel
require_once 'config/Database.php';
require_once 'ViewModel/FieldViewModel.php';
require_once 'ViewModel/UserViewModel.php';
require_once 'ViewModel/BookingViewModel.php';
require_once 'ViewModel/ReviewViewModel.php';

// ==========================================
// 2. ROUTING LOGIC
// ==========================================
// Menentukan halaman yang dibuka berdasarkan URL (?page=...)
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// ==========================================
// 3. HEADER
// ==========================================
include 'View/Templates/Header.html';

// ==========================================
// 4. CONTENT SWITCHER
// ==========================================
switch ($page) {

    // --- HALAMAN HOME ---
    // --- HALAMAN HOME ---
    case 'home':
        // 1. Instansiasi ViewModel
        $userVM = new UserViewModel();
        $fieldVM = new FieldViewModel();
        $bookingVM = new BookingViewModel();

        // 2. Load Data dari Database
        $userVM->loadUsers();
        $fieldVM->loadFields();
        $bookingVM->loadData();

        // 3. Tampilkan View
        include 'View/Home View/HomeView.html';
        break;

    // --- HALAMAN LAPANGAN (FIELDS) ---
    case 'fields':
        $fieldVM = new FieldViewModel();
        $fieldToEdit = null; // Variabel penampung data edit

        // Handle Action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $fieldVM->saveField($_POST);
            header("Location: index.php?page=fields"); exit;
        } elseif ($action == 'delete') {
            $fieldVM->deleteField($_GET['id']);
            header("Location: index.php?page=fields"); exit;
        } elseif ($action == 'edit') {
            // Ambil data berdasarkan ID untuk diedit
            $fieldToEdit = $fieldVM->getFieldById($_GET['id']);
        }

        $fieldVM->loadFields();

        // Tampilkan View
        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Manajemen Lapangan</h2></div>';
        echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">';
        
        // PENTING: Ubah include ini memanggil file PHP agar bisa baca variabel
        if (file_exists('View/Field View/FieldForm.php')) {
            include 'View/Field View/FieldForm.php';
        }
        if (file_exists('View/Field View/FieldList.php')) {
            include 'View/Field View/FieldList.php';
        }
        echo '</div>';
        break;

    // --- HALAMAN BOOKINGS (TRANSAKSI) ---
    case 'bookings':
        $bookingVM = new BookingViewModel();
        $bookingToEdit = null;

        // Handle Action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $bookingVM->saveBooking($_POST); // Ganti createBooking jadi saveBooking
            header("Location: index.php?page=bookings"); exit;
        } elseif ($action == 'delete') {
            $bookingVM->deleteBooking($_GET['id']);
            header("Location: index.php?page=bookings"); exit;
        } elseif ($action == 'edit') {
            $bookingToEdit = $bookingVM->getBookingById($_GET['id']);
        }

        $bookingVM->loadData();

        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Booking Lapangan</h2></div>';
        echo '<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">';
        
        if (file_exists('View/Booking View/BookingForm.php')) include 'View/Booking View/BookingForm.php';
        if (file_exists('View/Booking View/BookingList.php')) include 'View/Booking View/BookingList.php';
        
        echo '</div>';
        break;

    // --- HALAMAN REVIEWS ---
    case 'reviews':
        $reviewVM = new ReviewViewModel();
        $reviewToEdit = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $reviewVM->saveReview($_POST);
            header("Location: index.php?page=reviews"); exit;
        } elseif ($action == 'delete') {
            $reviewVM->deleteReview($_GET['id']);
            header("Location: index.php?page=reviews"); exit;
        } elseif ($action == 'create') {
            // Mode Buat Baru (dari halaman booking)
            echo '<div class="flex justify-center mt-10">';
            include 'View/Review View/ReviewForm.php';
            echo '</div>';
            return; 
        } elseif ($action == 'edit') {
            // Mode Edit
            $reviewToEdit = $reviewVM->getReviewById($_GET['id']);
            echo '<div class="flex justify-center mt-10">';
            include 'View/Review View/ReviewForm.php';
            echo '</div>';
            return;
        }

        $reviewVM->loadReviews();
        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Ulasan Member</h2></div>';
        include 'View/Review View/ReviewList.php';
        break;

    // --- HALAMAN USERS (MEMBER) ---
    case 'users':
        $userVM = new UserViewModel();
        $userToEdit = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $userVM->saveUser($_POST); // Ganti addUser jadi saveUser
            header("Location: index.php?page=users"); exit;
        } elseif ($action == 'delete') {
            $userVM->deleteUser($_GET['id']);
            header("Location: index.php?page=users"); exit;
        } elseif ($action == 'edit') {
            $userToEdit = $userVM->getUserById($_GET['id']);
        }

        $userVM->loadUsers();

        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Data Member</h2></div>';
        echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">';
        
        if (file_exists('View/User View/UserForm.php')) include 'View/User View/UserForm.php';
        if (file_exists('View/User View/UserList.php')) include 'View/User View/UserList.php';

        echo '</div>';
        break;

    // --- HALAMAN DEFAULT (404) ---
    default:
        echo "<div class='text-center py-20 text-gray-500 text-xl'>Halaman tidak ditemukan.</div>";
}

// ==========================================
// 5. FOOTER
// ==========================================
include 'View/Templates/Footer.html';
?>