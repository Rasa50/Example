<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($reviewVM->reviews as $r): ?>
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-400">
        <div class="flex justify-between items-start mb-2">
            <div>
                <h4 class="font-bold text-gray-800"><?= $r->user_name ?></h4>
                <p class="text-xs text-gray-500">Main di: <?= $r->nama_lapangan ?></p>
            </div>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded">
                ⭐ <?= $r->rating ?>/5
            </span>
        </div>
        <p class="text-gray-600 text-sm italic">"<?= $r->komentar ?>"</p>
        <p class="text-xs text-gray-400 mt-4 text-right">Tgl Main: <?= $r->tanggal_booking ?></p>
    </div>
    <?php endforeach; ?>
    
    <?php if(empty($reviewVM->reviews)): ?>
        <p class="col-span-3 text-center text-gray-500">Belum ada review.</p>
    <?php endif; ?>
</div>