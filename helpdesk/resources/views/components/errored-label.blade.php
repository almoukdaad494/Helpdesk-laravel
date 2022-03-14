@props(['value' ,'field'])


<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value }}

    @error($field)
    <span class="text-red-500">{{ $message }}</span>
    @enderror

</label>

