@extends('components.customer.layout')

@section('content')
<div class="max-w-2xl mx-auto p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">User Settings</h2>

    @if(session('success'))
        <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('customer.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Foto -->
        <div class="mb-4">
            <label class="font-medium">Foto Profil</label>
            <div class="flex items-center gap-4 mt-2">
                <img src="{{ asset('storage/' . ($user->user_profile ?? 'default-profile.png')) }}" class="w-16 h-16 rounded-full">
                <input type="file" name="user_profile" class="border p-2 rounded">
            </div>
        </div>

        <!-- Nama Lengkap -->
        <div class="mb-4">
            <label>Nama Lengkap</label>
            <input type="text" name="user_namalengkap" value="{{ $user->user_namalengkap }}" class="w-full p-2 border rounded">
        </div>

        <!-- NIK -->
        <div class="mb-4">
            <label>NIK</label>
            <input type="text" name="user_nik" value="{{ $user->user_nik }}" class="w-full p-2 border rounded">
        </div>

        <!-- No HP -->
        <div class="mb-4">
            <label>No HP</label>
            <input type="text" name="user_nohp" value="{{ $user->user_nohp }}" class="w-full p-2 border rounded">
        </div>

        <!-- Tanggal Lahir -->
        <div class="mb-4">
            <label>Tanggal Lahir</label>
            <input type="date" name="user_tgllahir" value="{{ $user->user_tgllahir }}" class="w-full p-2 border rounded">
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label>Username</label>
            <input type="text" name="user_username" value="{{ $user->user_username }}" class="w-full p-2 border rounded">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label>Password Baru (opsional)</label>
            <input type="password" name="user_password" class="w-full p-2 border rounded">
        </div>

        <button class="bg-black text-white px-5 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
