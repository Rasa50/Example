<div class="bg-white p-6 rounded-lg shadow-md h-fit">
    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Registrasi Member</h3>
    <form action="index.php?page=users&action=save" method="POST">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" required placeholder="Nama Member">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required placeholder="email@contoh.com">
        </div>
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Tambah Member</button>
    </form>
</div>