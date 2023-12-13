
<input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" class="bg-neutral-800 text-white p-2 rounded-sm focus:outline-none w-full @error('{{ $name }}') border border-red-500 @enderror">
@error('{{ $name }}')
    <p class="text-sm text-red-500">{{ $message }}</p>
@enderror
