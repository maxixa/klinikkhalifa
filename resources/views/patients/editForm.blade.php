<div class="form-group">
    <label for="">Nama Pasien</label>
    <input type="text" name="name" required 
        value="{{ $patient->name }}" 
        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('name') }}</p>
</div>

<div class="form-group">
    <label for="">Jenis Kelamin</label>
    <select name="gender" id="gender" class="form-control">
        

        @foreach($genderOptions as $genderKey=>$genderValue)
        <option value="{{$genderKey}}" {{$patient->gender == $genderValue ? 'selected' : ''}}>{{$genderValue}}</option>
        @endforeach

        
    </select>
    <p class="text-danger">{{ $errors->first('gender') }}</p>
</div>

<div class="form-group">
    <label for="">Keluhan</label>
    <input type="text" name="simptom" 
        value="{{ $patient->simptom }}" 
        class="form-control {{ $errors->has('simptom') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('simptom') }}</p>
</div>

<div class="form-group">
    <label for="">Alamat</label>
    <input type="text" name="address" 
        value="{{ $patient->address }}" 
        class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}">
    <p class="text-danger">{{ $errors->first('address') }}</p>
</div>

<div class="form-group">
    <label for="province">Provinsi</label>
    <select name="province" id="province" class="form-control">
        

        @foreach($provinceOptions as $provinsiKey=>$provinsiValue)
        <option value="{{$provinsiKey}}" {{$patient->province == $provinsiValue ? 'selected' : ''}}>{{$provinsiValue}}</option>
        @endforeach

        
    </select>
</div>

<button type="submit" class="btn btn-primary">Update Pasien</button>