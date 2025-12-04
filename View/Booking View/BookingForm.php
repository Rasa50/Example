<div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md h-fit">
    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        <?= isset($bookingToEdit) ? 'Edit Pesanan' : 'Buat Pesanan Baru' ?>
    </h3>
    <form action="index.php?page=bookings&action=save" method="POST">
        <input type="hidden" name="id" value="<?= isset($bookingToEdit) ? $bookingToEdit->id : '' ?>">

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Pilih Member</label>
            <select name="user_id" class="w-full border rounded px-3 py-2">
                <?php foreach($bookingVM->usersList as $ul): ?>
                    <option value="<?= $ul->id ?>" <?= (isset($bookingToEdit) && $bookingToEdit->user_id == $ul->id) ? 'selected' : '' ?>>
                        <?= $ul->nama ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Pilih Lapangan</label>
            <select name="field_id" class="w-full border rounded px-3 py-2">
                <?php foreach($bookingVM->fieldsList as $fl): ?>
                    <option value="<?= $fl->id ?>" <?= (isset($bookingToEdit) && $bookingToEdit->field_id == $fl->id) ? 'selected' : '' ?>>
                        <?= $fl->nama_lapangan ?> (<?= $fl->jenis ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border rounded px-3 py-2" required
                   value="<?= isset($bookingToEdit) ? $bookingToEdit->tanggal : '' ?>">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Durasi (Jam)</label>
            <input type="number" name="durasi" min="1" class="w-full border rounded px-3 py-2" required
                   value="<?= isset($bookingToEdit) ? $bookingToEdit->durasi : '1' ?>">
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            <?= isset($bookingToEdit) ? 'Simpan Perubahan' : 'Buat Booking' ?>
        </button>
        <?php if(isset($bookingToEdit)): ?>
            <a href="index.php?page=bookings" class="block text-center text-sm text-gray-500 mt-2">Batal</a>
        <?php endif; ?>
    </form>
</div>