<div class="bg-white p-6 rounded-lg shadow-md h-fit w-full max-w-lg mx-auto">
    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Beri Ulasan Pengalamanmu</h3>
    
    <form action="index.php?page=reviews&action=save" method="POST">
        <input type="hidden" name="booking_id" value="<?= $_GET['booking_id'] ?? '' ?>">
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Rating</label>
            <div class="flex gap-4">
                <label class="flex items-center"><input type="radio" name="rating" value="5" checked class="mr-2"> ⭐⭐⭐⭐⭐ (5)</label>
                <label class="flex items-center"><input type="radio" name="rating" value="4" class="mr-2"> ⭐⭐⭐⭐ (4)</label>
            </div>
            <div class="flex gap-4 mt-2">
                <label class="flex items-center"><input type="radio" name="rating" value="3" class="mr-2"> ⭐⭐⭐ (3)</label>
                <label class="flex items-center"><input type="radio" name="rating" value="2" class="mr-2"> ⭐⭐ (2)</label>
                <label class="flex items-center"><input type="radio" name="rating" value="1" class="mr-2"> ⭐ (1)</label>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Komentar</label>
            <textarea name="komentar" rows="4" class="w-full border rounded px-3 py-2" placeholder="Bagaimana kondisi lapangannya?" required></textarea>
        </div>

        <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 font-bold">
            Kirim Review
        </button>
    </form>
</div>