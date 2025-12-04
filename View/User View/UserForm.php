<div class="bg-white p-6 rounded-lg shadow-md h-fit">
    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        <?= isset($userToEdit) ? 'Edit Member' : 'Registrasi Member' ?>
    </h3>
    <form action="index.php?page=users&action=save" method="POST">
        <input type="hidden" name="id" value="<?= isset($userToEdit) ? $userToEdit->id : '' ?>">
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" required placeholder="Nama Member"
                   value="<?= isset($userToEdit) ? $userToEdit->nama : '' ?>">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required placeholder="email@contoh.com"
                   value="<?= isset($userToEdit) ? $userToEdit->email : '' ?>">
        </div>
        
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            <?= isset($userToEdit) ? 'Update Member' : 'Tambah Member' ?>
        </button>
        <?php if(isset($userToEdit)): ?>
            <a href="index.php?page=users" class="block text-center text-sm text-gray-500 mt-2">Batal</a>
        <?php endif; ?>
    </form>
</div>