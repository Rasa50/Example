<div class="lg:col-span-3 bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-indigo-50 text-left text-xs font-semibold text-indigo-800 uppercase">
                <th class="px-5 py-3">Penyewa</th>
                <th class="px-5 py-3">Lapangan</th>
                <th class="px-5 py-3">Tanggal</th>
                <th class="px-5 py-3">Durasi</th>
                <th class="px-5 py-3">Total</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookingVM->bookings as $b): ?>
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="px-5 py-4 text-sm font-medium"><?= $b->user_name ?></td>
                <td class="px-5 py-4 text-sm"><?= $b->nama_lapangan ?></td>
                <td class="px-5 py-4 text-sm"><?= $b->tanggal ?></td>
                <td class="px-5 py-4 text-sm"><?= $b->durasi ?> Jam</td>
                <td class="px-5 py-4 text-sm font-bold text-green-600">Rp <?= number_format($b->total_harga) ?></td>
                <td class="px-5 py-4 text-sm flex items-center">
                    <a href="index.php?page=bookings&action=edit&id=<?= $b->id ?>" class="text-indigo-600 mr-3" title="Edit"><i class="fas fa-edit"></i></a>
                    <a href="index.php?page=bookings&action=delete&id=<?= $b->id ?>" class="text-red-500 mr-3" onclick="return confirm('Hapus?')"><i class="fas fa-trash"></i></a>
                    <a href="index.php?page=reviews&action=create&booking_id=<?= $b->id ?>" class="text-yellow-500" title="Review"><i class="fas fa-star"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>