<div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md h-fit">
    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Buat Pesanan Baru</h3>
    <form action="index.php?page=bookings&action=save" method="POST">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Pilih Member</label>
            <select name="user_id" class="w-full border rounded px-3 py-2">
                <?php foreach($bookingVM->usersList as $ul): ?>
                    <option value="<?= $ul->id ?>"><?= $ul->nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Pilih Lapangan</label>
            <select name="field_id" class="w-full border rounded px-3 py-2">
                <?php foreach($bookingVM->fieldsList as $fl): ?>
                    <option value="<?= $fl->id ?>"><?= $fl->nama_lapangan ?> (<?= $fl->jenis ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Durasi (Jam)</label>
            <input type="number" name="durasi" value="1" min="1" class="w-full border rounded px-3 py-2" required>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Buat Booking</button>
    </form>
</div>