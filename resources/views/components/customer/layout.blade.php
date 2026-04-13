<!-- resources/views/components/customer/layout.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Member Dashboard')</title>
    
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    
    <!-- Custom Styles -->
    @stack('styles')
</head>
<script src="//unpkg.com/alpinejs" defer></script>

<body class="bg-gray-50 flex flex-col min-h-screen">
    
    <!-- Navbar -->
    @include('components.customer.navbar')
    
    <!-- Tabs -->
    @include('components.customer.tabs')
    
    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 animate-fade-in">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        
        

        <!-- Page Content -->
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.customer.footer')
    
    <!-- Custom Scripts -->
    @stack('scripts')

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    </style>
</body>
</html>