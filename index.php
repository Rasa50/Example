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
    case 'home':
        include 'View/Home View/HomeView.html';
        break;

    // --- HALAMAN LAPANGAN (FIELDS) ---
    case 'fields':
        $fieldVM = new FieldViewModel();
        
        // Handle Action (Simpan/Hapus)
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'save') {
            $fieldVM->saveField($_POST);
            header("Location: index.php?page=fields"); exit;
        } elseif ($action == 'delete') {
            $fieldVM->deleteField($_GET['id']);
            header("Location: index.php?page=fields"); exit;
        }

        // Load Data
        $fieldVM->loadFields();

        // Tampilkan View
        echo '<div class="flex justify-between items-center mb-6"><h2 class="text-2xl font-bold text-gray-700">Manajemen Lapangan</h2></div>';
        echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">';
        
        // Include file View sesuai nama yang kamu upload
        if (file_exists('View/Field View/FieldForm.html')) {
            include 'View/Field View/FieldForm.html';
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