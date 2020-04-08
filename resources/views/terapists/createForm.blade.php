<div class="form-group">
    <label for="">Nama Terapis</label>
    <input type="text" name="name" required 
        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('name') }}</p>
</div>

<div class="form-group">
    <label for="">Jenis Kelamin</label>
    <select name="gender" id="gender" class="form-control">
        <option value="" disabled selected>Pilih Jenis Kelamin</option>
        
        @foreach($genderOptions as $genderKey=>$genderValue)
        <option value="{{$genderKey}}">{{$genderValue}}</option>
        @endforeach
        
    </select>
    <p class="text-danger">{{ $errors->first('gender') }}</p>
</div>

<div class="form-group">
    <label for="">Alamat</label>
    <input type="text" name="address" 
        class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('address') }}</p>
</div>

<div class="form-group">
    <label for="province">Provinsi</label>
    <select name="province" id="province" class="form-control">
        <option value="" disabled selected>Pilih provinsi</option>
        
        @foreach($provinceOptions as $provinsiKey=>$provinsiValue)
        <option value="{{$provinsiKey}}">{{$provinsiValue}}</option>
        @endforeach
        
    </select>
</div>

<button type="submit" class="btn btn-primary">Tambah pasien</button>