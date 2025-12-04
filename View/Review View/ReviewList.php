<div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-400 relative group">
    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
        <a href="index.php?page=reviews&action=edit&id=<?= $r->id ?>" class="text-blue-500 mr-2"><i class="fas fa-edit"></i></a>
        <a href="index.php?page=reviews&action=delete&id=<?= $r->id ?>" class="text-red-500" onclick="return confirm('Hapus ulasan ini?')"><i class="fas fa-trash"></i></a>
    </div>

    <div class="flex justify-between items-start mb-2">
    ```

**C. Update `View/Review View/ReviewForm.php`**
Pastikan form ini bisa menangani Edit (mengisi ulang rating bintang dan komentar).

```php
<div class="bg-white p-6 rounded-lg shadow-md h-fit w-full max-w-lg mx-auto">
    <h3 class="text-lg font-semibold mb-4 border-b pb-2">
        <?= isset($reviewToEdit) ? 'Edit Ulasan' : 'Beri Ulasan' ?>
    </h3>
    
    <form action="index.php?page=reviews&action=save" method="POST">
        <input type="hidden" name="id" value="<?= isset($reviewToEdit) ? $reviewToEdit->id : '' ?>">
        <input type="hidden" name="booking_id" value="<?= isset($reviewToEdit) ? $reviewToEdit->booking_id : ($_GET['booking_id'] ?? '') ?>">
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Rating</label>
            <?php $cr = isset($reviewToEdit) ? $reviewToEdit->rating : 5; // Current Rating ?>
            <div class="flex gap-4">
                <label class="flex items-center"><input type="radio" name="rating" value="5" <?= $cr==5?'checked':'' ?> class="mr-2"> ⭐⭐⭐⭐⭐</label>
                <label class="flex items-center"><input type="radio" name="rating" value="4" <?= $cr==4?'checked':'' ?> class="mr-2"> ⭐⭐⭐⭐</label>
            </div>
            <div class="flex gap-4 mt-2">
                <label class="flex items-center"><input type="radio" name="rating" value="3" <?= $cr==3?'checked':'' ?> class="mr-2"> ⭐⭐⭐</label>
                <label class="flex items-center"><input type="radio" name="rating" value="2" <?= $cr==2?'checked':'' ?> class="mr-2"> ⭐⭐</label>
                <label class="flex items-center"><input type="radio" name="rating" value="1" <?= $cr==1?'checked':'' ?> class="mr-2"> ⭐</label>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Komentar</label>
            <textarea name="komentar" rows="4" class="w-full border rounded px-3 py-2" required><?= isset($reviewToEdit) ? $reviewToEdit->komentar : '' ?></textarea>
        </div>

        <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 font-bold">
            <?= isset($reviewToEdit) ? 'Update Review' : 'Kirim Review' ?>
        </button>
        <?php if(isset($reviewToEdit)): ?>
            <a href="index.php?page=reviews" class="block text-center text-sm text-gray-500 mt-2">Batal</a>
        <?php endif; ?>
    </form>
</div>