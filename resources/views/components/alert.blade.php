@if (session('error'))
    <div class="bg-red-200 text-red-600 text-sm p-2 rounded-sm my-2">{{ session('error') }}</div>
@endif

@if (session('status'))
    <div class="bg-green-200 text-green-600 text-sm p-2 rounded-sm my-2">{{ session('status') }}</div>
@endif
