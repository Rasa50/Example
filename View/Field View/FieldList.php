<div class="md:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">
                <th class="px-5 py-3">Nama Lapangan</th>
                <th class="px-5 py-3">Jenis</th>
                <th class="px-5 py-3">Harga/Jam</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fieldVM->fields as $f): ?>
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="px-5 py-5 text-sm font-bold"><?= $f->nama_lapangan ?></td>
                <td class="px-5 py-5 text-sm"><?= $f->jenis ?></td>
                <td class="px-5 py-5 text-sm">Rp <?= number_format($f->harga_per_jam) ?></td>
                <td class="px-5 py-5 text-sm">
                    <a href="index.php?page=fields&action=edit&id=<?= $f->id ?>" class="text-indigo-600 hover:text-indigo-900 mr-3 font-bold">Edit</a>
                    <a href="index.php?page=fields&action=delete&id=<?= $f->id ?>" class="text-red-600" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>