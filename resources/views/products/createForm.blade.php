<div class="form-group">
    <label for="">Nama Obat Herbal</label>
    <input type="text" name="name" required 
        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('name') }}</p>
</div>

<div class="form-group">
    <label for="">Merek</label>
    <input type="text" name="merk" 
        class="form-control {{ $errors->has('merk') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('merk') }}</p>
</div>

<div class="form-group">
    <label for="">Satuan</label>
    <input type="text" name="satuan" 
        class="form-control {{ $errors->has('satuan') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('satuan') }}</p>
</div>

<div class="form-group">
    <label for="">Stok</label>
    <input type="number" name="stock" 
        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('stock') }}</p>
</div>

<div class="form-group">
    <label for="">Harga (Rp.)</label>
    <input type="number" name="price" 
        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('price') }}</p>
</div>

<button type="submit" class="btn btn-primary">Tambah Obat Herbal</button>