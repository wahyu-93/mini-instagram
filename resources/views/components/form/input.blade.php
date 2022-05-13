<input 
    id="{{$name}}" 
    type="{{$type ?? 'text'}}" 
    class="form-control 
    @error($name) is-invalid @enderror" 
    name="{{$name}}" 
    
    @isset($object->{$name})
        value="{{ old($name) ? old($name) : $object->{$name}  }}"
    @else
        value="{{ old($name) }}"
    @endisset
    
    required autocomplete="{{$name}}" autofocus>

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror