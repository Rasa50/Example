<div class="bg-white p-6 rounded-lg shadow-md h-fit">
  <h3 class="text-lg font-semibold mb-4 border-b pb-2">
    <?= isset($fieldToEdit) ? 'Edit Lapangan' : 'Tambah Lapangan Baru' ?>
  </h3>
  <form action="index.php?page=fields&action=save" method="POST">
    <input type="hidden" name="id" value="<?= isset($fieldToEdit) ? $fieldToEdit->id : '' ?>" />
    
    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Nama Lapangan</label>
      <input
        type="text"
        name="nama_lapangan"
        class="w-full border rounded px-3 py-2"
        required
        placeholder="Cth: Futsal A"
        value="<?= isset($fieldToEdit) ? $fieldToEdit->nama_lapangan : '' ?>"
      />
    </div>
    
    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Jenis</label>
      <select name="jenis" class="w-full border rounded px-3 py-2">
        <?php 
          $jenis = isset($fieldToEdit) ? $fieldToEdit->jenis : ''; 
        ?>
        <option value="Futsal" <?= $jenis == 'Futsal' ? 'selected' : '' ?>>Futsal</option>
        <option value="Basket" <?= $jenis == 'Basket' ? 'selected' : '' ?>>Basket</option>
        <option value="Badminton" <?= $jenis == 'Badminton' ? 'selected' : '' ?>>Badminton</option>
      </select>
    </div>
    
    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Harga / Jam (Rp)</label>
      <input
        type="number"
        name="harga_per_jam"
        class="w-full border rounded px-3 py-2"
        required
        value="<?= isset($fieldToEdit) ? $fieldToEdit->harga_per_jam : '' ?>"
      />
    </div>
    
    <div class="flex gap-2">
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            <?= isset($fieldToEdit) ? 'Update Data' : 'Simpan Data' ?>
        </button>
        <?php if(isset($fieldToEdit)): ?>
            <a href="index.php?page=fields" class="w-full bg-gray-500 text-white py-2 rounded hover:bg-gray-600 text-center">Batal</a>
        <?php endif; ?>
    </div>
  </form>
</div>