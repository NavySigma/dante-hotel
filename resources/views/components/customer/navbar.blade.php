@php $auth = auth()->user();
    $profile = $auth->user_profile ?? null;
    $initial = strtoupper(substr($auth->user_username, 0, 1));
@endphp
<!-- resources/views/components/customer/navbar.blade.php -->
<nav class="shadow-lg relative " style="background: linear-gradient(to right, #CFCFCF, #000000);">
    <!-- Animasi Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-96 h-96 rounded-full blur-3xl animate-blob" style="background:#CFCFCF;"></div>
        <div class="absolute w-96 h-96 rounded-full blur-3xl animate-blob animation-delay-2000 top-0 right-0" style="background:#888;"></div>
        <div class="absolute w-96 h-96 rounded-full blur-3xl animate-blob animation-delay-4000 bottom-0 left-1/2" style="background:#000;"></div>
    </div>

    <div class="px-6 py-4 relative z-10">
        <div class="flex items-center justify-between max-w-full">
            <!-- Logo & Welcome Text -->
            <div class="flex items-center gap-4">
                <!-- Logo -->
                <div class="bg-white p-2 rounded-lg shadow-md transform hover:scale-110 transition duration-300">
                    <div class="w-10 h-10 bg-black rounded flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                    </div>
                </div>

                <!-- Text -->
                <div class="text-black">
                    <h1 class="text-xl font-bold animate-fade-in">Danté Hotel</h1>
                    <p class="text-sm text-gray-700 animate-fade-in-delay">Selamat datang, Member </p>
                </div>
            </div>


            <!-- Profile Dropdown -->
<div x-data="{ open: false }" class="relative">
    
    <!-- Button -->
    <button @click="open = !open" class="flex items-center gap-2">
        @if($profile)
        <!-- Jika ada foto profil -->
        <img 
            src="{{ asset('storage/' . $profile) }}"
            class="w-10 h-10 rounded-full object-cover border border-white shadow"
        >
    @else
        <!-- Jika TIDAK ada foto → tampilkan huruf pertama -->
        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center 
                    text-black font-bold text-lg border border-white shadow">
            {{ $initial }}
        </div>
    @endif
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown -->
    <div 
        x-show="open"
        x-transition.opacity.scale.80
        @click.away="open = false"
        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50"
    >
        <a href="{{ route('customer.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            ⚙️ Settings
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                🚪 Logout
            </button>
        </form>
    </div>
</div>



            
        </div>
    </div>
</nav>

<style>
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    .animate-fade-in-delay {
        animation: fadeIn 0.8s ease-out;
    }
</style>