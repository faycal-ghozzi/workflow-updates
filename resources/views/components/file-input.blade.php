@props(['name', 'disabled' => false])
<div class="input-group file-input-group file-input-wrapper">
    <input type="file"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control visually-hidden file-upload"
        accept=".pdf"
        @if(isset($disabled) && $disabled) disabled @endif
    />
    <label for="{{ $name }}" class="btn btn-outline-secondary">Parcourir</label>
    <input type="text"
        id="label_{{ $name }}"
        class="form-control bg-light file-name-display"
        placeholder="Aucun fichier choisi"
        readonly>
</div>
