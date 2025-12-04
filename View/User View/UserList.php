<div class="md:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">Email</th>
                <th class="px-5 py-3">Role</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userVM->users as $u): ?>
            <tr class="border-b border-gray-200">
                <td class="px-5 py-5 text-sm font-bold"><?= $u->nama ?></td>
                <td class="px-5 py-5 text-sm"><?= $u->email ?></td>
                <td class="px-5 py-5 text-sm"><span class="bg-gray-200 px-2 py-1 rounded text-xs"><?= $u->role ?></span></td>
                <td class="px-5 py-5 text-sm">
                    <a href="index.php?page=users&action=edit&id=<?= $u->id ?>" class="text-indigo-600 font-bold mr-2">Edit</a>
                    <a href="index.php?page=users&action=delete&id=<?= $u->id ?>" class="text-red-600" onclick="return confirm('Hapus member ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>