<form action="{{ route('customerPageController.store') }}" method="POST" class="php-email-form">
    @csrf
    @method("POST")
    {{-- ID Produk Kayu --}}
    <input type="hidden" name="kayu_id" value="{{ $data->id }}">

    {{-- ID Pelanggan (hanya jika login sebagai pelanggan) --}}
    @auth('pelanggans')
        <input type="hidden" name="pelanggans_id" value="{{ auth('pelanggans')->user()->id }}">
    @endauth

    {{-- Jumlah Beli --}}
    <div class="form-group mt-3">
        <label for="jumlah_beli">Jumlah Beli</label>
        <input type="number" name="jumlah_beli" id="jumlah_beli" class="form-control"
            placeholder="Masukkan jumlah kayu yang ingin dibeli" min="1" required>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success mt-3">Beli Sekarang</button>
    </div>
</form>
