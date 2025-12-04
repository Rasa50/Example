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

        // Handle Action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $bookingVM->createBooking($_POST);
            header("Location: index.php?page=bookings"); exit;
        } elseif ($action == 'delete') {
            $bookingVM->deleteBooking($_GET['id']);
            header("Location: index.php?page=bookings"); exit;
        }

        // Load Data
        $bookingVM->loadData();

        // Tampilkan View
        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Booking Lapangan</h2></div>';
        echo '<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">';
        
        // Include file View (BookingForm kamu pakai .php, bukan .html)
        if (file_exists('View/Booking View/BookingForm.php')) {
            include 'View/Booking View/BookingForm.php';
        }
        if (file_exists('View/Booking View/BookingList.php')) {
            include 'View/Booking View/BookingList.php';
        }
        
        echo '</div>';
        break;

    // --- HALAMAN REVIEWS ---
    case 'reviews':
        $reviewVM = new ReviewViewModel();

        // Handle Action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $reviewVM->saveReview($_POST);
            header("Location: index.php?page=reviews"); exit; // Redirect ke list review
        } elseif ($action == 'create') {
            // Tampilkan Form Review
            echo '<div class="flex justify-center mt-10">';
            include 'View/Review View/ReviewForm.php';
            echo '</div>';
            break; // Stop di sini agar tidak load list di bawahnya
        }

        // Load & Tampilkan List Review
        $reviewVM->loadReviews();
        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Ulasan Member</h2></div>';
        include 'View/Review View/ReviewList.php';
        break;

    // --- HALAMAN USERS (MEMBER) ---
    case 'users':
        $userVM = new UserViewModel();

        // Handle Action
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $userVM->addUser($_POST);
            header("Location: index.php?page=users"); exit;
        } elseif ($action == 'delete') {
            $userVM->deleteUser($_GET['id']);
            header("Location: index.php?page=users"); exit;
        }

        // Load Data
        $userVM->loadUsers();

        // Tampilkan View
        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Data Member</h2></div>';
        
        // WARNING: File ini belum ada di upload kamu. 
        // Pastikan kamu membuat folder "User View" di dalam "View" 
        // dan membuat file "UserForm.php" serta "UserList.php".
        $userFormPath = 'View/User View/UserForm.php';
        $userListPath = 'View/User View/UserList.php';

        if (file_exists($userFormPath) && file_exists($userListPath)) {
            echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">';
            include $userFormPath;
            include $userListPath;
            echo '</div>';
        } else {
            // Pesan Error jika file belum dibuat
            echo '<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 w-full" role="alert">
                    <p class="font-bold">File View Tidak Ditemukan</p>
                    <p>Sistem mencari file di: <code>View/User View/UserForm.php</code> & <code>UserList.php</code>.</p>
                    <p>Silakan buat filenya terlebih dahulu.</p>
                  </div>';
        }
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