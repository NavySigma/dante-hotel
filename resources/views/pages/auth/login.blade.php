
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Member</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-lg p-8 w-full max-w-sm border-4 border-black">
        <!-- Icon User -->
        <div class="flex justify-center mb-4">
            <div class="bg-gray-300 rounded-full w-20 h-20 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h2 class="text-center text-xl font-semibold mb-6">Login</h2>

        @if ($errors->has('message'))
            <div class="mb-4 text-red-600 text-sm text-center font-semibold">
                {{ $errors->first('message') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Username -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Username</label>
                <input 
                    type="text" 
                    name="user_username" 
                    placeholder="Masukkan username"
                    class="w-full px-4 py-3 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required
                >
                @error('user_username')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Password</label>
                <input 
                    type="password" 
                    name="user_password" 
                    placeholder="Masukkan password"
                    class="w-full px-4 py-3 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required
                >
                @error('user_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            

            <!-- Button Masuk -->
            <button 
                type="submit"
                class="w-full bg-black text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk
            </button>

            <!-- Link Register -->
            <p class="text-center text-sm text-gray-600 mt-4">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">Register</a>
            </p>
        </form>
    </div>
</body>
</html>