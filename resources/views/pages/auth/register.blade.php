<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member</title>
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
        <h2 class="text-center text-xl font-semibold mb-6">Register</h2>

        <!-- Form -->
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- NIK -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">NIK</label>
                <input 
                    type="text" 
                    name="nik" 
                    placeholder="Masukkan NIK"
                    class="w-full px-4 py-3 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required
                >
                @error('nik')
    <small class="text-danger">{{ $message }}</small>
@enderror
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nomor Hp</label>
                <input 
                    type="text" 
                    name="nohp" 
                    placeholder="Masukkan Nomor Hp"
                    class="w-full px-4 py-3 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required
                >
                @error('nohp')
    <small class="text-danger">{{ $message }}</small>
@enderror
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    placeholder="Masukkan Username"
                    class="w-full px-4 py-3 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required
                >
                @error('username')
    <small class="text-danger">{{ $message }}</small>
@enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Masukkan Password"
                    class="w-full px-4 py-3 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400"
                    required
                >
                @error('password')
    <small class="text-danger">{{ $message }}</small>
@enderror
            </div>

            <!-- Button Register -->
            <button 
                type="submit"
                class="w-full bg-black text-white py-3 rounded-lg font-medium hover:bg-gray-800 transition flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Register
            </button>

            <!-- Link Login -->
            <p class="text-center text-sm text-gray-600 mt-4">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Login</a>
            </p>
        </form>
    </div>
</body>
</html>
