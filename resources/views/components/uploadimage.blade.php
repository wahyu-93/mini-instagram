<label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">{{ $name }}</label>

<div class="col-md-6">
    <input type="file" name="{{ $name }}" id="{{ $name }}" onchange="preview()">
</div>