<input id="{{ $name }}" type="{{ $type }}"
    class="w-full border border-[#CFCFCF] p-3 text-neutral-70 focus:outline-none h-10 2xl:h-12 rounded-md text-xs 2xl:text-base font-light @error($name) is-invalid @enderror"
    name="{{ $name }}" @if ($required) required @endif
    @if ($autofocus) autofocus @endif placeholder="{{ $placeholder }}" value="{{ $value }}">
