<!-- resources/views/pages/admin/dashboard.blade.php -->
@extends('components.admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Data Kamar -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-black p-8 hover:shadow-lg transition-all duration-300">
            <div class="flex flex-col items-center text-center">
                <!-- Icon -->
                <div class="w-16 h-16 mb-4">
                    <svg class="w-full h-full text-black" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3h18a1 1 0 011 1v16a1 1 0 01-1 1H3a1 1 0 01-1-1V4a1 1 0 011-1zm5 10H4v6h4v-6zm6 0h-4v6h4v-6zm6 0h-4v6h4v-6zM4 5v6h16V5H4z"/>
                    </svg>
                </div>
                <!-- Number -->
                <h3 class="text-5xl font-bold text-gray-900 mb-2">{{ $totalKamar ?? '3' }}</h3>
                <!-- Label -->
                <p class="text-base font-semibold text-gray-700">Data Kamar</p>
            </div>
        </div>

        <!-- Kategori -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-black p-8 hover:shadow-lg transition-all duration-300">
            <div class="flex flex-col items-center text-center">
                <!-- Icon -->
                <div class="w-16 h-16 mb-4">
                    <svg class="w-full h-full text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <!-- Number -->
                <h3 class="text-5xl font-bold text-gray-900 mb-2">{{ $totalKategori ?? '3' }}</h3>
                <!-- Label -->
                <p class="text-base font-semibold text-gray-700">Kategori</p>
            </div>
        </div>

        <!-- Data Sewa -->
        <div class="bg-white rounded-2xl shadow-sm border-2 border-black p-8 hover:shadow-lg transition-all duration-300">
            <div class="flex flex-col items-center text-center">
                <!-- Icon -->
                <div class="w-16 h-16 mb-4">
                    <svg class="w-full h-full text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                </div>
                <!-- Number -->
                <h3 class="text-5xl font-bold text-gray-900 mb-2">{{ $totalSewa ?? '3' }}</h3>
                <!-- Label -->
                <p class="text-base font-semibold text-gray-700">Data Sewa</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
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

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endpush