@error('error')<div class="alert alert-danger">{{ $message }}</div>@enderror
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" value="{{ old('nombre', $modulo->nombre ?? '') }}" id="nombre" name="nombre" required maxlength="120">
    @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label for="abreviatura" class="form-label">Abreviatura</label>
    <input type="text" class="form-control" value="{{ old('abreviatura', $modulo->abreviatura ?? '') }}" id="abreviatura" name="abreviatura" required maxlength="7">
    @error('abreviatura')<div class="text-danger">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label for="horas" class="form-label">Horas</label>
    <input type="number" class="form-control" value="{{ old('horas', $modulo->horas ?? '') }}" id="horas" name="horas" min="0" max="15">
    @error('horas')<div class="text-danger">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label for="creditos" class="form-label">Créditos</label>
    <input type="number" class="form-control" value="{{ old('creditos', $modulo->creditos ?? '') }}" id="creditos" name="creditos" min="0" max="99.99" step="0.01">
    @error('creditos')<div class="text-danger">{{ $message }}</div>@enderror
</div>
<button type="submit" class="btn btn-secondary">{{ $buttonText }}</button>
<a href="{{ route('modulo.index') }}" class="btn btn-secondary">Cancelar</a>
