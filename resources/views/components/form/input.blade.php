<input id="{{$name}}" type="{{$type ?? 'text'}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" value="{{ old($name) }}" required autocomplete="{{$name}}" autofocus>

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror