<!-- resources/views/components/customer/footer.blade.php -->
<footer class="relative overflow-hidden mt-40" style="background: linear-gradient(to right, #CFCFCF, #000000);">
    <!-- Animasi Background -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute w-96 h-96 rounded-full blur-3xl animate-blob" style="background-color: #CFCFCF;"></div>
        <div class="absolute w-96 h-96 rounded-full blur-3xl animate-blob animation-delay-2000 top-0 right-0" style="background-color: #888888;"></div>
    </div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Kolom 1: About -->
            

            <!-- Kolom 2: Quick Links -->
            <div class="animate-fade-in-delay">
                
                <ul class="space-y-2">
                    
                </ul>
            </div>

            <!-- Kolom 3: Contact -->
            
        <!-- Bottom Bar -->
        <div class="border-t border-gray-400  pt-6 text-center">
            <p class="text-gray-100 text-sm">
                &copy; {{ date('Y') }} Admin Dashboard. All rights reserved.
            </p>
        </div>
    </div>
</footer>

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
            transform: translateY(20px);
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

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    .animate-fade-in-delay {
        animation: fadeIn 0.8s ease-out;
    }

    .animate-fade-in-delay-2 {
        animation: fadeIn 1s ease-out;
    }
</style>