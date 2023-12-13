<header class="bg-neutral-900 p-2">
    <div class="flex items-center justify-between max-w-7xl mx-auto">
        <h1 class="text-2xl font-semibold">{{ $userName }}</h1>
        <div class="flex items-center space-x-2">
            <button id="btn-open-model" class="bg-blue-500 text-white p-2 rounded-sm">New Chat</button>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('POST')
                <button class="bg-gray-200 text-gray-800 p-2 rounded-sm">Logout</button>
            </form>
        </div>
    </div>
</header>