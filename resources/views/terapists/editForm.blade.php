<div class="form-group">
    <label for="">Nama Terapis</label>
    <input type="text" name="name" required 
        value="{{ $terapist->name }}" 
        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('name') }}</p>
</div>

<div class="form-group">
    <label for="">Jenis Kelamin</label>
    <select name="gender" id="gender" class="form-control">
        

        @foreach($genderOptions as $genderKey=>$genderValue)
        <option value="{{$genderKey}}" {{$terapist->gender == $genderValue ? 'selected' : ''}}>{{$genderValue}}</option>
        @endforeach

        
    </select>
    <p class="text-danger">{{ $errors->first('gender') }}</p>
</div>


<div class="form-group">
    <label for="">Alamat</label>
    <input type="text" name="address" 
        value="{{ $terapist->address }}" 
        class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('address') }}</p>
</div>

<div class="form-group">
    <label for="province">Provinsi</label>
    <select name="province" id="province" class="form-control">
        

        @foreach($provinceOptions as $provinsiKey=>$provinsiValue)
        <option value="{{$provinsiKey}}" {{$terapist->province == $provinsiValue ? 'selected' : ''}}>{{$provinsiValue}}</option>
        @endforeach

        
    </select>
    <p class="text-danger">{{ $errors->first('gender') }}</p>
</div>

<button type="submit" class="btn btn-primary">Update Pasien</button>