<div class="form-group">
    <label for="">Jenis Terapi</label>
    <input type="text" name="name" required 
        value="{{old('name') ?? $teraphy->name }}" 
        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
            <p class="text-danger">{{ $errors->first('name') }}</p>
</div>

<div class="form-group">
    <label for="">Biaya</label>
    <input type="number" name="price" 
        value="{{old('price') ?? $teraphy->price }}" 
        class="form-control {{ $errors->has('price') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('price') }}</p>
</div>

